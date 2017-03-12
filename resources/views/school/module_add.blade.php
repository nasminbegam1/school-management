@extends('layout')

@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-plus"></span></div>
        <div class="pagetitle">
            <h5>School Module</h5>
            <h1>Add</h1>
        </div>
    </div><!--pageheader-->
@stop

@section('content')         
    <div class="widget">
        <h4 class="widgettitle">School Module Add</h4>
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
        {!! Form::open(array('route'=>'school_modlues_store','class'=>'stdform form-validation','files'=>true)) !!}
                    <div class="par control-group">
                        <label class="control-label" for="firstname">School Name</label>
                        <div class="controls">{!! Form::select('school',$school_lists,'',array('class'=>'input-xxlarge','required')) !!}</div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="module_name">Module Name</label>
                        
                            @foreach($module_lists as $id=>$name)
                                <div class="sub">{{ Form::checkbox('module_id[]',$id) }} {{ $name }}</div>        
                            @endforeach
                            
                        
                    </div>                   
                    <p class="stdformbutton">
                    {!! Form::submit('Submit',array('class'=>'btn btn-primary')) !!}
                    </p>
        {!! Form::close() !!}
        </div><!--widgetcontent-->
    </div><!--widget-->
@stop