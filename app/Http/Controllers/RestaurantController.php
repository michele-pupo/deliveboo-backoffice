<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Contracts\View\View;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    // this sends to the dashboard where a restaurant owner can review their information,
    // access the menu, and see their stats
    public function index()
    {
        // takes from db only restaurants with user_id matching current logged in user
        // first() returns only the first element of the collection
        // this would have to be changed to get() to manage multiple items
        $restaurant = Restaurant::where('user_id', Auth::id())->first();
        $user = Auth::user();
        return view('dashboard', compact('restaurant', 'user'));
    }

    // form to insert restaurant information
    public function create()
    {
        $categories = Category::all();

        // if the user already has a restaurant in the db, then they are redirected to their dashboard
        if(Restaurant::all()->contains('user_id', Auth::id())){
            return redirect()->action([RestaurantController::class, 'index']);
        }else{
            return view('auth/registerRestaurant', compact('categories'));
        }
    }

    public function store(StoreRestaurantRequest $request)
    {
        // validated by StoreRestaurantRequest
        $request->validated();

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($request->all());
        $newRestaurant->user_id = Auth::id();
        $img_path = Storage::disk('public')->put('restaurant_images', $request->img_res);
        $newRestaurant->img_res = $img_path;
        $newRestaurant->save();

        $newRestaurant->categories()->attach($request->categories);

        return redirect('dashboard');
    }

}
