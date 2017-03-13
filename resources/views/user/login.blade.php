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
            @if(Session::has('successMessage'))
                <div class="inputwrapper">
                <div class="alert alert-success">{!! Session::get('successMessage') !!}</div>
                </div>
            @endif
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::select('usertype',$usertype,array('id'=>'usertype','required')) !!}
            </div>   
            <div class="inputwrapper animate2 bounceIn">
            {!! Form::email('email','',array('id'=>'username','placeholder'=>'Enter any email','required')) !!}
            </div>
            <div class="inputwrapper animate3 bounceIn">
            {!! Form::password('password',array('id'=>'password','placeholder'=>'Enter any password','required')) !!}
            </div>
            <div class="inputwrapper animate4 bounceIn">
            {!! Form::button('Sign In',['type'=>'submit']) !!}
            </div>
            <div class="inputwrapper animate5 bounceIn">
                <div class="pull-right">New member? <a href="{{ URL::route('registration') }}">Sign Up</a> <br/> <a href="{{ URL::route('forgot_password') }}">Forgot Password?</a></div>
                <label>{!! Form::checkbox('remember_me',1,false,array('class'=>'remember')) !!}Keep me sign in</label>
            </div> 
        {!! Form::close() !!}
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
@stop