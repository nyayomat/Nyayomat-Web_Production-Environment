@extends('layouts.acp', 
                        [
                            'title' => __("Alternative Credit Platform Dashboard"),
                            'page_name' => 'Alternative Credit Platform Dashboard',
                            'bs_version' => 'bootstrap@4.6.0',
                            'left_nav_color' => 'lightseagreen',
                            'nav_icon_color' => '#fff',
                            'active_nav_icon_color' => '#fff',
                            'active_nav_icon_color_border' => 'greenyellow' ,
                            'top_nav_color' => '#F7F6FB',
                            'background_color' => '#F7F6FB',
                        ])

@push('link-css')
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link href="{{asset('css/graphs.css')}}" rel="stylesheet">

    @verbatim
        <style>
            /* test Graphs */
            .collapse{
                width: 100%;
            }

            .acp-text{
                color: lightseagreen;
            }
            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>
@endpush

@push('navs')
@endpush

@section('content')
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted ml-1">
                Dashboard
            </a>  /
            <a href="" class="text-primary ml-1">
                Alternative Credit Platform
            </a>  
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 mb-4">
            <a href="{{route('ecommerce-dashboard')}}" class="badge badge-pill shadow py-1 px-2 badge-primary">
                Switch to Ecommerce
            </a>
        </div>
       
        <div class="chart col-md-6 col-lg-4" id="graph-3-container">
                       
            <div class="card custom-radius row shadow border-0">
                <h2 class="col-12 mt-2 title">
                    Assets Under Management
                </h2>
                <div class="col-12 chart-svg">
                    <svg class="chart-line" id="chart-3" viewBox="0 0 80 40">
                        <defs>
                            <clipPath id="clip" x="0" y="0" width="80" height="40" >
                                <rect id="clip-rect" x="-80" y="0" width="77" height="38.7"/>
                            </clipPath>

                            <linearGradient id="gradient-1">
                                <stop offset="0" stop-color="#00d5bd" />
                                <stop offset="100" stop-color="#24c1ed" />
                            </linearGradient>

                            <linearGradient id="gradient-2">
                                <stop offset="0" stop-color="#954ce9" />
                                <stop offset="0.3" stop-color="#954ce9" />
                                <stop offset="0.6" stop-color="#24c1ed" />
                                <stop offset="1" stop-color="#24c1ed" />
                            </linearGradient>

                            <linearGradient id="gradient-3" x1="0%" y1="0%" x2="0%" y2="100%">>
                                <stop offset="0" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0.07"/>
                                <stop offset="0.5" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0.13"/>
                                <stop offset="1" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0"/>
                            </linearGradient>

                            <linearGradient id="gradient-4" x1="0%" y1="0%" x2="0%" y2="100%">>
                                <stop offset="0" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0.07"/>
                                <stop offset="0.5" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0.13"/>
                                <stop offset="1" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3 class="valueX row justify-content-between">
                        <span class="col-6">Jan</span>
                        <span class="col-6 text-right">Dec</span>
                    </h3>
                </div>
                <div class="col-12 mb-2">
                    <span class="total-gain"></span>k Assets To Date
                    <span class=" ml-3 percentage-value font-weight-bold h3"></span>
                </div>
                <div class="col-12 text-right mb-3">
                    <a href="{{route('aom')}}" class="badge badge-pill py-1 px-2 badge-primary text-white" style="">
                        More Info
                    </a>
                </div>
            </div>
        </div>

        <div class="chart col-md-6 col-lg-4" id="graph-2-container">
            <div class="card custom-radius row shadow border-0">
                <h2 class="title mt-2 col-12">
                    Asset Providers
                </h2>
                <div class="chart-svg col-12">
                    <svg class="chart-line" id="chart-2" viewBox="0 0 80 40">
                    </svg>
                    <h3 class="valueX row justify-content-between">
                        <span class="col-6">Jan</span>
                        <span class="col-6 text-right">Dec</span>
                    </h3>
                </div>
                <div class="col-12 mb-2">
                    <span class="total-gain"></span> users
                    <span class=" ml-3 percentage-value font-weight-bold h3"></span>
                </div>
                <div class="col-12 text-right mb-3">
                    <a href="{{route('acp-providers')}}" class="badge badge-pill py-1 px-2 badge-primary">
                        More Info
                    </a>
                </div>
            </div>
        </div>

        <div class="chart col-md-6 col-lg-4" id="graph-1-container">
            <div class="card custom-radius row shadow border-0">
                <h2 class="col-12 mt-2 title">
                    Merchants
                </h2>
                <div class="col-12 chart-svg">
                    <svg class="chart-line" id="chart-1" viewBox="0 0 80 40">
                        <defs>
                            <clipPath id="clip" x="0" y="0" width="80" height="40" >
                                <rect id="clip-rect" x="-80" y="0" width="77" height="38.7"/>
                            </clipPath>

                            <linearGradient id="gradient-1">
                                <stop offset="0" stop-color="#00d5bd" />
                                <stop offset="100" stop-color="#24c1ed" />
                            </linearGradient>

                            <linearGradient id="gradient-2">
                                <stop offset="0" stop-color="#954ce9" />
                                <stop offset="0.3" stop-color="#954ce9" />
                                <stop offset="0.6" stop-color="#24c1ed" />
                                <stop offset="1" stop-color="#24c1ed" />
                            </linearGradient>

                            <linearGradient id="gradient-3" x1="0%" y1="0%" x2="0%" y2="100%">>
                                <stop offset="0" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0.07"/>
                                <stop offset="0.5" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0.13"/>
                                <stop offset="1" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0"/>
                            </linearGradient>

                            <linearGradient id="gradient-4" x1="0%" y1="0%" x2="0%" y2="100%">>
                                <stop offset="0" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0.07"/>
                                <stop offset="0.5" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0.13"/>
                                <stop offset="1" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3 class="valueX row justify-content-between">
                        <span class="col-6">Jan</span>
                        <span class="col-6 text-right">Dec</span>
                    </h3>
                </div>
                <div class="col-12 mb-2">
                    <span class="total-gain"></span>k Users
                    <span class=" ml-3 percentage-value font-weight-bold h3"></span>
                </div>
                <div class="col-12 text-right mb-3">
                    <a href="{{route('acp-merchants')}}" class="badge badge-pill py-1 px-2 badge-primary">
                        More Info
                    </a>
                </div>
            </div>
        </div>

        <div class="chart col-md-6 col-lg-4 circle" id="shop-rating-card">
            <div class="card pb-5 custom-radius row shadow border-0">
                <h2 class="title mt-2 col-12">
                    Rating
                </h2>
                <div class="mb-3 chart-svg align-center col-12">
                    <h2 class="circle-percentage"></h2>
                    <svg class="chart-circle" id="shop-rating-chart" width="50%" viewBox="0 0 100 100">
                        <path class="underlay" d="M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="chart col-md-6 col-lg-4 circle" id="shop-performance-card">
            <div class="card custom-radius row shadow border-0">
                <h2 class="title mt-2 col-12">
                    Performance
                </h2>
                <div class="chart-svg col-12 align-center">
                    <h2 class="circle-percentage"></h2>
                    <svg class="chart-circle" id="shop-performance-chart" width="50%" viewBox="0 0 100 100">
                        <path class="underlay" d="M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50"/>
                    </svg>
                </div>
                <div class="col-12 text-right mb-3">
                    <a href="" class="badge badge-pill py-1 px-2 badge-primary">
                        More Info
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="row">
                <div class="col-12 px-3">
                    <div class="card mx-auto custom-radius row shadow border-0">
                        <div class="col-12">
                            <div class="media">
                                <i class="bx bx-alarm text-danger mt-2" style="font-size: 2.5vh"></i>
                                <div class="media-body ml-2">
                                    <h5 class="mt-2 text-danger" >
                                        Disputes
                                    </h5>
                                    <p class="text-muted">
                                        Standing on the frontline when the bombs start to fall. 
                                        Heaven is jealous of our love, angels are crying from up 
                                    </p>
                                    <div class="col-12 text-right mb-3">
                                        <a href="{{route('disputes')}}" class="badge badge-pill py-1 px-2 badge-danger">
                                            More Info
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="card mx-auto custom-radius row shadow border-0">
                        <div class="col-12 px-3">
                            <div class="media">
                                <i class="bx bx-map text-info mt-2" style="font-size: 2.5vh"></i>
                                <div class="media-body ml-2">
                                    <h5 class="mt-2 text-info" >
                                        Locations
                                    </h5>
                                    <p class="text-muted">
                                        Standing on the frontline when the bombs start to fall. 
                                        Heaven is jealous of our love, angels are crying from up 
                                    </p>
                                    <div class="col-12 text-right mb-3">
                                        <a href="{{route('locations')}}" class="badge badge-pill py-1 px-2 badge-info">
                                            More Info
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
@endsection

