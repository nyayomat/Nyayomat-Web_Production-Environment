@extends('admin.layouts.master')

@php
	$can_update = Gate::allows('update', $system) ?: Null;
@endphp

@section('content')
	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#general_settings_tab" data-toggle="tab">
					<i class="fa fa-cubes hidden-sm"></i>
					{{ trans('app.general_settings') }}
				</a></li>

			</ul>
			<div class="tab-content">
			    <div class="tab-pane active" id="general_settings_tab">
			    	<div class="row">
				        {!! Form::model($system, ['method' => 'PUT', 'route' => ['admin.setting.basic.system.update'], 'files' => true, 'id' => 'form', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
					    	<div class="col-sm-9">
								<div class="form-group">
									{!! Form::label('name', '*' . trans('app.marketplace_name') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
							        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.marketplace_name') }}"></i>
								  	<div class="col-sm-8 nopadding-left">
								  		@if($can_update)
								  			{!! Form::text('name', $system->name, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.marketplace_name'), 'required']) !!}
									  		<div class="help-block with-errors"></div>
										@else
											<span class="lead">{{ $system->name }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
									{!! Form::label('slogan', trans('app.form.slogan') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
							        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.system_slogan') }}"></i>
								  	<div class="col-sm-8 nopadding-left">
								  		@if($can_update)
								  			{!! Form::text('slogan', $system->slogan, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.slogan')]) !!}
										@else
											<span>{{ $system->slogan }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
									{!! Form::label('legal_name', '*' . trans('app.legal_name') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
							        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.system_legal_name') }}"></i>
								  	<div class="col-sm-8 nopadding-left">
								  		@if($can_update)
								  			{!! Form::text('legal_name', $system->legal_name, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.legal_name'), 'required']) !!}
									  		<div class="help-block with-errors"></div>
										@else
											<span>{{ $system->legal_name }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
									{!! Form::label('email', '*' . trans('app.form.email_address'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
							        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.system_email') }}"></i>
								  	<div class="col-sm-8 nopadding-left">
								  		@if($can_update)
											{!! Form::email('email', $system->email, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.valid_email'), 'required']) !!}
									  		<div class="help-block with-errors"></div>
										@else
											<span>{{ $system->email }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('timezone_id', '*' . trans('app.form.timezone'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.system_timezone') }}"></i>
								  	<div class="col-sm-8 nopadding-left">
								  		@if($can_update)
									        {!! Form::select('timezone_id', $timezones , $system->timezone_id, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.timezone'), 'required']) !!}
									  		<div class="help-block with-errors"></div>
										@else
											<span>{{ $system->timezone->text }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('currency_id', '*' . trans('app.form.system_currency'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.system_currency') }}"></i>
								  	<div class="col-sm-8 nopadding-left">
								  		@if($can_update)
									        {!! Form::select('currency_id', $currencies , $system->currency_id, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.system_currency'), 'required']) !!}
									  		<div class="help-block with-errors"></div>
										@else
											<span>{{ $system->timezone->text }}</span>
										@endif
								  	</div>
								</div>

						  		@if($can_update)
									<div class="form-group">
										<label for="exampleInputFile" class="with-help col-sm-3 control-label"> {{ trans('app.form.logo') }}</label>
								      	<div class="col-md-6 nopadding">
											<input id="uploadFile" placeholder="{{ trans('app.placeholder.logo') }}" class="form-control" disabled="disabled" style="height: 28px;" />
									  		<div class="help-block with-errors">{{ trans('help.brand_logo_size') }}</div>
								    	</div>
									    <div class="col-md-2 nopadding-left">
										  	<div class="fileUpload btn btn-success btn-block btn-flat">
										      <span>{{ trans('app.form.upload') }}</span>
											    <input type="file" name="logo" id="uploadBtn" class="upload" />
									      	</div>
									    </div>
									</div>

									<div class="form-group">
										<label for="exampleInputFile" class="with-help col-sm-3 control-label"> {{ trans('app.form.icon') }}</label>
								      	<div class="col-md-6 nopadding">
											<input id="uploadFile1" placeholder="{{ trans('app.placeholder.icon') }}" class="form-control" disabled="disabled" style="height: 28px;" />
									  		<div class="help-block with-errors">{{ trans('help.brand_icon_size') }}</div>
								    	</div>
									    <div class="col-md-2 nopadding-left">
										  	<div class="fileUpload btn btn-success btn-block btn-flat">
										      <span>{{ trans('app.form.upload') }}</span>
											    <input type="file" name="icon" id="uploadBtn1" class="upload" />
									      	</div>
									    </div>
									</div>
								@endif

								<p class="help-block">* {{ trans('app.form.required_fields') }}</p>

						  		@if($can_update)
									<div class="col-md-offset-3">
							            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-flat btn-success']) !!}
							        </div>
						  		@endif
					    	</div>

					        <div class="col-sm-3">
						    	@if($can_update)
									<div class="form-group text-center">
										{!! Form::label('maintenance_mode', trans('app.form.maintenance_mode'), ['class' => 'control-label with-help']) !!}
									  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.system_maintenance_mode_handle') }}"></i>

									  	<div class="handle">
											<a href="{{ route('admin.setting.system.maintenanceMode.toggle') }}" type="button" class="toggle-confirm btn btn-lg btn-secondary btn-toggle {{ $system->maintenance_mode == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $system->maintenance_mode == 1 ? 'true' : 'false' }}" autocomplete="off">
												<div class="btn-handle"></div>
											</a>
									  	</div>
									</div>
						        @endif

								<div class="text-center">
									<div class="form-group">
										{!! Form::label('address', trans('app.address'), ['class' => 'control-label with-help']) !!}
									  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.system_physical_address') }}"></i>
									</div>

									@if($system->primaryAddress)

										{!! $system->primaryAddress->toHtml() !!}

										<a href="#" data-link="{{ route('address.edit', $system->primaryAddress->id) }}"  class="btn btn-success ajax-modal-btn"><i class="fa fa-map-marker"></i> {{ trans('app.update_address') }}</a>
									@else
										<a href="#" data-link="{{ route('address.create', ['system', $system->id]) }}"  class="btn btn-success ajax-modal-btn"><i class="fa fa-plus-square-o"></i> {{ trans('app.add_address') }}</a>
									@endif

							        <div class="spacer30"></div>
								</div>

							  	@if( Storage::exists('icon.png') )
									<div class="form-group text-center">
										<label class="with-help control-label"> {{ trans('app.icon') }}: </label>
										<img src="{{ Storage::url('icon.png') }}" class="brand-icon" alt="{{ trans('app.icon') }}">
									</div>
							  	@endif

							  	@if( Storage::url('logo.png') )
									<div class="form-group text-center">
										<label class="with-help control-label"> {{ trans('app.logo') }}: </label>
										<img src="{{ Storage::url('logo.png') }}" class="brand-logo sm" alt="{{ trans('app.logo') }}">
									</div>
							  	@endif
							</div>
				        {!! Form::close() !!}
			    	</div>
			    </div><!-- /.tab-pane -->


			</div><!-- /.tab-content -->
	    </div> <!-- /.nav-tabs-custom -->
	</div> <!-- /.box -->
@endsection