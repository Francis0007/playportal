<!-- navbar -->
<!-- ============================================================== -->
<div class="dashboard-header">
<nav class="navbar navbar-expand-lg  fixed-top">
   <a href="/admin/dashboard"><img src="{{asset('front_assets/images/playverse color@3x.png')}}" style="height: auto; width: 150px; margin-left: 22px"></a>
        <ul class="navbar-nav ml-auto navbar-right-top">
            
            <li class="nav-item dropdown nav-user">
                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="rightnav">
                <h5 class="username">{{auth()->user()->name}}</h5>  
                <div class="circle"><i class="fa fa-user" style="font-size: 30px"></i></div></div></a>
                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                    <div class="nav-user-info">
                        <h5 class="mb-0 text-white nav-user-name">{{auth()->user()->name}}</h5>
                        <span class="status"></span><span class="ml-2">{{auth()->user()->c_code}}</span>
                    </div>

                    @if(Auth::user()->role_id==1)
                    <a class="dropdown-item" href="{{url('/logout')}}"><i class="fas fa-power-off mr-2"></i>Logout</a>

                    @elseif(Auth::user()->role_id ==2)
                    <a class="dropdown-item" href="{{url ('/profile/dashboard/o_profile')}}"><i class="fas fa-user mr-2"></i>Profile</a>
                    <a href="{{url ('/admin/dashboard/view_app')}}" class="dropdown-item">Games</a>
                     <a href="{{url ('/admin/analytics')}}" class="dropdown-item">Analytics</a>
                      <a href="{{url ('/admin/dashboard/payment')}}" class="dropdown-item">Payments</a>
                      <a class="dropdown-item">Sales</a>
                      <a class="dropdown-item">Policy</a>
                    <a class="dropdown-item" href="{{url('/logout')}}"><i class="fas fa-power-off mr-2"></i>Logout</a>

                    @endif   
                </div>
            </li>
        </ul>
    </div>
</nav>
</div><br><br><br><br>
<!-- ============================================================== -->
<!-- end navbar -->