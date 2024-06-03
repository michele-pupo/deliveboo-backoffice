<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('auth.register', compact('categories'));


    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'vat_number' => ['required', 'string', 'max:11', 'min:11', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],


            // Restaurant
            'name_res' => 'required|max:100',
            'categories' => 'required|array|min:1',
            'address_res' => 'required|max:100',
            'img_res' => 'required|mimes:jpg, bmp, png, svg',
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'vat_number' => $request->vat_number,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

       
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
