<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewOrder;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Recupera i dati dal payload della richiesta
        $customerData = $request->input('customerData');
        $cart = $request->input('cart');

        // Crea un nuovo ordine e salva i dati nella tabella 'orders'
        $newOrder = new Order();
        $newOrder->name = $customerData['billingAddress']['name'];
        $newOrder->surname = $customerData['billingAddress']['surname'];
        $newOrder->email = $customerData['email'];
        $newOrder->phone_number = $customerData['billingAddress']['phoneNumber'];
        $newOrder->address = $customerData['billingAddress']['address'];
        $newOrder->total = $cart['total'];
        $newOrder->save();

        foreach ($cart['items'] as $plate) {
            $newOrder->plates()->attach($plate['id'], ['quantity' => $plate['quantity']]);
        }

        // Crea un nuovo lead e salva i dati nella tabella 'leads'
        $newLead = new Lead();
        $newLead->name = $customerData['billingAddress']['name'];
        $newLead->address = $customerData['email'];
        $newLead->message = 'Order placed with total: ' . $newOrder->total . '€';
        $newLead->save();

        // Invia email al consumatore con i dettagli dell'ordine
        Mail::to($customerData['email'])
            ->send(new NewOrder($newOrder, $customerData));

        // recupera ristorante dal piatto
        $restaurant = Restaurant::where('id', $cart['items'][0]['restaurant_id'])
            ->first();
        // recupera ristoratore dal ristorante
        $owner = User::where('id', $restaurant->user_id)->first();

        // Invia email al ristoratore con i dettagli dell'ordine
        Mail::to($owner->email)
            ->send(new NewOrder($newOrder, $customerData));

        // Risposta al client
        return response()->json([
            'success' => true,
            'message' => 'Ordine creato e email inviata correttamente',
            'request' => $request->all(),
            'results' => $owner,
        ]);
    }

    // recuperiamo la lista degli ordini da passare alla pagina order-summary
    public function summary()
    {

        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        $restaurant_id = $restaurant->id;

        $allOrders = Order::whereHas('plates', function ($query) use ($restaurant_id) {
            $query->where('restaurant_id', $restaurant_id);
        })->get();
        
         $restaurant = Restaurant::where('user_id', Auth::id())->first();


         // Recupera l'ID del ristorante
         $restaurant_id = $restaurant->id;
 
         // Inizializza un array vuoto per i totali mensili
         $monthlyTotals = [];
 
         // Loop attraverso i 12 mesi precedenti, inclusi i mesi attuali
         for ($i = 0; $i < 12; $i++) {
             // Ottieni il mese corrente
             $currentMonth = now()->subMonthsNoOverflow($i)->format('Y-m');
 
             // Recupera gli ordini relativi al ristorante corrente per il mese corrente
             $orders = Order::whereHas('plates', function ($query) use ($restaurant_id) {
                 $query->where('restaurant_id', $restaurant_id);
             })->whereYear('created_at', now()->subMonthsNoOverflow($i)->year)
                 ->whereMonth('created_at', now()->subMonthsNoOverflow($i)->month)
                 ->get();
 
             // Calcola il totale degli ordini per il mese corrente
             $monthlyTotals[$currentMonth] = $orders->sum('total');
         }
         // Ottieni l'elenco dei mesi nell'ordine corretto
         
         // Riempire gli eventuali mesi mancanti con totali nulli
         for ($i = 0; $i < 12; $i++) {
             $currentMonth = now()->subMonthsNoOverflow($i)->format('Y-m');
             if (!isset($monthlyTotals[$currentMonth])) {
                 $monthlyTotals[$currentMonth] = 0;
             }
         }
 
         $sorted = ksort($monthlyTotals);
         
         $labels = array_keys($monthlyTotals);
         // Ordina l'array per garantire che i mesi siano in ordine cronologico
         
 
         // Estrai i totali mensili
         $totals = array_values($monthlyTotals);
 
         $chartjs = app()->chartjs
             ->name('barChart')
             ->type('bar')
             ->size(['width' => 400, 'height' => 200])
             ->labels($labels)
             ->datasets([
                 [
                     "label" => "Totals",
                     'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                     'borderColor' => "rgba(38, 185, 154, 0.7)",
                     "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                     "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                     "pointHoverBackgroundColor" => "#fff",
                     "pointHoverBorderColor" => "rgba(220,220,220,1)",
                     "data" => $totals,
                     "fill" => false,
                 ],
             ])
           
        ->options([]);
        // Passa gli ordini alla vista
        return view('orders.order-summary', compact('chartjs','allOrders'));
    }

    public function show($id)
    {
        // Recupera l'ordine specifico con gli id
        $order = Order::with('plates')->findOrFail($id);

        // Passa l'ordine alla vista
        return view('orders.order-detail', compact('order'));
    }

    public function stats()
    {
        // Recupera l'ID del ristorante dell'utente autenticato
        $restaurant = Restaurant::where('user_id', Auth::id())->first();


        // Recupera l'ID del ristorante
        $restaurant_id = $restaurant->id;

        // Inizializza un array vuoto per i totali mensili
        $monthlyTotals = [];

        // Loop attraverso i 12 mesi precedenti, inclusi i mesi attuali
        for ($i = 0; $i < 12; $i++) {
            // Ottieni il mese corrente
            $currentMonth = now()->subMonthsNoOverflow($i)->format('Y-m');

            // Recupera gli ordini relativi al ristorante corrente per il mese corrente
            $orders = Order::whereHas('plates', function ($query) use ($restaurant_id) {
                $query->where('restaurant_id', $restaurant_id);
            })->whereYear('created_at', now()->subMonthsNoOverflow($i)->year)
                ->whereMonth('created_at', now()->subMonthsNoOverflow($i)->month)
                ->get();

            // Calcola il totale degli ordini per il mese corrente
            $monthlyTotals[$currentMonth] = $orders->sum('total');
        }
        // Ottieni l'elenco dei mesi nell'ordine corretto
        
        // Riempire gli eventuali mesi mancanti con totali nulli
        for ($i = 0; $i < 12; $i++) {
            $currentMonth = now()->subMonthsNoOverflow($i)->format('Y-m');
            if (!isset($monthlyTotals[$currentMonth])) {
                $monthlyTotals[$currentMonth] = 0;
            }
        }

        $sorted = ksort($monthlyTotals);
        
        $labels = array_keys($monthlyTotals);
        // Ordina l'array per garantire che i mesi siano in ordine cronologico
        

        // Estrai i totali mensili
        $totals = array_values($monthlyTotals);

        $chartjs = app()->chartjs
            ->name('barChart')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Totals",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    "data" => $totals,
                    "fill" => false,
                ],
            ])
            ->options([]);


        // Passa i dati alla vista
        return view('orders.order-stats', compact('chartjs', 'totals', 'monthlyTotals'));
    }
}
