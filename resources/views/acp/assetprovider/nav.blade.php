<div>
    <a href="#" class="nav_logo">
        <i class='bx bx-store-alt nav_logo-icon'></i>
        <span class="nav_logo-name">
            {{-- {{\Illuminate\Support\Str::title(config('app.name'))}} --}}
            {{\Illuminate\Support\Str::ucfirst(config('app.name'))}}
        </span>
    </a>
    <div class="nav_list">    
        
        @if (session("user_id") != null)
            <a href="{{route("superadmin.dashboard")}}" class="nav_link"> 
                <i class='bx bx-grid-alt nav_icon'></i> 
                <span class="nav_name">
                    Admin
                </span>
            </a>
        @endif
        
        <a href="{{route('assetprovider.dashboard')}}" class="nav_link"> 
            <i class='bx bx-grid-alt nav_icon'></i> 
            <span class="nav_name">
                Dashboard
            </span>
        </a>
        
        <a href="{{route('assetprovider.productcatalog')}}" class="nav_link">
            <i class='bx bx-user-check nav_icon'></i>
            <span class="nav_name">
               Catalog
            </span>
        </a>

        <a href="{{route('assetprovider.transactions')}}" class="nav_link">
            <i class='bx bx-money nav_icon'></i>
            <span class="nav_name">
                Transactions
            </span>
        </a>

        {{-- <a href="#" class="nav_link">
            <i class='fas fa-tachometer-alt nav_icon'></i>
            <span class="nav_name">
                Notifications
            </span>
        </a> --}}

        <a href="{{route("assetprovider.logout")}}" class="nav_link"> 
            <i class='bx bx-log-out nav_icon'></i> 
            <span class="nav_name">
                Sign Out
            </span> 
        </a>
    </div>
</div>