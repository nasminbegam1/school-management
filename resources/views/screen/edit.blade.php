@extends('layout')

@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-edit"></span></div>
        <div class="pagetitle">
            <h5>Screen</h5>
            <h1>Edit</h1>
        </div>
    </div><!--pageheader-->
@stop

@section('content')         
    <div class="widget">
        <h4 class="widgettitle">Screen Edit</h4>
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
        {!! Form::open(array('route'=>array('screen_update',$details->id),'class'=>'stdform form-validation','files'=>true,'method'=>'post')) !!}
                    <div class="par control-group">
                        <label class="control-label" for="firstname">Select Module</label>
                        <div class="controls">{!! Form::select('module',$module,$details->module,array('class'=>'input-xxlarge','required')) !!}</div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="lastname">Screen Name</label>
                        <div class="controls">{!! Form::text('screen_name',$details->screen_name,array('class'=>'input-xxlarge','required')) !!}</div>
                    </div>                   
                    <p class="stdformbutton">
                    {!! Form::submit('Submit',array('class'=>'btn btn-primary')) !!}
                    </p>
        {!! Form::close() !!}
        </div><!--widgetcontent-->
    </div><!--widget-->
@stop