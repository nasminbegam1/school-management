@extends('main')

@section('content')
    <div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="/images/logo.png" alt="" /></div>
        {!! Form::open(array('class'=>'form-validation','novalidate'))!!}
            @if(Session::has('errorMessage'))
                <div class="inputwrapper">
                <div class="alert alert-error">{!! Session::get('errorMessage') !!}</div>
                </div>
            @endif
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::select('usertype',$usertype,array('id'=>'usertype','required')) !!}
            </div>   
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::email('email','',array('id'=>'username','placeholder'=>'Enter any email','required')) !!}
            </div>
            <div class="inputwrapper animate2 bounceIn">
            {!! Form::password('password',array('id'=>'password','placeholder'=>'Enter any password','required')) !!}
            </div>
            <div class="inputwrapper animate3 bounceIn">
            {!! Form::submit('Sign In') !!}
            </div>
            <div class="inputwrapper animate4 bounceIn">
                <div class="pull-right">Not a member? <a href="registration.html">Sign Up</a></div>
                <label>{!! Form::checkbox('remember_me',1,false,array('class'=>'remember')) !!}Keep me sign in</label>
            </div> 
        {!! Form::close() !!}
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
@stop