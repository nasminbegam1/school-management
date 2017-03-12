@extends('layout')

@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-plus"></span></div>
        <div class="pagetitle">
            <h5>School Module</h5>
            <h1>Edit</h1>
        </div>
    </div><!--pageheader-->
@stop

@section('content')         
    <div class="widget">
        <h4 class="widgettitle">School Module Edit</h4>
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
        {!! Form::open(array('route'=>['school_modlues_update',$school_details->ID],'class'=>'stdform form-validation','files'=>true)) !!}
                    <div class="par control-group">
                        <label class="control-label" for="firstname">School name</label>
                        <div class="controls">{{ $school_details->School_Name }}</div>
                    </div>
                    
                    <div class="control-group">
                    
                        <label class="control-label" for="module_name">Module Name</label>
                            @php
                                $checked_module = implode($selected_modules,',');
                                if($checked_module){
                                    $checked_module .=',';
                                }
                            @endphp
                            @foreach($module_lists as $id=>$name)
                                
                                <div class="sub">
                                {{ Form::checkbox('module_id[]',$id, ((in_array($id,$selected_modules))?true:false) ,['class'=>'module_checkbox']) }}
                                {{ Form::checkbox('uncheck_module_id[]',$id, false ,['class'=>'uncheck_module_checkbox hide']) }}
                                {{ $name }}
                                </div>        
                            @endforeach
                        
                        
                    </div>                   
                    <p class="stdformbutton">
                    {!! Form::submit('Submit',array('class'=>'btn btn-primary')) !!}
                    </p>
        {!! Form::close() !!}
        </div><!--widgetcontent-->
    </div><!--widget-->
    <script>
        
    </script>
@stop