    
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="" src="{{asset('img/logo.png')}}" style="background: white" height="80px" width="80px" />
                             </span>                        
                    </div>
                    <div class="logo-element">
                        ES
                    </div>
                </li>
                      @if(Auth::user()->punyaAkses())                            
                      <!-- <li  class="">
                                <a href="{{ url('/master-user/index')}}">         
                                  <i class="fa fa-home"></i>
                                
                                  <span>User</span>         
                                                    </a>
                                        </li> -->

                            <li  class="{{ Request::is('admin-aktifasi/*')? "active":"" }}" >
                                <a href="{{ url('/admin-aktifasi/index')}}">         
                                  <i class="fa fa-folder-o"></i>
                                  <span>List Member</span>                 
                                </a>
                            </li>
                      @endif
                      
                       @if(!Auth::user()->punyaAkses())
                      <li  class="{{ Request::is('member-aktifasi/*')? "active":"" }}" >
                          <a href="{{ url('/member-aktifasi/index')}}">         
                            <i class="fa fa-folder-o"></i>
                            <span>Member</span>                 
                          </a>
                      </li>
                      @endif

                      <!-- <li  class="{{ Request::is('master-history/*')? "active":"" }}">
                        <a href="{{ url('/master-history/index')}}">         
                            <i class="fa fa-search"></i>
                            <span>History</span>         
                        </a>
                      </li>
 -->
                    <!--   <li  class="{{ Request::is('master-group/*')? "active":"" }}">
                        <a href="{{ url('/master-group/index')}}">         
                            <i class="fa fa-cubes"></i>
                            <span>Master Group</span>         
                        </a>
                      </li>
 -->
                   <!--    <li  class="{{ Request::is('master-chek-kode/*')? "active":"" }}">
                        <a href="{{ url('/master-chek-kode/index')}}">         
                            <i class="fa  fa-barcode"></i>
                            <span>Cek Kode</span>         
                        </a>
                      </li> -->

            </ul>
        </div>
    </nav>