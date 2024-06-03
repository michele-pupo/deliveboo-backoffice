<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(['orders.order-stats', 'orders.order-summary'], function ($view) {
            // Recupera l'ID del ristorante dell'utente autenticato
            $restaurant = Restaurant::where('user_id', Auth::id())->first();
            $restaurant_id = $restaurant->id;

            // Inizializza un array vuoto per i totali mensili con chiavi dei mesi e valori a zero
            $monthlyTotals = [];
            for ($i = 0; $i < 12; $i++) {
                $currentMonth = now()->subMonthsNoOverflow($i)->startOfMonth()->format('Y-m');
                $monthlyTotals[$currentMonth] = 0;
            }

            // Recupera tutti gli ordini relativi al ristorante dell'ultimo anno
            $orders = Order::whereHas('plates', function ($query) use ($restaurant_id) {
                $query->where('restaurant_id', $restaurant_id);
            })->where('created_at', '>=', now()->subYear()->startOfMonth())->get();

            // Aggrega i totali mensili
            foreach ($orders as $order) {
                $month = $order->created_at->format('Y-m');
                if (isset($monthlyTotals[$month])) {
                    $monthlyTotals[$month] += $order->total;
                }
            }

            // Ordina l'array per garantire che i mesi siano in ordine cronologico
            ksort($monthlyTotals);

            // Estrai le etichette dei mesi e i totali mensili
            $labels = array_keys($monthlyTotals);
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

            $view->with(compact('chartjs', 'totals', 'monthlyTotals'));
        });
    }
}
