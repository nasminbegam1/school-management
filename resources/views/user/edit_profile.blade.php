@extends('layout')

@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-edit"></span></div>
        <div class="pagetitle">
            <h1>Edit Profile</h1>
        </div>
    </div><!--pageheader-->
@stop

@section('content')         
    <div class="widget">
        <h4 class="widgettitle">Edit Profile</h4>
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
        {!! Form::open(array('route'=>'edit_profile_store','class'=>'stdform form-validation','files'=>true,'method'=>'post')) !!}
            <div class="control-group">
                <label class="control-label" for="lastname">Name</label>
                <div class="controls">{!! Form::text('name',$users->name,array('class'=>'input-xxlarge','required')) !!}</div>
            </div>
            <div class="control-group">
                <label class="control-label" for="lastname">Email</label>
                <div class="controls">{!! Form::email('email',$users->email,array('class'=>'input-xxlarge','required')) !!}</div>
            </div>
            <div class="control-group">
                <label class="control-label" for="lastname">Mobile No</label>
                <div class="controls">{!! Form::text('mob1',$users->mob1,array('class'=>'input-xxlarge','required')) !!}</div>
            </div>
            <div class="control-group">
                <label class="control-label" for="lastname">Alternat Mobile No</label>
                <div class="controls">{!! Form::text('mob2',$users->mob2,array('class'=>'input-xxlarge')) !!}</div>
            </div> 
            <p class="stdformbutton">
            {!! Form::submit('Submit',array('class'=>'btn btn-primary')) !!}
            </p>
        {!! Form::close() !!}
        </div><!--widgetcontent-->
    </div><!--widget-->
@stop