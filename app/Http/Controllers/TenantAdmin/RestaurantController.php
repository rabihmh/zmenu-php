<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Events\RestaurantCreatedEvent;
use App\Http\Controllers\Controller;
use App\Managers\TenantDataManger;
use App\Models\Restaurant;
use App\Traits\UploadImageTrait;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RestaurantController extends Controller
{
    use UploadImageTrait;

    public function create()
    {
        return view('tenantadmin.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'domain' => 'required|string',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg',
            'contact_info' => 'required|json'
        ])->validate();
        $uploadedImagePath = $this->uploadImage($request->file('profile_photo'), Str::slug($request->post('name')),);
        DB::beginTransaction();
        try {
            $restaurant_data = $request->except('profile_photo', 'contact_info');
            $restaurant_data['profile_photo'] = $uploadedImagePath;
            $restaurant_data['contact_info'] = json_decode($request->input('contact_info'));
            $restaurant = Restaurant::create($restaurant_data);
            $user = Auth::guard('web')->user();
            $user->restaurant_id = $restaurant->id;
            $user->save();
            event(new RestaurantCreatedEvent($restaurant));
            DB::commit();
            return redirect()->route('tenant.admin.restaurant.show')->with('success', 'Restaurant created successfully');
        } catch (Exception $exception) {
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $request->all();
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
    public function checkDomain(Request $request): JsonResponse
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
