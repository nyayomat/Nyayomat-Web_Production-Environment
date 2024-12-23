
 <section style="margin-top:30px;margin-bottom: 30px; padding:10px;">
   <div class="container">
     <div class="row">
       <div class="col-md-12 nopadding">

         @include('sliders.category', ['category' => $all_categories])

       </div>
     </div>
   </div>
 </section>
 <section>

   <div class="container">
     <div class="row space30">

       @if(Session::has('error'))
       <div class="notice notice-danger notice-sm">
         <strong>{{ trans('theme.error') }}</strong> {{ Session::get('error') }}
       </div>
       @endif

       <div class="notice notice-warning notice-sm space20" id="checkout-notice"
         style="display: {{ ($cart->shipping_rate_id || $cart->is_free_shipping()) ? 'none' : 'block' }};">
         <strong>{{ trans('theme.warning') }}</strong>
         <span id="checkout-notice-msg">@lang('theme.notify.seller_doesnt_ship')</span>
       </div>

       <div class="col-md-3 bg-light">
         <div class="seller-info">
           <div class="text-muted small">@lang('theme.sold_by')</div>

           <img src="{{ get_storage_file_url(optional($shop->image)->path, 'tiny') }}"
             class="seller-info-logo img-sm img-circle" alt="{{ trans('theme.logo') }}">

           <a href="{{ route('show.store', $shop->slug) }}" class="seller-info-name">
             {{ $shop->name }}
           </a>
         </div><!-- /.seller-info -->

         <hr class="style1 muted" />

         <h3 class="widget-title">{{ trans('theme.order_info') }}</h3>
         <ul class="shopping-cart-summary ">
           <li>
             <span>{{ trans('theme.item_count') }}</span>
             <span>{{ $cart->quantity }}</span>
           </li>
           <li>
             <span>{{ trans('theme.subtotal') }}</span>
             <span>{{ round($cart->total, 2) }} KSh</span>
           </li>
           <li>
             <span>{{ trans('theme.shipping') }}</span>
             <span>
               {{-- $cart->get_shipping_cost() > 0 ? round($cart->get_shipping_cost(), 2) KSh : trans('theme.free_shipping') --}}

               @if($cart->get_shipping_cost() >0)
               {{ round($cart->get_shipping_cost(), 2)  }} KSh
               @else
               {{ trans('theme.free_shipping') }}
               @endif
             </span>
           </li>
           @if($cart->packaging > 0)
           <li>
             <span>{{ trans('theme.packaging') }}</span>
             <span>{{ round($cart->packaging, 2) }} KSh</span>
           </li>
           @endif
           <li>
             <span>{{ trans('theme.discount') }}</span>
             <span>-{{ round($cart->discount, 2) }} KSh</span>
           </li>
           @if($cart->taxes > 0)
           <li>
             <span>{{ trans('theme.taxes') }}</span>
             <span>{{ round($cart->taxes, 2) }} KSh</span>
           </li>
           @endif
           <li>
             <span class="lead">{{ trans('theme.total') }}</span>
             <span class="lead">{{ round($cart->grand_total(), 2) }} KSh</span>
           </li>
         </ul>

         <hr class="style1 muted" />

         <div class="clearfix"></div>

         <div class="text-center space20" style="display:flex">
           <a class="btn btn-success flat" href="{{ route('cart.index') }}">{{ trans('theme.button.update_cart') }}</a>
           <form method="POST" action="{{route('countrywise')}}" style="margin-left:2px">
             @csrf
             <button type="submit" class="btn btn-success flat">{{ trans('theme.button.continue_shopping') }}</button>
           </form>
         </div>
       </div> <!-- /.col-md-3 -->
       {!! Form::open(['route' => ['order.create', $cart], 'id' => 'checkoutForm', 'data-toggle' => 'validator', 'novalidate']) !!}

       <div class="col-md-5">
         <h3 class="widget-title">{{ trans('theme.ship_to') }}</h3>
         @if(isset($customer))
         <div class="row customer-address-list">
           @php
           $pre_select = Null;
           @endphp
           @foreach($customer->addresses as $address)
           @php
           $ship_to_this_address = Null;
           if($pre_select == Null){ // If any address not selected yet
           if($customer->addresses->count() == 1) { // Has onely address
           $pre_select = 1; $ship_to_this_address = TRUE;
           }
           elseif(Request::has('address')) { // Just created this address
           if(request()->address == $address->id){
           $pre_select = 1; $ship_to_this_address = TRUE;
           }
           }
           elseif($cart->ship_to == $address->country_id) { // Zone selected at cart page
           $pre_select = 1; $ship_to_this_address = TRUE;
           }
           elseif($cart->ship_to == Null && $address->address_type === 'Shipping') { // Customer's shipping address
           $pre_select = 1; $ship_to_this_address = TRUE;
           }
           }
           @endphp

           <div class="col-sm-12 col-md-6 nopadding-{{ $loop->iteration%2 == 1 ? 'right' : 'left'}}">
             <div class="address-list-item {{ $ship_to_this_address == true ? 'selected' : '' }}">
               {!! $address->toHtml('<br />', false) !!}
               <input type="radio" class="ship-to-address" name="ship_to" value="{{$address->id}}"
                 {{ $ship_to_this_address == true ? 'checked' : '' }} data-country="{{$address->country_id}}" required>
             </div>
           </div>
           @if($loop->iteration%2 == 0)
           <div class="clearfix"></div>
           @endif
           @endforeach
         </div>

         <small id="ship-to-error-block" class="text-danger pull-right"></small>

         <div class="space20"></div>
         <a href="#" data-toggle="modal" data-target="#createAddressModal" class="btn btn-success btn-sm flat space20">
           <i class="fa fa-address-card-o"></i> @lang('theme.button.add_new_address')
         </a>
         @else
         @include('forms.address')

         <div class="form-group">
           {!! Form::email('email', Null, ['class' => 'form-control flat', 'placeholder' =>
           trans('theme.placeholder.email'), 'maxlength' => '100', 'required']) !!}
           <div class="help-block with-errors"></div>
         </div>

         <div class="checkbox">
           <label>
             {!! Form::checkbox('create-account', Null, Null, ['id' => 'create-account-checkbox', 'class' => 'i-check'])
             !!} {!! trans('theme.create_account') !!}
           </label>
         </div>

         <div id="create-account" class="space30" style="display: none;">
           <div class="row">
             <div class="col-md-6 nopadding-right">
               <div class="form-group">
                 {!! Form::password('password', ['class' => 'form-control flat', 'id' => 'acc-password', 'placeholder'
                 => trans('theme.placeholder.password'), 'data-minlength' => '6']) !!}
                 <div class="help-block with-errors"></div>
               </div>
             </div>
             <div class="col-md-6 nopadding-left">
               <div class="form-group">
                 {!! Form::password('password_confirmation', ['class' => 'form-control flat', 'placeholder' =>
                 trans('theme.placeholder.confirm_password'), 'data-match' => '#acc-password']) !!}
                 <div class="help-block with-errors"></div>
               </div>
             </div>
           </div>

           @if(config('system_settings.ask_customer_for_email_subscription'))
           <div class="checkbox">
             <label>
               {!! Form::checkbox('subscribe', null, null, ['class' => 'i-check']) !!} {!!
               trans('theme.input_label.subscribe_to_the_newsletter') !!}
             </label>
           </div>
           @endif

           <p class="text-info small">
             <i class="fa fa-info-circle"></i>
             {!! trans('theme.help.create_account_on_checkout', ['link' =>
             get_page_url(\App\Page::PAGE_TNC_FOR_CUSTOMER)]) !!}
           </p>
         </div>

         {{-- <small class="help-block text-muted pull-right">* {{ trans('theme.help.required_fields') }}</small> --}}
         @endif

         <hr class="style4 muted" />

         <div class="form-group">
           {!! Form::label('buyer_note', trans('theme.leave_message_to_seller')) !!}
           {!! Form::textarea('buyer_note', Null, ['class' => 'form-control flat summernote-without-toolbar',
           'placeholder' => trans('theme.placeholder.message_to_seller'), 'rows' => '2', 'maxlength' => '250']) !!}
           <div class="help-block with-errors"></div>
         </div>
       </div> <!-- /.col-md-5 -->

       <div class="col-md-4">
         <h3 class="widget-title">{{ trans('theme.payment_options') }}</h3>
         @php
         $activeManualPaymentMethods = $shop->manualPaymentMethods;
         @endphp

         <div class="space30">
           <div class="form-group">
             <label class="">
               <div class="iradio_minimal-blue" style="position: relative;"><input name="payment_method" value="1"
                   data-code="stripe" class="i-radio-blue payment-option" type="radio"
                   data-info="For users whose Contact or Registered Account number is Safaricom." data-type="3"
                   required="required" style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                   style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
               </div>MPESA
             </label>
           </div>

           <div class="form-group">
             <label class="hover">
               <div class="iradio_minimal-blue hover" style="position: relative;"><input name="payment_method" value="6"
                   data-code="cod" class="i-radio-blue payment-option" type="radio" data-info="" data-type="3"
                   required="required" style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                   style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
               </div> Cash On Delivery
             </label>
           </div>

         </div>

         {{-- authorize-net --}}
         <!--<div id="authorize-net-cc-form" class="authorize-net-cc-form" style="display: none;">-->
         <!--  <hr class="style4 muted">-->
         <!--  <div class="stripe-errors alert alert-danger flat small hide">{{ trans('messages.trouble_validating_card') }}</div>-->
         <!--  <div class="form-group form-group-cc-name">-->
         <!--    {!! Form::text('cardholder_name', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.cardholder_name'), 'data-error' => trans('theme.help.enter_cardholder_name')]) !!}-->
         <!--    <div class="help-block with-errors"></div>-->
         <!--  </div>-->
         <!--  <div class="form-group form-group-cc-number">-->
         <!--    {!! Form::text('cnumber', Null, ['id' => 'cnumber', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_number')]) !!}-->
         <!--    <div class="help-block with-errors"></div>-->
         <!--  </div>-->
         <!--  <div class="form-group form-group-cc-cvc">-->
         <!--    {!! Form::text('ccode', Null, ['id' => 'ccode', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_cvc')]) !!}-->
         <!--    <div class="help-block with-errors"></div>-->
         <!--  </div>-->

         <!--  <div class="row">-->
         <!--    <div class="col-md-6 nopadding-right">-->
         <!--      <div class="form-group has-feedback">-->
         <!--        {{ Form::selectMonth('card_expiry_month', Null, ['id' =>'card_expiry_month', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_exp_month'), 'data-error' => trans('theme.help.card_exp_month')], '%m') }}-->
         <!--        <div class="help-block with-errors"></div>-->
         <!--      </div>-->
         <!--    </div>-->

         <!--    <div class="col-md-6 nopadding-left">-->
         <!--      <div class="form-group has-feedback">-->
         <!--        {{ Form::selectYear('card_expiry_year', date('Y'), date('Y') + 10, Null, ['id' =>'card_expiry_year', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_exp_year'), 'data-error' => trans('theme.help.card_exp_year')]) }}-->
         <!--        <div class="help-block with-errors"></div>-->
         <!--      </div>-->
         <!--    </div>-->
         <!--  </div>-->

         <!--  <div class="checkbox">-->
         <!--    <label>-->
         <!--      {!! Form::checkbox('remember_the_card', null, null, ['id' => 'remember-the-card', 'class' => 'i-check']) !!} {!! trans('theme.remember_card_for_future_use') !!}-->
         <!--    </label>-->
         <!--  </div>-->
         <!--</div> -->
         <!-- /#authorize-net-cc-form -->

         {{-- Stripe --}}
         <!--<div id="cc-form" class="cc-form" style="display: none;">-->
         <!--  <hr class="style4 muted">-->
         <!--  <div class="stripe-errors alert alert-danger flat small hide">{{ trans('messages.trouble_validating_card') }}</div>-->
         <!--  <div class="form-group form-group-cc-name">-->
         <!--    {!! Form::text('name', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.cardholder_name'), 'data-error' => trans('theme.help.enter_cardholder_name'), 'data-stripe' => 'name']) !!}-->
         <!--    <div class="help-block with-errors"></div>-->
         <!--  </div>-->
         <!--  <div class="form-group form-group-cc-number">-->
         <!--    <input type="text" class='form-control flat' placeholder="@lang('theme.placeholder.card_number')" data-stripe='number'/>-->
         <!--    <div class="help-block with-errors"></div>-->
         <!--  </div>-->
         <!--  <div class="form-group form-group-cc-cvc">-->
         <!--    <input type="text" class='form-control flat' placeholder="@lang('theme.placeholder.card_cvc')" data-stripe='cvc'/>-->
         <!--    <div class="help-block with-errors"></div>-->
         <!--  </div>-->

         <!--  <div class="row">-->
         <!--    <div class="col-md-6 nopadding-right">-->
         <!--      <div class="form-group has-feedback">-->
         <!--        {{ Form::selectMonth('exp-month', Null, ['id' =>'exp-month', 'class' => 'form-control flat', 'data-stripe' => 'exp-month', 'placeholder' => trans('theme.placeholder.card_exp_month'), 'data-error' => trans('theme.help.card_exp_month')], '%m') }}-->
         <!--        <div class="help-block with-errors"></div>-->
         <!--      </div>-->
         <!--    </div>-->

         <!--    <div class="col-md-6 nopadding-left">-->
         <!--      <div class="form-group has-feedback">-->
         <!--        {{ Form::selectYear('exp-year', date('Y'), date('Y') + 10, Null, ['id' =>'exp-year', 'class' => 'form-control flat', 'data-stripe' => 'exp-year', 'placeholder' => trans('theme.placeholder.card_exp_year'), 'data-error' => trans('theme.help.card_exp_year')]) }}-->
         <!--        <div class="help-block with-errors"></div>-->
         <!--      </div>-->
         <!--    </div>-->
         <!--  </div>-->

         <!--  <div class="checkbox">-->
         <!--    <label>-->
         <!--      {!! Form::checkbox('remember_the_card', null, null, ['id' => 'remember-the-card', 'class' => 'i-check']) !!} {!! trans('theme.remember_card_for_future_use') !!}-->
         <!--    </label>-->
         <!--  </div>-->
         <!--</div> -->
         <!-- /#cc-form -->

         <p id="payment-instructions" class="text-info small space30">
           <i class="fa fa-info-circle"></i>
           <span>@lang('theme.placeholder.select_payment_option')</span>
         </p>

         <div id="submit-btn-block" class="clearfix space30" style="display: none;">
           <button id="" class="btn btn-success btn-lg btn-block nyayom-btn" type="submit">
             <small><i class="fa fa-shield"></i> <span
                 id="pay-now-btn-txt">@lang('theme.button.checkout')</span></small>
           </button>

         </div>
       </div> <!-- /.col-md-4 -->
     </div><!-- /.row -->
     {!! Form::close() !!}
   </div>
 </section>

 @if(isset($customer))
 @include('modals.create_address')
 @endif


