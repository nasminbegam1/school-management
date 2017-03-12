@extends('layout')

@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-edit"></span></div>
        <div class="pagetitle">
            <h1>Account Settings</h1>
        </div>
    </div><!--pageheader-->
@stop

@section('content')         
    <div class="widget">
        <h4 class="widgettitle">Account Settings</h4>
        <div class="widgetcontent wc1">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(array('route'=>'account_update','class'=>'stdform form-validation','files'=>true,'method'=>'post')) !!}
                    <div class="control-group">
                        <label class="control-label" for="lastname">Password</label>
                        <div class="controls">{!! Form::password('password',array('class'=>'input-xxlarge','required','id'=>'password')) !!}</div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="lastname">Confirmed Password</label>
                        <div class="controls">{!! Form::password('password_confirmation',array('class'=>'input-xxlarge','required')) !!}</div>
                    </div>  
                    <p class="stdformbutton">
                    {!! Form::submit('Submit',array('class'=>'btn btn-primary')) !!}
                    </p>
        {!! Form::close() !!}
        </div><!--widgetcontent-->
    </div><!--widget-->
@stop