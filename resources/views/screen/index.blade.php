@extends('layout')
@section('pageheader')
    <div class="pageheader">
        {!! Form::open(array('route'=>'screen_list','method'=>'post','class'=>'searchbar')) !!}
        {!! Form::text('keyword',$keyword,array('placeholder'=>'To search type and hit enter...')) !!}
        {!! Form::close() !!}
        <a href="{{URL::route('screen_create')}}" class="btn btn-primary">Add screen</a>
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
                <th>Module Name</th>
                <th>Screen Name</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($lists) > 0 )
            @foreach($lists as $list)
            <tr>
                <td>{!! $list->module->module_name !!}</td>
                <td>{!! $list->screen_name !!}</td>
                <td>{!! $list->created_at !!}</td>
                <td>
                <a class="btn" href="{!! URL::route('screen_edit',$list->id) !!}"><i class="icon-edit"></i></a>
                <a class="btn" href="{!! URL::route('screen_delete',$list->id) !!}" onclick="return confirm('Are you sure want to delete this record?')"><i class="icon-remove-sign"></i></a>
                </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="3">------No record Found------</td></tr>
            @endif
        </tbody>
    </table>
    @if($lists->lastPage() > 1)
    <div class="pagination">
        {{ $lists->links() }}
    </div>
    @endif
@stop