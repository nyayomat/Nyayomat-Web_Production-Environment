<?php

namespace App\Http\Controllers\Storefront;

use Auth;
use View;
use App\City;
use App\Address;
use App\Customer;
use App\Wishlist;
use App\Location;
use App\Helpers\ListHelper;
// use App\Events\Profile\ProfileUpdated;
// use App\Events\Profile\PasswordUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateAddressRequest;
use App\Http\Requests\Validations\SelfAvatarUpdateRequest;
use App\Http\Requests\Validations\SelfAddressDeleteRequest;
use App\Http\Requests\Validations\SelfAddressUpdateRequest;
use App\Http\Requests\Validations\SelfPasswordUpdateRequest;

class AccountController extends Controller
{
    /**
     * Show the customer dashboard.
     *
     * @return Response
     *
     * @param mixed $tab
     */
    public function index($tab = 'dashboard')
    {
        // Auth::guard('customer')->loginUsingId(33);
        if (!method_exists($this, $tab)) {
            abort(404);
        }
        // echo print_r($this); exit;
        // Call the methods dynamically to load needed models
        $$tab = $this->$tab();
        $cities = City::get();

        return view('dashboard', compact('tab', $tab, 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (env('APP_DEMO') == true && Auth::guard('customer')->user()->id <= config('system.demo.customers', 1)) {
            return redirect()->route('account', 'account#account-info-tab')->with('warning', trans('messages.demo_restriction'));
        }

        Auth::guard('customer')->user()->update($request->all());

        return redirect()->route('account', 'account#account-info-tab')->with('success', trans('theme.notify.info_updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function password_update(SelfPasswordUpdateRequest $request)
    {
        if (env('APP_DEMO') == true && Auth::guard('customer')->user()->id <= config('system.demo.customers', 1)) {
            return redirect()->route('account', 'account#password-tab')->with('warning', trans('messages.demo_restriction'));
        }

        Auth::guard('customer')->user()->update($request->all());

        // event(new PasswordUpdated(Auth::user()));

        return redirect()->route('account', 'account#password-tab')->with('success', trans('theme.notify.info_updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function save_address(CreateAddressRequest $request)
    {
        $address = Auth::guard('customer')->user()->addresses()->create($request->all());

        return redirect()->to(url('my/account') . '?address=' . $address->id . '#address-tab')->with('success', trans('theme.notify.address_created'));
    }

    public function avatar(SelfAvatarUpdateRequest $request)
    {
        Auth::guard('customer')->user()->deleteImage();

        Auth::guard('customer')->user()->saveImage($request->file('avatar'));

        return redirect()->route('account', 'account#account-info-tab')->with('success', trans('theme.notify.info_updated'));
    }

    public function delete_avatar(Request $request)
    {
        Auth::guard('customer')->user()->deleteImage();

        return redirect()->route('account', 'account#account-info-tab')->with('success', trans('theme.notify.info_deleted'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Address $address
     *
     * @return \Illuminate\Http\Response
     */
    public function address_update(SelfAddressUpdateRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect()->route('account', 'account#address-tab')->with('success', trans('theme.notify.info_updated'));
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Address $address
     *
     * @return \Illuminate\Http\Response
     */
    public function address_delete(SelfAddressDeleteRequest $request, Address $address)
    {
        $address->delete();

        return redirect()->route('account', 'account#address-tab')->with('success', trans('theme.notify.address_deleted'));
    }

    /**
     * Load dashboard content.
     *
     * @return mix
     */
    private function dashboard()
    {
        return Customer::where('id', Auth::guard('customer')->user()->id)
        ->withCount(['orders', 'wishlists', 'pendingorder',
            'disputes' => function ($query) {
                $query->open();
            },
            'coupons' => function ($query) {
                $query->active();
            },
        ])->first();
    }

    /**
     * Return orders.
     *
     * @return collection
     */
    private function orders()
    {
        return Auth::guard('customer')->user()->orders()
        ->with(['shop:id,name,slug', 'inventories:id,title,slug,product_id', 'status'])->paginate(10);
    }

    private function pendingreviews()
    {
        return Auth::guard('customer')->user()->orders()
        ->with(['shop:id,name,slug', 'inventories:id,title,slug,product_id', 'status'])->paginate(10);
    }

    /**
     * Return wishlist.
     *
     * @return collection
     */
    private function wishlist()
    {
        return Wishlist::mine()->with(['inventory', 'inventory.feedbacks:rating,feedbackable_id,feedbackable_type', 'inventory.images:path,imageable_id,imageable_type'])->paginate(7);
    }

    /**
     * Return disputes.
     *
     * @return collection
     */
    private function disputes()
    {
        return Auth::guard('customer')->user()->disputes()
        ->with(['shop:id,name,slug', 'order.inventories:product_id,slug', 'order.inventories.image', 'order.inventories.product'])
        ->paginate(10);
    }

    /**
     * Return coupons.
     *
     * @return collection
     */
    private function coupons()
    {
        return Auth::guard('customer')->user()->coupons()
        ->active()->with('shop:id,name,slug')->paginate(20);
    }

    /**
     * Return account info.
     *
     * @return collection
     */
    private function account()
    {
        //Supply important data to the views
        View::share('address_types', ListHelper::address_types());
        View::share('countries', ListHelper::countries());
        View::share('cities_list', ListHelper::cities());
        
        $regions = ListHelper::regions();
        $c_location = Location::where('id', 8)->first();
        $c_region = ListHelper::region($c_location->region);
        $c_city = City::where('id', $c_region->city)->first();
        
        View::share('regions', $regions);
        View::share('c_location', $c_location);
        View::share('c_region', $c_region);
        View::share('c_city', $c_city);
        

        return Auth::guard('customer')->user();
    }

    /**
     * Return gift_cards.
     *
     * @return collection
     */
    private function gift_cards()
    {
        return Auth::guard('customer')->user()->gift_cards()->paginate(20);
    }
}
