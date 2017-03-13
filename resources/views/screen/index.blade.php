@extends('layout')
@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-list"></span></div>
        <div class="pagetitle">
            <h5>Screen</h5>
            <h1>List</h1>
        </div>
    </div><!--pageheader-->
@stop
@section('content')
    <table class="table table-condensed">
        <thead>
            <tr>
                <!-- <th>Module Name</th> -->
                <th>Screen Name</th>
                
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($lists) > 0 )
            @foreach($lists as $list)
            <tr>
                <td>{!! str_replace('_',' ',$list['name']) !!}</td>
                
                <td>
                </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="3">------No record Found------</td></tr>
            @endif
        </tbody>
    </table>
    
@stop