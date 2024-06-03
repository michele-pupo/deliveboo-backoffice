<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();

        return response()->json([
            "success" => true,
            "results" => $categories,
        ]);
    }

    // public function filter(Request $request) {
    //     $filtered = Restaurant::with('categories')
    //                           ->whereHas('categories', function($query) use ($request) {
    //                               $query->whereIn('categories.id', $request->queryId);
    //                           })
    //                           ->distinct()
    //                           ->get();
    
    //     return response()->json([
    //         "success" => true,
    //         "results" => $filtered,
    //     ]);
    // }

    public function filter(Request $request) {
        $categories = $request->queryId;
    
        // verifichiamo che ci siano categorie selezionate
        if (empty($categories)) {
            return response()->json([
                "success" => true,
                "results" => [],
            ]);
        }
    
        // istanza di query sul modello Restaurant
        $filtered = Restaurant::query();
    
        // ciclo su ogni categoria, viene applicato un filtro ai ristoranti della prima ricerca e 
        // mostra solo quelli con la categorie associate
        foreach ($categories as $categoryId) {
            $filtered->whereHas('categories', function($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            });
        }
    
        // viene applicato un ulteriore filtro con la clausola 'orWhereHas' 
        $filtered->where(function($query) use ($categories) {
            foreach ($categories as $categoryId) {
                $query->orWhereHas('categories', function($query) use ($categoryId) {
                    $query->where('categories.id', $categoryId);
                });
            }
        });
    
        // risultati ottenuti tramite il metodo get()
        $filtered = $filtered->with('categories')->get();
    
        // risposta json
        return response()->json([
            "success" => true,
            "results" => $filtered,
        ]);
    }

    public function menu($id) {

        $restaurant = Restaurant::with(['plates'=> function($query){
            $query->where('visible', true);
        }, 'categories'])
                                ->where('id', $id)
                                ->first();

        return response()->json([
            "success" => true,
            "results" => $restaurant,
        ]);
    }
}