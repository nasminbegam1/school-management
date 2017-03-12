<div class="leftmenu">        
    <ul class="nav nav-tabs nav-stacked">
        <li class="nav-header">Navigation</li>
        <li @if(Route::current()->getName() == 'dashboard') {{ "class=active" }} @endif><a href="{{URL::route('dashboard')}}"><span class="iconfa-laptop"></span> Dashboard</a></li>
        
         <li class="dropdown {{(Route::current()->getName() == 'school_modlues_edit' || Route::current()->getName() == 'school_modlues' || Route::current()->getName() == 'school_modlues_add')?'active':'' }}"><a href="javascript:void(0);"><span class="iconfa-pencil"></span>School Module</a>
            <ul @if(Route::current()->getName() == 'school_modlues' || Route::current()->getName() == 'school_modlues_edit' || Route::current()->getName() == 'school_modlues_add') {{ "style='display: block'" }} @endif>
                <li @if(Route::current()->getName() == 'school_modlues') {{ "class=active" }} @endif><a href="{{URL::route('school_modlues')}}">List</a></li>
                <li @if(Route::current()->getName() == 'school_modlues_add') {{ "class=active" }} @endif><a href="{{URL::route('school_modlues_add')}}">Add</a></li>
            </ul>
        </li>
            
            
        <li class="dropdown {{(Route::current()->getName() == 'screen_list' || Route::current()->getName() == 'screen_create')?'active':'' }}"><a href="javascript:void(0);"><span class="iconfa-pencil"></span>Screen</a>
            <ul @if(Route::current()->getName() == 'screen_list' || Route::current()->getName() == 'screen_create') {{ "style='display: block'" }} @endif>
                <li @if(Route::current()->getName() == 'screen_list') {{ "class=active" }} @endif><a href="{{URL::route('screen_list')}}">List</a></li>
                <li @if(Route::current()->getName() == 'screen_create') {{ "class=active" }} @endif><a href="{{URL::route('screen_create')}}">Add</a></li>
            </ul>
        </li>
        <li class="dropdown {{(Route::current()->getName() == 'usertype_list' || Route::current()->getName() == 'usertype_create' || Route::current()->getName() == 'usertype_edit')?'active':'' }}"><a href="javascript:void(0);"><span class="iconfa-pencil"></span>User type</a>
            <ul @if(Route::current()->getName() == 'usertype_list' || Route::current()->getName() == 'usertype_create' || Route::current()->getName() == 'usertype_edit') {{ "style='display: block'" }} @endif>
                <li @if(Route::current()->getName() == 'usertype_list'|| Route::current()->getName() == 'usertype_edit') {{ "class=active" }} @endif><a href="{{URL::route('usertype_list')}}">List</a></li>
                <li @if(Route::current()->getName() == 'usertype_create') {{ "class=active" }} @endif><a href="{{URL::route('usertype_create')}}">Add</a></li>
            </ul>
        </li>
            <li @if(Route::current()->getName() == 'user_list' || Route::current()->getName() == 'role_assign') {{ "class=active" }} @endif><a href="{{URL::route('user_list')}}"><span class="iconfa-user"></span> User</a></li>
    </ul>
</div><!--leftmenu-->
