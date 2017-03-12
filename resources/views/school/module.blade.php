@extends('layout')
@section('pageheader')
    <div class="pageheader">
        
        <a href="{{URL::route('school_modlues_add')}}" class="btn btn-primary">Add School Module</a>
        <div class="pageicon"><span class="iconfa-list"></span></div>
        <div class="pagetitle">
            <h5>School Module</h5>
            <h1>List</h1>
        </div>
    </div><!--pageheader-->
@stop
@section('content')
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>School Name</th>
                <th>Modules</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($school_lists) > 0 )
            @foreach($school_lists as $list)
            <tr>
                <td>{!! $list['school_name'] !!}</td>
                <td>
                
                    @foreach($list['modules'] as $m)
                        {{ $m->module->module_name }}<br/>
                    @endforeach
                </td>
                <td>
                <a class="btn" href="{!! URL::route('school_modlues_edit',$list['id']) !!}"><i class="icon-edit"></i></a>
                
                </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="3">------No record Found------</td></tr>
            @endif
        </tbody>
    </table>
   
@stop