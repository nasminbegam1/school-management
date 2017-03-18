@extends('layout')

@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-plus"></span></div>
        <div class="pagetitle">
            <h5>Usertype</h5>
            <h1>Add</h1>
        </div>
    </div><!--pageheader-->
@stop

@section('content')         
    <div class="widget">
        <h4 class="widgettitle">Usertype Add</h4>
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
        {!! Form::open(array('route'=>'usertype_store','class'=>'stdform form-validation','files'=>true,'method'=>'post')) !!}
                    <div class="control-group">
                        <label class="control-label" for="lastname">Type</label>
                        <div class="controls">{!! Form::text('type','',array('class'=>'input-xxlarge','required')) !!}</div>
                    </div>                   
                    <p class="stdformbutton">
                    {!! Form::submit('Submit',array('class'=>'btn btn-primary')) !!}
                    <a href="{{URL::route('usertype_list')}}" class="btn btn-default">Cancel</a>
                    </p>
        {!! Form::close() !!}
        </div><!--widgetcontent-->
    </div><!--widget-->
@stop