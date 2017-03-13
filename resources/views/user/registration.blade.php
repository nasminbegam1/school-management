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
            
            @if (count($errors) > 0)
            <div class="inputwrapper">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">{{ $error }}</div>
                @endforeach
            </div>
            @endif
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::select('usertype',[''=>'Select Any User Type']+$usertype,array('id'=>'usertype','required')) !!}
            </div>
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::select('school_id',[''=>'Select Any School']+$schools,array('id'=>'school_id','required')) !!}
            </div>
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::text('name','',array('id'=>'name','placeholder'=>'Enter any name','required')) !!}
            </div>
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::text('user_id','',array('id'=>'user_id','placeholder'=>'Enter any user ID','required')) !!}
            </div>
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::email('email','',array('id'=>'email','placeholder'=>'Enter any email','required')) !!}
            </div>
            <div class="inputwrapper animate2 bounceIn">
            {!! Form::password('password',array('id'=>'password','placeholder'=>'Enter any password','required')) !!}
            </div>
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::text('mob1','',array('id'=>'mob1','placeholder'=>'Enter any mobile no','required')) !!}
            </div>
            <div class="inputwrapper animate1 bounceIn">
            {!! Form::text('mob2','',array('id'=>'mob2','placeholder'=>'Enter any alternate mobile no')) !!}
            </div>
            <div class="inputwrapper animate3 bounceIn">
            {!! Form::button('Sign Up',['type'=>'submit']) !!}
            </div>
            <div class="inputwrapper animate4 bounceIn">
                <div class="pull-right">Member? <a href="{{URL::route('login')}}">Sign In</a></div>
            </div> 
        {!! Form::close() !!}
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
@stop