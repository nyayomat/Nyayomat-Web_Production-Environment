@extends('layouts.backend.main', 
                        [
                            'title' => __("Blog"),
                            'page_name' => 'Blogs',
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
            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }
            .header-center {
                font-size: 2rem;
                display: grid;
                grid-template-columns: 1fr max-content 1fr;
                grid-column-gap: 1.2rem;
                align-items: center;
                opacity: 0.8;
                
            }
            .header-left {
                font-size: 2rem;
                display: grid;
                grid-template-columns: 0fr max-content 1fr;
                grid-column-gap: 1.2rem;
                align-items: center;
                opacity: 0.8;
                margin-left: -20px;
            }
            .header-right {
                font-size: 2rem;
                display: grid;
                grid-template-columns: 1fr max-content 0fr;
                grid-column-gap: 1.2rem;
                align-items: center;
                opacity: 0.8;
                
            }

            .header-right::before,
            .header-right::after {
                content: "";
                display: block;
                height: 1px;
                background-color: #000;
            }
            .header-left::before,
            .header-left::after {
                content: "";
                display: block;
                height: 1px;
                background-color: #000;
            }
            .header-center::before,
            .header-center::after {
                content: "";
                display: block;
                height: 1px;
                background-color: #000;
            }
            .card{
                border-top: 0 !important;
                margin-top: 15px !important;
            }
            .collapse{
                width: 100%
            }

            /* // Small devices (landscape phones, 576px and up) */
            @media (min-width: 350px) {
                .big-money {
                    font-size: 3.5vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }

                .display-4-mobile{
                    font-size: 3.5vh;
                }
            }

            /* // Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {  }

            /* // Large devices (desktops, 992px and up) */
            @media (min-width: 992px) { }

            /* // Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) { 
                .big-money {
                    font-size: 1vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }

                .icon-size{
                    font-size: 4.0vh;
                }
            }
        </style>
    @endverbatim
@endpush

@push('link-js')
@endpush



@section('content')
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted mr-1">
                {{Illuminate\Support\Str::ucfirst("Super Admin")}}
            </a> /
            <a href="" class="text-primary ml-1">
                Blog Posts
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Blog --}}
        <div class="col mx-auto shadow-sm rounded">
            <div class="accordion" id="Blog">
                <div id="showBlog" class="collapse show" aria-labelledby="headingOne" data-parent="#Blog"> 
                    <div class="header-left px-0">
                        Blog
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newBlog" aria-expanded="false" aria-controls="newBlog">
                                ADD Blog
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                   
                        <div class="col-12 table-responsive">
                            <table class="table  table-borderless">
                                <thead>
                                    <tr>
                                        <th>
                                            County
                                        </th>
                                        <th>
                                            Blog
                                        </th>
                                        <th nowrap>
                                            Estate / Area
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($iw = 0; $iw < 9; $iw++)
                                        <tr>
                                            <td>
                                                {{Illuminate\Support\Str::random(8)}}
                                            </td>
                                            <td>
                                                <span class="d-none">
                                                    {{$rand = rand(3,9)}}
                                                </span>
                                                <span class="mr-2">
                                                    ({{$rand}})    
                                                </span>
                                                @for ($i = 0; $i < $rand; $i++)
                                                    {{Illuminate\Support\Str::random(8)}} , 
                                                @endfor
                                            </td>
                                            <td>
                                                {{Illuminate\Support\Str::random(5)}}
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                                    
                        </div>
                    </div>
                    
                </div>
                <div class="card">
                    <div id="newBlog" class="collapse" aria-labelledby="headingTwo" data-parent="#Blog">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showBlog" aria-expanded="true" aria-controls="showBlog">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    New Blog
                                </h5>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush