@extends('main')

@section('content')
    <div class="loginpanel">
    <div class="loginpanelinner">
        @if(Session::has('error'))
            <div class="inputwrapper">
            <div class="alert alert-error">{!! Session::get('error') !!}</div>
            </div>
        @endif
        
        @if(Session::has('success'))
            <h4 class="widgettitle title-success">{{ Session::get('success') }}</h4>

        @endif
        
        @if(!Session::has('error') && !Session::has('success') )
            <h4 class="widgettitle title-success">Thank you</h4>
        @endif
        
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
@stop