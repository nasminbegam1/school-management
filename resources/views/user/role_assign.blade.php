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
        <h4 class="widgettitle">Role Assign</h4>
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
        {!! Form::open(array('route'=>array('role_assign_update',$users->id),'class'=>'stdform form-validation','files'=>true,'method'=>'post')) !!}
            <div class="control-group">
                <label class="control-label" for="lastname">Name</label>
                <div class="controls">{!! Form::text('name',$users->name,array('class'=>'input-xxlarge','required','readonly')) !!}</div>
            </div>
            <div class="control-group">
                <label class="control-label" for="lastname">Email</label>
                <div class="controls">{!! Form::email('email',$users->email,array('class'=>'input-xxlarge','required','readonly')) !!}</div>
            </div>
            <div class="control-group">
                <label class="control-label" for="lastname">Email</label>
                <div class="controls">{!! Form::select('role_assign',$usertype,$users->school_user_type_id,array('class'=>'input-xxlarge','required')) !!}</div>
            </div>
            <p class="stdformbutton">
            {!! Form::submit('Submit',array('class'=>'btn btn-primary')) !!}
            </p>
        {!! Form::close() !!}
        </div><!--widgetcontent-->
    </div><!--widget-->
@stop