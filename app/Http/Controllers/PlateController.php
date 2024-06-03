<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Http\Requests\StorePlateRequest;
use App\Http\Requests\UpdatePlateRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        $plates = Plate::where('restaurant_id', $restaurant->id)->get(); 

        return view('plates.index', compact('plates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlateRequest $request)
    {

        $request->validated();

        $newPlate = new Plate();
        // ci siamo riportati l'id del ristorante e lo abbiamo associato all'id del nuovo piatto..

        $newPlate->fill($request->all());
        $restaurant = Restaurant::where('user_id', Auth::id())->first();
        $newPlate->restaurant_id = $restaurant->id;
        if ($request->hasFile('image')){
            $plateImg = Storage::disk('public')->put('plate_images', $request->image);
            $newPlate->image = $plateImg;
        }
        $newPlate->save();   

        return redirect(route('plates.index'));
    }

    /**
     * Display the specified resource.
     */

    // a user can access show and edit pages only if the plate belongs to their restaurant
    public function show(Plate $plate)
    {
        $restaurant = Restaurant::where('id', $plate->restaurant_id)->first();
        if($restaurant->id == Auth::id()){
            return view('plates.show', compact('plate'));
        } else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plate $plate)
    {
        $restaurant = Restaurant::where('id', $plate->restaurant_id)->first();
        if($restaurant->user_id == Auth::id()){
            return view('plates.edit', compact('plate'));
        } else{
            abort(404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlateRequest $request, Plate $plate)
    {

        $request->validated();
        
        $plate->fill($request->all());

        if ($request -> visible == null){
            $plate-> visible = 0;
        }

        if ($request->hasFile('image')){
            $plateImg = Storage::disk('public')->put('plate_images', $request->image);
            $plate->image = $plateImg;
        }


        $plate->save();

        return redirect()->route('plates.show', compact('plate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plate $plate)
    {
        $plate->delete();

        return redirect()->route('plates.index');
    }
}
