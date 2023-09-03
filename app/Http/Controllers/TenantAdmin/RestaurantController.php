<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Events\RestaurantCreatedEvent;
use App\Http\Controllers\Controller;
use App\Managers\TenantDataManger;
use App\Models\Restaurant;
use App\Traits\UploadImageTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RestaurantController extends Controller
{
    use UploadImageTrait;

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenantadmin.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'name' => 'required|string',
            'domain' => 'required|string',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg',
            'contact_info' => 'required|json'
        ])->validate();
        $uploadedImagePath = $this->uploadImage($request->file('profile_photo'));
        DB::beginTransaction();
        try {
            $restaurant_data = $request->except('profile_photo');
            $restaurant_data['profile_photo'] = $uploadedImagePath;
            $restaurant = Restaurant::create($restaurant_data);
            $user = Auth::guard('web')->user();
            $user->restaurant_id = $restaurant->id;
            $user->save();
            DB::commit();
            event(new RestaurantCreatedEvent($restaurant));
            return redirect()->back()->with('success', 'Restaurant created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }


    }

    /**
     * Display the specified resource.
     * @throws BindingResolutionException
     */
    public function show()
    {
        $restaurant = Restaurant::where('id', TenantDataManger::getTenantRestaurant()->id)->first();
        return view('tenantadmin.restaurant.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @throws ValidationException
     */
    public function checkDomain(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain' => [
                'required',
                'string',
                'unique:restaurants,domain',
                'regex:/^[a-zA-Z0-9-]+\.zmenu\.test$/'
            ]
        ]);

        if ($validator->fails()) {
            return response()->json(['valid' => false]);
        }

        return response()->json(['valid' => true]);
    }
}