@push('scripts')
    <script> 
        var active_users = [...Array(14)].map(() => Math.floor(Math.random() * 95));       
        var sales_values = [...Array(14)].map(() => Math.floor(Math.random() * 95));       
        var stock_outs_value = [...Array(14)].map(() => Math.floor(Math.random() * 95)); 
        var rating =  Math.floor(Math.random() * 100);
        var performance =  Math.floor(Math.random() * 100);
              
        var chart_h = 40;
        var chart_w = 80;
        var stepX = 77 / 14;

        // y - axis values

        // Shop
        var active_users_chart = active_users;
        var shop_sales_chart = sales_values;
        var shop_stock_out_chart = stock_outs_value;

        function point(x, y) {
            x: 0;
            y: 0;
        }
        /* DRAW GRID */
        function drawGrid(graph) {
            var graph = Snap(graph);
            var g = graph.g();
            g.attr('id', 'grid');
            for (i = 0; i <= stepX + 2; i++) {
                var horizontalLine = graph.path(
                    "M" + 0 + "," + stepX * i + " " +
                    "L" + 77 + "," + stepX * i);
                horizontalLine.attr('class', 'horizontal');
                g.add(horizontalLine);
            };
            for (i = 0; i <= 14; i++) {
                var horizontalLine = graph.path(
                    "M" + stepX * i + "," + 38.7 + " " +
                    "L" + stepX * i + "," + 0)
                horizontalLine.attr('class', 'vertical');
                g.add(horizontalLine);
            };
        }
        drawGrid('#chart-3');
        drawGrid('#chart-2');
        drawGrid('#chart-1');

        function drawLineGraph(graph, points, container, id) {
            var graph = Snap(graph);
            /*END DRAW GRID*/
            /* PARSE POINTS */
            var myPoints = [];
            var shadowPoints = [];
            function parseData(points) {
                for (i = 0; i < points.length; i++) {
                    var p = new point();
                    var pv = points[i] / 100 * 40;
                    p.x = 83.7 / points.length * i + 1;
                    p.y = 40 - pv;
                    if (p.x > 78) {
                        p.x = 78;
                    }
                    myPoints.push(p);
                }
            }

            var segments = [];

            function createSegments(p_array) {
                for (i = 0; i < p_array.length; i++) {
                    var seg = "L" + p_array[i].x + "," + p_array[i].y;
                    if (i === 0) {
                        seg = "M" + p_array[i].x + "," + p_array[i].y;
                    }
                    segments.push(seg);
                }
            }

            function joinLine(segments_array, id) {
                var line = segments_array.join(" ");
                var line = graph.path(line);
                line.attr('id', 'graph-' + id);
                var lineLength = line.getTotalLength();

                line.attr({
                    'stroke-dasharray': lineLength,
                        'stroke-dashoffset': lineLength
                });
            }

            function calculatePercentage(points, graph) {
                var initValue = points[0];
                var endValue = points[points.length - 1];
                var sum = endValue - initValue;
                var prefix;
                var percentageGain;
                var stepCount = 1300 / sum;
                function findPrefix() {
                    if (sum > 0) {
                        prefix = "+";
                    } else {
                        prefix = "";
                    }
                }
                var percentagePrefix = "";

                function percentageChange() {
                    percentageGain = initValue / endValue * 100;
                    
                    if(percentageGain > 100){
                    console.log('over100');
                    percentageGain = Math.round(percentageGain * 100*10) / 100;
                    }else if(percentageGain < 100){
                    console.log('under100');
                    percentageGain = Math.round(percentageGain * 10) / 10;
                    }
                    if (initValue > endValue) {
                    
                        percentageGain = endValue/initValue*100-100;
                        percentageGain = percentageGain.toFixed(2);
                    
                        percentagePrefix = "";
                        $(graph).find('.percentage-value').addClass('negative');
                    } else {
                        percentagePrefix = "+";
                    }
                if(endValue > initValue){
                    percentageGain = endValue/initValue*100;
                    percentageGain = Math.round(percentageGain);
                }
                };
                percentageChange();
                findPrefix();

                var percentage = $(graph).find('.percentage-value');
                var totalGain = $(graph).find('.total-gain');
                var hVal = $(graph).find('.h-value');

                function count(graph, sum) {
                    var totalGain = $(graph).find('.total-gain');
                    var i = 0;
                    var time = 1300;
                    var intervalTime = Math.abs(time / sum);
                    var timerID = 0;
                    if (sum > 0) {
                        var timerID = setInterval(function () {
                            i++;
                            totalGain.text(percentagePrefix + i);
                            if (i === sum) clearInterval(timerID);
                        }, intervalTime);
                    } else if (sum < 0) {
                        var timerID = setInterval(function () {
                            i--;
                            totalGain.text(percentagePrefix + i);
                            if (i === sum) clearInterval(timerID);
                        }, intervalTime);
                    }
                }
                count(graph, sum);

                percentage.text(percentagePrefix + percentageGain + "%");
                totalGain.text("0%");
                setTimeout(function () {
                    percentage.addClass('visible');
                    hVal.addClass('visible');
                }, 1300);

            }


            function showValues() {
                var val1 = $(graph).find('.h-value');
                var val2 = $(graph).find('.percentage-value');
                val1.addClass('visible');
                val2.addClass('visible');
            }

            function drawPolygon(segments, id) {
                var lastel = segments[segments.length - 1];
                var polySeg = segments.slice();
                polySeg.push([78, 38.4], [1, 38.4]);
                var polyLine = polySeg.join(' ').toString();
                var replacedString = polyLine.replace(/L/g, '').replace(/M/g, "");

                var poly = graph.polygon(replacedString);
                var clip = graph.rect(-80, 0, 80, 40);
                poly.attr({
                    'id': 'poly-' + id,
                    /*'clipPath':'url(#clip)'*/
                        'clipPath': clip
                });
                clip.animate({
                    transform: 't80,0'
                }, 1300, mina.linear);
            }

            parseData(points);
            
            createSegments(myPoints);
            calculatePercentage(points, container);
            joinLine(segments,id);
        
            drawPolygon(segments, id);
            

            /*$('#poly-'+id).attr('class','show');*/

            /* function drawPolygon(segments,id){
            var polySeg = segments;
            polySeg.push([80,40],[0,40]);
            var polyLine = segments.join(' ').toString();
            var replacedString = polyLine.replace(/L/g,'').replace(/M/g,"");
            var poly = graph.polygon(replacedString);
            poly.attr('id','poly-'+id)
            }
            drawPolygon(segments,id);*/
        }
        function drawCircle(container,id,progress,parent){
        var paper = Snap(container);
        var prog = paper.path("M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50");
        var lineL = prog.getTotalLength();
        var oneUnit = lineL/100;
        var toOffset = lineL - oneUnit * progress;
        var myID = 'circle-graph-'+id;
        prog.attr({
            'stroke-dashoffset':lineL,
            'stroke-dasharray':lineL,
            'id':myID
        });
        
        var animTime = 1300/*progress / 100*/
        
        prog.animate({
            'stroke-dashoffset':toOffset
        },animTime,mina.easein);
        
        function countCircle(animtime,parent,progress){
            var textContainer = $(parent).find('.circle-percentage');
            var i = 0;
            var time = 1300;
            var intervalTime = Math.abs(time / progress);
            var timerID = setInterval(function () {
            i++;
            textContainer.text(i+"%");
            if (i === progress) clearInterval(timerID);
            }, intervalTime);           
        }
        countCircle(animTime,parent,progress);
        }

        $(window).on('load',function(){
            // Shop
            //      -> Circle Charts
            drawCircle('#shop-rating-chart',1,rating,'#shop-rating-card');
            drawCircle('#shop-performance-chart',2,performance,'#shop-performance-card');
            //      -> Line Charts
            drawLineGraph('#chart-1', shop_sales_chart, '#graph-1-container', 1);
            drawLineGraph('#chart-2', shop_stock_out_chart, '#graph-2-container', 2);
            drawLineGraph('#chart-3', active_users_chart, '#graph-3-container', 3);
        });

    </script>
@endpush
