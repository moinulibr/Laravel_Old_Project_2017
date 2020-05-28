<div class="navbar navbar-expand-md header-menu-one bg-light">
    <div class="nav-bar-header-one">
        <div class="header-logo">
            <a href="{{asset('links')}}/dashboard/index.php">
                <img src="{{asset('links')}}/img/ebusi-logo.png" alt="logo">
            </a>
        </div>
         <div class="toggle-button sidebar-toggle">
            <button type="button" class="item-link">
                <span class="btn-icon-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </div>
    <div class="d-md-none mobile-nav-bar">
       <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
        </button>
        <button type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
        <ul class="navbar-nav">
            <li class="navbar-item header-search-bar">
                <div class="input-group stylish-input-group">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="flaticon-search" aria-hidden="true"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control" placeholder="Find Something . . .">
                </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="navbar-item dropdown header-admin">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <div class="admin-title">
                        <h5 class="item-title">
                            @auth {{ Auth::user()->name }}</h5>
                             <span>{{ Auth::user()->roles->name }}</span> @endauth
                    </div>
                    <div class="admin-img">
                       {{-- -
                         @auth
                        @php $id = Auth::user()->id; @endphp
                        @if (Auth::user()->image)
                        @if(Storage::disk('public')->exists('user-image/',"{$id}.".Auth::user()->image))
                        <img src="{{ asset('storage/user-image/'.$id.'.'.Auth::user()->image) }}" alt="" width="40" height="40" style="border-radius: 50%;">
                        @endif
                        @else
                        <img src="{{asset('links')}}/img/figure/admin.jpg" alt="Admin">
                        @endif
                        @endauth
                        --}}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title">
                            @auth
                            {{ Auth::user()->name }}
                            @endauth
                        </h6>
                    </div>
                    <div class="item-content">
                        <ul class="settings-list">
                            {{-- 
                            <li><a href="{{asset('links')}}/user/view.php"><i class="flaticon-user"></i>My Profile</a></li>
                            --}}
                            <!--li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                            <li><a href="messaging.php"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a></li>
                            <li><a href="account-settings.php"><i class="flaticon-gear-loading"></i>Account Settings</a></li-->
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="flaticon-turn-off"></i>
                                        Log Out
                                </a>

                               

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>