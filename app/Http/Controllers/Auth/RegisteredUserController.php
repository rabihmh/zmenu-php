<?php

namespace App\Http\Controllers\Auth;

use App\Events\RestaurantCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $domain = Str::slug($request->post('name')) . '.zmenu.test';
        DB::beginTransaction();
        try {
            $restaurant = Restaurant::create([
                'name' => $request->post('name'),
                'domain' => $domain
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'restaurant_id' => $restaurant->id,
            ]);
            DB::commit();
            //event(new Registered($user));
            event(new RestaurantCreatedEvent($restaurant));
            Auth::login($user);

        } catch (\Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
