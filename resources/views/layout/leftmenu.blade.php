<div class="leftmenu">        
    <ul class="nav nav-tabs nav-stacked">
        <li class="nav-header">Navigation</li>
        <li><a href="dashboard.html"><span class="iconfa-laptop"></span> Dashboard</a></li>
        <li class="dropdown {{(Route::current()->getName() == 'screen_list')?'active':'' }}"><a href="javascript:void(0);"><span class="iconfa-pencil"></span>Screen</a>
            <ul style="display: block">
                <li @if(Route::current()->getName() == 'screen_list') {{ "class=active" }} @endif><a href="{{URL::route('screen_list')}}">List</a></li>
                <li @if(Route::current()->getName() == 'screen_create') {{ "class=active" }} @endif><a href="{{URL::route('screen_create')}}">Add</a></li>
            </ul>
        </li>
    </ul>
</div><!--leftmenu-->
