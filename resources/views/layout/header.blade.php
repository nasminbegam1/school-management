<div class="header">
    <div class="logo">
        <a href="dashboard.html"><img src="/images/logo.png" alt="" /></a>
    </div>
    <div class="headerinner">
        <ul class="headmenu">
            <li class="odd">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="count">4</span>
                    <span class="head-icon head-message"></span>
                    <span class="headmenu-label">Messages</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-header">Messages</li>
                    <li><a href=""><span class="icon-envelope"></span> New message from <strong>Jack</strong> <small class="muted"> - 19 hours ago</small></a></li>
                    <li><a href=""><span class="icon-envelope"></span> New message from <strong>Daniel</strong> <small class="muted"> - 2 days ago</small></a></li>
                    <li><a href=""><span class="icon-envelope"></span> New message from <strong>Jane</strong> <small class="muted"> - 3 days ago</small></a></li>
                    <li><a href=""><span class="icon-envelope"></span> New message from <strong>Tanya</strong> <small class="muted"> - 1 week ago</small></a></li>
                    <li><a href=""><span class="icon-envelope"></span> New message from <strong>Lee</strong> <small class="muted"> - 1 week ago</small></a></li>
                    <li class="viewmore"><a href="messages.html">View More Messages</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                <span class="count">{{count(\Helpers::pending_user())}}</span>
                <span class="head-icon head-users"></span>
                <span class="headmenu-label">New Users</span>
                </a>
                <ul class="dropdown-menu newusers">
                    <li class="nav-header">New Users</li>
                    @if(count(\Helpers::pending_user()) > 0)
                    @foreach(\Helpers::pending_user() as $pendingUser)
                    <li>
                        <a href="javascript:void(0);">
                            <strong>{!! $pendingUser->name !!}</strong>
                            <small>{!! date('F d,Y',strtotime($pendingUser->created_at)) !!}</small>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </li>
            <li class="odd">
                <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                <span class="count">1</span>
                <span class="head-icon head-bar"></span>
                <span class="headmenu-label">Statistics</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-header">Statistics</li>
                    <li><a href=""><span class="icon-align-left"></span> New Reports from <strong>Products</strong> <small class="muted"> - 19 hours ago</small></a></li>
                    <li><a href=""><span class="icon-align-left"></span> New Statistics from <strong>Users</strong> <small class="muted"> - 2 days ago</small></a></li>
                    <li><a href=""><span class="icon-align-left"></span> New Statistics from <strong>Comments</strong> <small class="muted"> - 3 days ago</small></a></li>
                    <li><a href=""><span class="icon-align-left"></span> Most Popular in <strong>Products</strong> <small class="muted"> - 1 week ago</small></a></li>
                    <li><a href=""><span class="icon-align-left"></span> Most Viewed in <strong>Blog</strong> <small class="muted"> - 1 week ago</small></a></li>
                    <li class="viewmore"><a href="charts.html">View More Statistics</a></li>
                </ul>
            </li>
            <li class="right">
                <div class="userloggedinfo">
                    <div class="userinfo">
                        <h5>{!! \Auth::guard('users')->user()->name !!} <small>- {!! \Auth::guard('users')->user()->email !!}</small></h5>
                        <ul>
                            <li><a href="{!! URL::route('edit_profile') !!}">Edit Profile</a></li>
                            <li><a href="{!! URL::route('account_settings') !!}">Account Settings</a></li>
                            <li><a href="{!! URL::route('logout') !!}">Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul><!--headmenu-->
    </div>
</div>
