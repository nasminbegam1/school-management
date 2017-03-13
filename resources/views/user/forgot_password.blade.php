@extends('main')

@section('content')
    <div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="/images/logo.png" alt="" /></div>
        {!! Form::open(array('class'=>'form-validation','novalidate','id'=>'login'))!!}
            @if(Session::has('errorMessage'))
                <div class="inputwrapper">
                <div class="alert alert-error">{!! Session::get('errorMessage') !!}</div>
                </div>
            @endif
            
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::email('email','',array('id'=>'username','placeholder'=>'Enter any email','required')) !!}
            </div>
            
            <div class="inputwrapper animate2 bounceIn">
            {!! Form::button('Send',['type'=>'submit']) !!}
            </div>
            <div class="inputwrapper animate5 bounceIn">
                <div class="pull-right"> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="{{ URL::route('login') }}">Back to Login </a> </div>
                <div class="pull-right"> New member? <a href="{{ URL::route('registration') }}">Sign Up</a> </div>
               
            </div> 
        {!! Form::close() !!}
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
@stop