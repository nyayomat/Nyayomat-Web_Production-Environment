@extends('layouts.backend.main', 
                        [
                            'title' => __("My Products"),
                            'page_name' => 'Products',
                            'bs_version' => 'bootstrap@4.6.0',
                            'left_nav_color' => '#036CB1',
                            'nav_icon_color' => '#AFA5D9',
                            'active_nav_icon_color' => '#fff',
                            'active_nav_icon_color_border' => 'greenyellow' ,
                            'top_nav_color' => '#F7F6FB',
                            'background_color' => '#F7F6FB',
                        ])

@push('link-css')
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    @verbatim
        <style>
            .collapse{
                width: 100%
            }

            .text-black{
                color: black
            }

            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }

            .bg-nyayomat-yellow{
                background-color: #ffbf0082 
            }
            /* // Small devices (landscape phones, 576px and up) */
            @media (min-width: 350px) {
                .big-money {
                    font-size: 4vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }
            }

            /* // Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {  }

            /* // Large devices (desktops, 992px and up) */
            @media (min-width: 992px) { }

            /* // Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) { 
                .big-money {
                    font-size: 2vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }
                .icon-size{
                    font-size: 7.0vh;
                }
            }
        </style>
    @endverbatim
@endpush

@push('link-js')
@endpush

@push('navs')
    <a href="{{route('merchant-overview')}}" class="nav_link"> 
        <i class='bx bx-grid-alt nav_icon'></i> 
        <span class="nav_name">
            Dashboard
        </span>
    </a>

    <a href="{{route('merchant-transactions')}}" class="nav_link">
        <i class='bx bx-money nav_icon'></i>
        <span class="nav_name">
            Transactions    
        </span> 
    </a> 

    <a href="{{route('merchant-stock')}}" class="nav_link"> 
        <i class='bx bx-coin-stack nav_icon'></i> 
        <span class="nav_name">
            Stock
        </span>
    </a>

    <a href="{{route('merchant-product')}}" class="nav_link active">
        <i class='bx bx-package nav_icon'></i>
        <span class="nav_name">
            Products &amp; Assets
        </span>
    </a>
  
    <a href="{{route('merchant-disputes')}}" class="nav_link"> 
        <i class='bx bx-alarm-exclamation nav_icon'></i> 
        <span class="nav_name">
            Disputes
        </span>
    </a>
    
    <a href="{{route('merchant-stats')}}" class="nav_link"> 
        <i class='bx bx-doughnut-chart nav_icon'></i>   
        <span class="nav_name">
            Statistics 
        </span> 
    </a> 

    <a href="{{route('merchant-notifications')}}" class="nav_link">
        <i class='bx bx-chat nav_icon'></i>
        <span class="nav_name">
            Notifications 
            <span class="d-md-inline-flex badge nav)n badge-circle mr-2 bg-white nyayomat-blue d-none">
                {{rand(1,10)}}
            </span>   
        </span> 
    </a> 
@endpush


@section('content')
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-primary ml-1">
                Products &amp; Assets
            </a>  
        </div>
    </div>

    <ul class="nav nav-pills nav-list mb-3" id="pills-tab" role="tablist">
        <li class="nav-item mr-2" role="presentation">
            <a class="nav-link active" id="pills-shop-tab" data-toggle="pill" href="#pills-shop" role="tab" aria-controls="pills-shop" aria-selected="true">
                Shop
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-acp-tab" data-toggle="pill" href="#pills-acp" role="tab" aria-controls="pills-acp" aria-selected="false">
                Asset Manager
            </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-shop" role="tabpanel" aria-labelledby="pills-shop-tab" style="">
            <div class="row">
                <h3 class="col-12 display-5 text-muted">
                    Products
                </h3>
            </div>
        
            <div class="row">
                <div class="col-12 text-right mb-3">
                    <a href="" class="btn btn-md btn-success mr-2">
                        CSV IMPORT
                    </a>
                    <a href="" class="btn btn-md btn-success">
                       ADD PRODUCT
                    </a>
                </div>
            </div>
            {{-- Table --}}
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th class="font-weight-normal" data-card-title>
                                    Img
                                </th>
                                <th class="font-weight-normal" data-card-title>
                                    Name
                                </th>
                                <th class="font-weight-normal" data-card-footer>
                                    Category Group
                                </th>
                                <th class="font-weight-normal" data-card-footer>
                                    Sub Category
                                </th>
                                <th class="font-weight-normal" data-card-footer>
                                    Product Code
                                </th>
                                <th class="font-weight-normal" data-card-footer>
                                    Condition
                                </th>
                                <th class="font-weight-normal" data-card-footer>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < rand(80,150) ; $i++)
                                <tr class="accordion" id="accordionExample2">
                                    <td>
                                        <i class="bx bx-landscape"></i>
                                    </td>
                                    <td nowrap>
                                        {{$product = Str::upper(Str::random(10))}}
                                    </td>
                                    <td nowrap class="font-weight-light">
                                        {{Str::random(10)}}
                                    </td>
                                    <td nowrap class="font-weight-light">
                                        {{Str::random(10)}}
                                    </td>
                                    <td nowrap class="font-weight-light">
                                        {{Str::random(10)}}
                                    </td>
                                    
                                    <td nowrap class="font-weight-light">
                                        
                                            @if ($i %2 == 0)
                                            <span class="text-info">
                                                    New  
                                                </span>
                                            @else
                                            <span class="text-danger">
                                                    Used  
                                                </span>
                                            @endif
                                        
                                    </td>
                                    <td nowrap class="font-weight-light">
                                        {{-- <a href="#{{$edit_promo = Str::random(10)}}" data-toggle="collapse" aria-expanded="false" aria-controls="{{$edit_promo}}" class="mb-3 collapsed btn font-weight-light btn-sm btn-warning mr-2">
                                            Suspend &nbsp;<i class="bx bx-pause ms-2"></i>
                                        </a>   --}}
                                        <a href="" class="nyayomat-blue mr-2">
                                            <i class="bx bx-edit"></i>
                                        </a>
        
                                        <a href="" class="nyayomat-blue mr-2">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                        {{-- <a href="#{{$delete_promo = Str::random(10)}}" data-toggle="collapse" aria-expanded="false" aria-controls="{{$delete_promo}}" class="mb-3 collapsed btn font-weight-light btn-sm btn-danger mr-2">
                                            Delete&nbsp;<i class="bx bx-trash ms-2"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                {{-- <tr id="{{$edit_promo}}" class="collapse  justify-content-center" aria-labelledby="{{$edit_promo}}" data-parent="#accordionExample2" style="transition: cubic-bezier(0.075, 0.82, 0.165, 1)">
                                    <td nowrap colspan="9" class="border-0 col-12 font-weight-light">
                                        <form action="" class="row mb-4">
                                            <div class="form-group font-weight-light col-12">
                                                <label for="promo-title">
                                                    Promotion Title / Name
                                                </label>
                                                <input type="text" class="form-control" id="promo-title" placeholder="Type here">
                                            </div>
                                
                                            <div class="form-group font-weight-light mt-3 col-12">
                                                <label for="description">
                                                    Description
                                                </label>
                                                <textarea rows="4" class="form-control" id="description" placeholder="Type here"></textarea>
                                            </div>
                                            <div class="form-group font-weight-light col-6">
                                                <label for="promo-title">
                                                    Qty
                                                </label>
                                                <input type="number" class="form-control" id="promo-title" placeholder="Type here">
                                            </div>
                                            <div class="form-group font-weight-light col-6">
                                                <label for="promo-title">
                                                    Cost
                                                </label>
                                                <input type="number" class="form-control" id="promo-title" placeholder="Type here">
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" class="btn col-12 btn-md btn-success" value="Update">
                                            </div>
                                        </form>
                                    </td>
                                </tr>
        
                                <tr id="{{$delete_promo}}" class="collapse col-12 justify-content-center" aria-labelledby="{{$delete_promo}}" data-parent="#accordionExample2" style="transition: cubic-bezier(0.075, 0.82, 0.165, 1)">
                                    <td colspan="3" class="border-0 font-weight-light">
                                        <form action="" class="row mb-4">
                                            <p class="font-weight-light col-12 text-center">
                                                You are about do delete
                                                <span class="text-danger mx-2">
                                                    {{$promo_title}} .
                                                </span>
                                                Do you wish to continue ?
                                            </p>
                                            <div class="col-12 text-center">
                                                <input type="submit" class="btn  btn-sm btn-danger" value="Delete">
                                            </div>
                                        </form>
                                    </td>
                                </tr> --}}
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-acp" role="tabpanel" aria-labelledby="pills-acp-tab">
            <div class="row">
                <h3 class="col-12 display-5 text-muted">
                    Assets
                </h3>
            </div>
            <div class="row mt-3">
                <h5 class="col-12 text-info  font-weight-lighter">
                    Payments
                </h5>
            </div>
            <nav>
                <div class="nav nav-list border-0 nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                        Due This Week
                    </a>
                    <a class="nav-link border-0" id="nav-ongoing-tab" data-toggle="tab" href="#nav-ongoing" role="tab" aria-controls="nav-ongoing" aria-selected="false">
                        Ongoing
                    </a>
                    <a class="nav-link border-0" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false">
                        Pending
                    </a>
                    <a class="nav-link border-0" id="nav-overdue-tab" data-toggle="tab" href="#nav-overdue" role="tab" aria-controls="nav-overdue" aria-selected="false">
                        Overdue
                    </a>
                    <a class="nav-link border-0" id="nav-defaulted-tab" data-toggle="tab" href="#nav-defaulted" role="tab" aria-controls="nav-defaulted" aria-selected="false">
                        Defaulted
                    </a>
                    <a class="nav-link border-0" id="nav-completed-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-completed" aria-selected="false">
                        Completed  <i class="bx bx-lock-alt"></i>
                    </a>
                    <a class="nav-link border-0" id="nav-browse-tab" data-toggle="tab" href="#nav-browse" role="tab" aria-controls="nav-browse" aria-selected="false">
                        Browse  <i class="bx bx-search-alt-2"></i>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mt-3">
                        <p class="col-12 nyayomat-blue">
                            Total : <small class="text-success">Ksh</small> <span class="d-none">{{$due = rand(10000,50000)}}</span> <span class="h5 text-success">{{number_format($due,2)}}</span>
                            <br class="mb-2">
                            Assets: <span class="d-none">{{$ast = rand(10,30)}}</span> <span class="h6"> {{number_format($ast,0)}}</span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table" id="myTable">
                                <thead >
                                    <tr>
                                        <th class="font-weight-normal">
                                            Photo
                                        </th>
                                        <th class="font-weight-normal">
                                            Name
                                        </th>
                                        <th class="font-weight-normal">
                                            Value
                                        </th>
                                        <th class="font-weight-normal">
                                            Installment Amount
                                        </th>
                                        <th class="font-weight-normal">
                                            Payment Interval
                                        </th>
                                        <th class="font-weight-normal">
                                            Outstanding Balance
                                        </th>
                                        <th class="font-weight-normal">
                                            Remaining Installments
                                        </th>
                                        <th class="font-weight-normal">
                                            Due Date
                                        </th>
                                        
                                        <th class="font-weight-normal">
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < $ast ; $i++)
                                        <tr class="accordion" id="accordionExample2">
                                            <td>
                                                <i class="bx bx-landscape"></i>
                                            </td>
                                            <td nowrap>
                                                {{$product = Str::upper(Str::random(10))}}
                                            </td>
                                            <td nowrap class="font-weight-light">
                                                {{number_format($value = rand(10000,20000),2)}}
                                            </td>
                                            <td nowrap class="font-weight-light">
                                                <span class="d-none">{{$installment = $value / 8}}</span>
                                                {{number_format($installment,0)}}
                                            </td>
                                            <td nowrap class="font-weight-light">
                                                {{number_format(rand(5,20),0)}}
                                            </td>
                                            
                                            <td nowrap class="font-weight-light">
                                                {{number_format(rand(1000,2000),2)}}
                                            </td>
                                            <td nowrap class="font-weight-light">
                                                {{number_format(rand(5,20),0)}}
                                            </td>
                                            <td nowrap class="font-weight-light">
                                                {{Carbon\Carbon::today()->addDays(rand(0, 7))->format('d-M-Y')}}
                                            </td>
                                            <td nowrap class="font-weight-light">
                                               <a href="" class="btn btn-md btn-success">
                                                   Make Payment <small>{{number_format($installment,2)}}</small>
                                               </a>
                                            </td>

                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Ongoing --}}
                <div class="tab-pane fade" id="nav-ongoing" role="tabpanel" aria-labelledby="nav-ongoing-tab">
                    <div class="row mt-3">
                        <p class="col-12 nyayomat-blue">
                            Total : <small class="text-success">Ksh</small> <span class="d-none">{{$due = rand(10000,50000)}}</span> <span class="h5 text-success">{{number_format($due,2)}}</span>
                            <br class="mb-2">
                            Assets: <span class="d-none">{{$ast = rand(10,30)}}</span> <span class="h6"> {{number_format($ast,0)}}</span>
                        </p>
                    </div>
                    @for ($i = 0; $i < $ast; $i++)
                        <div class="accordion mt-3" id="accordionExample">
                            <div class="card mb-2 rounded shadow-sm border-0">
                                <div class="card-header my-0" id="headingOne">
                                    <div class="row">
                                        <h2 class="col-6 mb-0">
                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                                AST.<span class="text-uppercase">{{Str::random(10)}}</span>  
                                            </a>
                                        </h2>
                                        <div class="col-6 text-right">
                                            <p class="font-weight-light text-black-50">
                                                Last Payment : {{Carbon\Carbon::today()->subDays(rand(0, 7))->format('d - M - Y')}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="asset{{$asset}}" class="collapse text-black" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="row justify-content-between">
                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="d-none">

                                                {{
                                                    $ucv = 754
                                                }}

                                                {{
                                                    $riv = 5
                                                }}

                                                {{
                                                    $div = 14080
                                                }}

                                                {{  
                                                    $uc =  number_format($ucv,2)
                                                }}
                                                
                                                {{  
                                                    $ri =  number_format($riv,2)
                                                }}
                                            </span>  
                                            <span class="d-none">
                                                {{  
                                                    $av =  number_format($div,2)
                                                }} 
                                                {{$tp = 7040}}, {{$ia = number_format(880,2) }} 
                                            </span> 
                                            <span class="text-uppercase text-black font-weight-bold" style="font-size: 1.2vh">
                                                Asset Value
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$av}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Unit Cost
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$uc}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Installment Amount
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$ia}} 
                                        </p>
                                
                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Payment Interval
                                            </span>
                                            <br>
                                            Weekly
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Outstanding Balance
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$tp}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Remaining Installments
                                            </span>
                                            <br>
                                            8 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                QTY
                                            </span>
                                            <br>
                                            {{-- <input type="text" class="form-control" type="n"> --}}
                                            <a href="" class="mr-2 btn-sm btn btn-primary">
                                                Add Qty
                                            </a>
                                        </p>
                                        <div class="col-3 text-right pl-4 mb-2">
                                            <span class="text-right">
                                                
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-3 pl-4 mb-2">
                                            <span class="">
                                                <a href="" class="mr-2 btn-md btn mt-0   font-weight-bold btn-success">
                                                    Make Payment <small class="font-weight-bold">Ksh. 880.00</small>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 mt-3">
                                        <input type="number" name="" class="form-control bg-white   " placeholder="Enter Quantity" id="">
                                    </div> --}}
                                    <div class="col-12 text-center">
                                        <a href="" class="btn btn-success btn-sm">
                                            Add Asset
                                        </a>
                                    </div>
                                    <div class="px-0 table-responsive mt-3">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        {{__("Transaction ID")}}
                                                    </th>
                                                    <th>
                                                        {{__("Transaction Date")}}
                                                    </th>
                                                    <th>
                                                        {{__("Amount")}}
                                                    </th>
                                                    {{-- :if
                                                        <th>
                                                            {{__("Nyayomat Status")}}
                                                        </th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="px-0 table-borderless">
                                                @for ($i = 0; $i < rand(80,150); $i++)    
                                                    <tr class="">
                                                        <td>
                                                            {{Str::upper(Str::random(8))}}
                                                        </td>
                                                        
                                                        <td class="text-muted">
                                                            {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d - M - Y')}}
                                                        </td>

                                                        <td>
                                                            {{number_format(rand(2000,5000),2)}}
                                                        </td>
                                                    </tr>    
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                    <div class="row mt-3">  
                        <p class="col-12 nyayomat-blue">
                            Total : <small class="text-success">Ksh</small> <span class="d-none">{{$due = rand(10000,50000)}}</span> <span class="h5 text-success">{{number_format($due,2)}}</span>
                            <br class="mb-2">
                            Assets: <span class="d-none">{{$ast = rand(10,30)}}</span> <span class="h6"> {{number_format($ast,0)}}</span>
                        </p>
                    </div>
                    @for ($i = 0; $i < $ast; $i++)
                        <div class="accordion mt-3" id="accordionExample">
                            <div class="card mb-2 rounded shadow-sm border-0">
                                <div class="card-header bg-success my-0" id="headingOne">
                                    <div class="row">
                                        <h2 class="col-6 mb-0">
                                            <a class="btn text-white btn-block mt-0 text-left" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                                AST.<span class="text-uppercase">{{Str::random(10)}}</span>  
                                            </a>
                                        </h2>
                                        <div class="col-6 text-right text-white-50">
                                            <p class="font-weight-light">
                                                Last Payment : {{Carbon\Carbon::today()->subDays(rand(180,365))->format('d - M - Y')}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="asset{{$asset}}" class="collapse text-black" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="row justify-content-between">
                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="d-none">

                                                {{
                                                    $ucv = 754
                                                }}

                                                {{
                                                    $riv = 5
                                                }}

                                                {{
                                                    $div = 14080
                                                }}

                                                {{  
                                                    $uc =  number_format($ucv,2)
                                                }}
                                                
                                                {{  
                                                    $ri =  number_format($riv,2)
                                                }}
                                            </span>  
                                            <span class="d-none">
                                                {{  
                                                    $av =  number_format($div,2)
                                                }} 
                                                {{$tp = 7040}}, {{$ia = number_format(880,2) }} 
                                            </span> 
                                            <span class="text-uppercase text-black font-weight-bold" style="font-size: 1.2vh">
                                                Asset Value
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$av}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Unit Cost
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$uc}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Installment Amount
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$ia}} 
                                        </p>
                                
                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Payment Interval
                                            </span>
                                            <br>
                                            Weekly
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Outstanding Balance
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$tp}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Remaining Installments
                                            </span>
                                            <br>
                                            8 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                QTY
                                            </span>
                                            <br>
                                            {{-- <input type="text" class="form-control" type="n"> --}}
                                            <a href="" class="mr-2 btn-sm btn btn-primary">
                                                Add Qty
                                            </a>
                                        </p>
                                        <div class="col-3 text-right pl-4 mb-2">
                                            <span class="text-right">
                                                
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-3 pl-4 mb-2">
                                            <span class="">
                                                <a href="" class="mr-2 btn-md btn mt-0   font-weight-bold btn-success">
                                                    Make Payment <small class="font-weight-bold">Ksh. 880.00</small>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 mt-3">
                                        <input type="number" name="" class="form-control bg-white   " placeholder="Enter Quantity" id="">
                                    </div> --}}
                                    <div class="col-12 text-center">
                                        <a href="" class="btn btn-success btn-sm">
                                            Add Asset
                                        </a>
                                    </div>
                                    <div class="px-0 table-responsive mt-3">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        {{__("Transaction ID")}}
                                                    </th>
                                                    <th>
                                                        {{__("Transaction Date")}}
                                                    </th>
                                                    <th>
                                                        {{__("Amount")}}
                                                    </th>
                                                    {{-- :if
                                                        <th>
                                                            {{__("Nyayomat Status")}}
                                                        </th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="px-0 table-borderless">
                                                @for ($i = 0; $i < rand(80,150); $i++)    
                                                    <tr class="">
                                                        <td>
                                                            {{Str::upper(Str::random(8))}}
                                                        </td>
                                                        
                                                        <td class="text-muted">
                                                            {{Carbon\Carbon::today()->subDays(rand(180, 365))->format('d - M - Y')}}
                                                        </td>

                                                        <td>
                                                            {{number_format(rand(2000,5000),2)}}
                                                        </td>
                                                    </tr>    
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="tab-pane fade" id="nav-overdue" role="tabpanel" aria-labelledby="nav-overdue-tab">
                    <div class="row mt-3">
                        <p class="col-12 nyayomat-blue">
                            Total : <small class="text-warning">Ksh</small> <span class="d-none">{{$due = rand(10000,50000)}}</span> <span class="h5 text-warning">{{number_format($due,2)}}</span>
                            <br class="mb-2">
                            Assets: <span class="d-none">{{$ast = rand(10,30)}}</span> <span class="h6"> {{number_format($ast,0)}}</span>
                        </p>
                    </div>
                    @for ($i = 0; $i < $ast; $i++)
                        <div class="accordion mt-3" id="accordionExample">
                            <div class="card mb-2 rounded shadow-sm border-0">
                                <div class="card-header bg-nyayomat-yellow my-0" id="headingOne">
                                    <div class="row">
                                        <h2 class="col-6 mb-0">
                                            <a class="btn text-black btn-block mt-0 text-left" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                                AST.<span class="text-uppercase">{{Str::random(10)}}</span>  
                                            </a>
                                        </h2>
                                        <div class="col-6 text-right text-black-50">
                                            <p class="font-weight-light">
                                                Last Payment : {{Carbon\Carbon::today()->subDays(rand(180,365))->format('d - M - Y')}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="asset{{$asset}}" class="collapse text-black" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="row justify-content-between">
                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="d-none">

                                                {{
                                                    $ucv = 754
                                                }}

                                                {{
                                                    $riv = 5
                                                }}

                                                {{
                                                    $div = 14080
                                                }}

                                                {{  
                                                    $uc =  number_format($ucv,2)
                                                }}
                                                
                                                {{  
                                                    $ri =  number_format($riv,2)
                                                }}
                                            </span>  
                                            <span class="d-none">
                                                {{  
                                                    $av =  number_format($div,2)
                                                }} 
                                                {{$tp = 7040}}, {{$ia = number_format(880,2) }} 
                                            </span> 
                                            <span class="text-uppercase text-black font-weight-bold" style="font-size: 1.2vh">
                                                Asset Value
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$av}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Unit Cost
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$uc}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Installment Amount
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$ia}} 
                                        </p>
                                
                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Payment Interval
                                            </span>
                                            <br>
                                            Weekly
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Outstanding Balance
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$tp}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Remaining Installments
                                            </span>
                                            <br>
                                            8 
                                        </p>

                                        <div class="col-3 text-right pl-4 mb-2">
                                            <span class="text-right">
                                                
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-3 pl-4 mb-2">
                                            <span class="">
                                                <a href="" class="mr-2 btn-md btn mt-0   font-weight-bold btn-success">
                                                    Make Payment <small class="font-weight-bold">Ksh</small> {{number_format($tp ,2)}}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="px-0 table-responsive mt-3">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        {{__("Transaction ID")}}
                                                    </th>
                                                    <th>
                                                        {{__("Transaction Date")}}
                                                    </th>
                                                    <th>
                                                        {{__("Amount")}}
                                                    </th>
                                                    {{-- :if
                                                        <th>
                                                            {{__("Nyayomat Status")}}
                                                        </th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="px-0 table-borderless">
                                                @for ($i = 0; $i < rand(80,150); $i++)    
                                                    <tr class="">
                                                        <td>
                                                            {{Str::upper(Str::random(8))}}
                                                        </td>
                                                        
                                                        <td class="text-muted">
                                                            {{Carbon\Carbon::today()->subDays(rand(180, 365))->format('d - M - Y')}}
                                                        </td>

                                                        <td>
                                                            {{number_format(rand(2000,5000),2)}}
                                                        </td>
                                                    </tr>    
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="tab-pane fade" id="nav-defaulted" role="tabpanel" aria-labelledby="nav-defaulted-tab">
                    <div class="row mt-3">
                        <p class="col-12 nyayomat-blue">
                            Total : <small class="text-danger">Ksh</small> <span class="d-none">{{$due = rand(10000,50000)}}</span> <span class="h5 text-danger">{{number_format($due,2)}}</span>
                            <br class="mb-2">
                            Assets: <span class="d-none">{{$ast = rand(10,30)}}</span> <span class="h6"> {{number_format($ast,0)}}</span>
                        </p>
                    </div>
                    <div class="accordion mt-3" id="accordionExample">
                        @for ($i = 0; $i < $ast; $i++)
                            <div class="card mb-2 rounded shadow-sm border-0">
                                <div class="card-header bg-danger my-0" id="headingOne">
                                    <div class="row">
                                        <h2 class="col-6 mb-0">
                                            <a class="btn text-white btn-block mt-0 text-left" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                                AST.<span class="text-uppercase">{{Str::random(10)}}</span>  
                                            </a>
                                        </h2>
                                        <div class="col-6 text-right text-black-50">
                                            <p class="font-weight-light">
                                                Last Payment : {{Carbon\Carbon::today()->subDays(rand(180,365))->format('d - M - Y')}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="asset{{$asset}}" class="collapse text-black" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="row justify-content-between">
                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="d-none">

                                                {{
                                                    $ucv = 754
                                                }}

                                                {{
                                                    $riv = 5
                                                }}

                                                {{
                                                    $div = 14080
                                                }}

                                                {{  
                                                    $uc =  number_format($ucv,2)
                                                }}
                                                
                                                {{  
                                                    $ri =  number_format($riv,2)
                                                }}
                                            </span>  
                                            <span class="d-none">
                                                {{  
                                                    $av =  number_format($div,2)
                                                }} 
                                                {{$tp = 7040}}, {{$ia = number_format(880,2) }} 
                                            </span> 
                                            <span class="text-uppercase text-black font-weight-bold" style="font-size: 1.2vh">
                                                Asset Value
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$av}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Unit Cost
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$uc}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto">
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Installment Amount
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$ia}} 
                                        </p>
                                
                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Payment Interval
                                            </span>
                                            <br>
                                            Weekly
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Outstanding Balance
                                            </span>
                                            <br>
                                            <small>Ksh.</small> {{$tp}} 
                                        </p>

                                        <p class="col-auto text-left my-0 mx-auto"> 
                                            <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                Remaining Installments
                                            </span>
                                            <br>
                                            8 
                                        </p>
                                        <div class="col-3 text-right pl-4 mb-2">
                                            <span class="text-right">
                                                
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-3 pl-4 mb-2">
                                            <span class="">
                                                <a href="" class="mr-2 btn-md btn mt-0   font-weight-bold btn-success">
                                                    Make Payment <small class="font-weight-bold">Ksh </small>{{number_format($tp , 2)}}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="px-0 table-responsive mt-3">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        {{__("Transaction ID")}}
                                                    </th>
                                                    <th>
                                                        {{__("Transaction Date")}}
                                                    </th>
                                                    <th>
                                                        {{__("Amount")}}
                                                    </th>
                                                    {{-- :if
                                                        <th>
                                                            {{__("Nyayomat Status")}}
                                                        </th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="px-0 table-borderless">
                                                @for ($i = 0; $i < rand(80,150); $i++)    
                                                    <tr class="">
                                                        <td>
                                                            {{Str::upper(Str::random(8))}}
                                                        </td>
                                                        
                                                        <td class="text-muted">
                                                            {{Carbon\Carbon::today()->subDays(rand(180, 365))->format('d - M - Y')}}
                                                        </td>

                                                        <td>
                                                            {{number_format(rand(2000,5000),2)}}
                                                        </td>
                                                    </tr>    
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-browse" role="tabpanel" aria-labelledby="nav-browse-tab">
                    <div class="px-0 table-responsive mt-3">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        {{__("Asset Name")}}
                                    </th>
                                    <th>
                                        {{__("Unit Cost")}}
                                    </th>
                                    <th>
                                        {{__("Units Available")}}
                                    </th>
                                    
                                    <th>
                                        {{__("Holiday")}}
                                        <small>( Days )</small>
                                    </th>
                                    <th>
                                        {{__("Payment Interval")}}
                                    </th>
                                    <th>
                                        {{__("Installment Amount")}}
                                        
                                    </th>
                                    <th>
                                        {{-- {{__("")}}
                                        <small></small> --}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="px-0 table-borderless">
                                @for ($i = 0; $i < rand(80,150); $i++)    
                                    <tr class="">
                                        <td>
                                            {{Str::upper(Str::random(8))}}
                                        </td>
                                        
                                        <td class="text-muted">
                                            <small>Ksh</small> {{number_format(rand(10000,50000),2)}}
                                        </td>

                                        <td>
                                            {{number_format(rand(200,500),0)}}
                                        </td>

                                        <td>
                                            {{number_format(rand(30,90),0)}}
                                        </td>

                                        <td>
                                            @if ($i %2 == 0)
                                                Weekly
                                            @else
                                                Monthly
                                            @endif
                                        </td>


                                        <td>
                                            <small>Ksh</small> {{number_format(rand(3000,9000),2)}}
                                        </td>

                                        <td>
                                            <a href="" class="btn btn-sm btn-success">
                                                Apply
                                            </a>
                                        </td>
                                    </tr>    
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
                    <div class="row mt-3">
                        <p class="col-12 nyayomat-blue">
                            Total : <small class="text-primary">Ksh</small> <span class="d-none">{{$due = rand(10000,50000)}}</span> <span class="h5 text-primary">{{number_format($due,2)}}</span>
                            <br class="mb-2">
                            Assets: <span class="d-none">{{$ast = rand(10,30)}}</span> <span class="h6"> {{number_format($ast,0)}}</span>
                        </p>
                    </div>
                    <div class="px-0 table-responsive mt-3">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        {{__("Asset Name")}}
                                    </th>
                                    <th>
                                        {{__("Units")}}
                                    </th>
                                    <th>
                                        {{__("Cost")}}
                                        <small>Ksh</small>
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="px-0 table-borderless">
                                @for ($i = 0; $i < rand(80,150); $i++)    
                                    <tr class="">
                                        <td>
                                            {{Str::upper(Str::random(8))}}
                                        </td>
                                        
                                        <td>
                                            {{number_format(rand(200,500),0)}}
                                        </td>
                                        
                                        <td class="text-muted">
                                            {{number_format(rand(10000,50000),2)}}
                                        </td>

                                        <td>
                                            {{Carbon\Carbon::today()->subDays(rand(100, 500))->format('d - M - Y')}}
                                        </td>
                                    </tr>    
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
   
    
@endsection

@push('scripts')
    {{-- <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
@endpush