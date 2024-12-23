<?php

namespace App\Http\Controllers\Auth;

use DB;
use Log;
use Auth;
use App\User;
use App\System;
use Illuminate\Http\Request;
use App\Events\Shop\ShopCreated;
use App\Jobs\CreateShopForMerchant;
use App\Http\Controllers\Controller;
use App\Jobs\SubscribeShopToNewPlan;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Validations\RegisterMerchantRequest;
use App\Notifications\Auth\SendVerificationEmail as EmailVerificationNotification;
use App\Notifications\SuperAdmin\VerdorRegistered as VerdorRegisteredNotification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('verify');
    }

    /**
     * Show the application registration form.
     *
     * @param  string  $plan subscription plan
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($plan = null)
    {
        
        //return view('auth.register', compact('plan'));
       return view('ecommerce_frontend.merchant.signup', compact('plan'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterMerchantRequest $request)
    {
        // Start transaction!
        // DB::beginTransaction();

        if (config('system_settings.required_card_upfront') && !$request->has('cc_token')) {
            // Set error message and return
            $error = new \Illuminate\Support\MessageBag();
            $error->add('errors', trans('messages.no_card_added'));

            return redirect()->route('register')->withErrors($error)->withInput();
        }

        try {
            $merchant = $this->create($request->all());
            $merchant->locations()->attach($request->locations);

            // Dispatching Shop create job

            $m_shop = CreateShopForMerchant::dispatch($merchant, $request->all());

            // Trigger after registration events
            $this->triggerAfterEvents($merchant);

            Auth::guard()->login($merchant);

            SubscribeShopToNewPlan::dispatch($merchant, $request->input('plan'), $request->input('cc_token'));
        } catch (\Exception $e) {
            // rollback the transaction and log the error
            DB::rollback();
            Log::error('Vendor Registration Failed: ' . $e->getMessage());

            // Set error messages:
            $error = new \Illuminate\Support\MessageBag();
            $error->add('errors', trans('responses.vendor_config_failed'));

            return redirect()->route('register')->withErrors($error)->withInput();
        }

        // Everything is fine. Now commit the transaction
        // DB::commit();

        // Send notification to Admin
        if (config('system_settings.notify_when_vendor_registered')) {
            $system = System::orderBy('id', 'asc')->first();
            $system->superAdmin()->notify(new VerdorRegisteredNotification($merchant));
        }
       
        // return $this->registered($request, $merchant) ?: redirect($this->redirectPath());
        return $this->registered($request, $merchant) ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'city' => $data['city'],
            'region' => $data['region'],
            // 'location' => implode(',', $data['location']),
            'mobile' => $data['mobile'],
            'verification_token' => str_random(40),
        ]);

        return $user;
    }

    /**
     * Trigger some events after a valid registration.
     *
     * @param  User  $merchant
     *
     * @return void
     */
    protected function triggerAfterEvents(User $merchant)
    {
        // Trigger the systems default event
        event(new Registered($merchant));

        // Trigger shop created event
        try {
            event(new ShopCreated($merchant->owns));
        } catch (\Throwable $th) {
        }

        return;
    }

    /**
     * Verify the User the given token.
     *
     * @param  string|null  $token
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($token = null)
    {
        if (!$token) {
            $user = Auth::user();

            $user->verification_token = str_random(40);

            if ($user->save()) {
                $user->notify(new EmailVerificationNotification($user));

                return redirect()->back()->with('success', trans('auth.verification_link_sent'));
            }

            return redirect()->back()->with('success', trans('auth.verification_link_sent'));
        }

        try {
            $user = User::where('verification_token', $token)->firstOrFail();

            $user->verification_token = null;

            if ($user->save()) {
                return redirect()->route('admin.admin.dashboard')->with('success', trans('auth.verification_successful'));
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.admin.dashboard')->with('error', trans('auth.verification_failed'));
        }
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     *
     * @return mixed
     */
    protected function registered($request, $user)
    {
    }
}
