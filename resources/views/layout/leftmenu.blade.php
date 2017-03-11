<div class="leftmenu">        
    <ul class="nav nav-tabs nav-stacked">
        <li class="nav-header">Navigation</li>
        <li @if(Route::current()->getName() == 'dashboard') {{ "class=active" }} @endif><a href="{{URL::route('dashboard')}}"><span class="iconfa-laptop"></span> Dashboard</a></li>
        <li class="dropdown {{(Route::current()->getName() == 'screen_list' || Route::current()->getName() == 'screen_create')?'active':'' }}"><a href="javascript:void(0);"><span class="iconfa-pencil"></span>Screen</a>
            <ul @if(Route::current()->getName() == 'screen_list' || Route::current()->getName() == 'screen_create') {{ "style='display: block'" }} @endif>
                <li @if(Route::current()->getName() == 'screen_list') {{ "class=active" }} @endif><a href="{{URL::route('screen_list')}}">List</a></li>
                <li @if(Route::current()->getName() == 'screen_create') {{ "class=active" }} @endif><a href="{{URL::route('screen_create')}}">Add</a></li>
            </ul>
        </li>
    </ul>
</div><!--leftmenu-->
