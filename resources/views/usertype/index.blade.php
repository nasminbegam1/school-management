@extends('layout')
@section('pageheader')
    <div class="pageheader">
        {!! Form::open(array('route'=>'usertype_list','method'=>'post','class'=>'searchbar')) !!}
        {!! Form::text('keyword',$keyword,array('placeholder'=>'To search type and hit enter...')) !!}
        {!! Form::close() !!}
        <a href="{{URL::route('usertype_create')}}" class="btn btn-primary">Add Type</a>
        <div class="pageicon"><span class="iconfa-list"></span></div>
        <div class="pagetitle">
            <h5>Type</h5>
            <h1>List</h1>
        </div>
    </div><!--pageheader-->
@stop
@section('content')
    @if(Session::has('error'))
        <div class="inputwrapper">
        <div class="alert alert-error">{!! Session::get('error') !!}</div>
        </div>
    @endif
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Type</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($lists) > 0 )
            @foreach($lists as $list)
            <tr>
                <td>{!! $list->type !!}</td>
                <td>{!! date('d-m-Y', strtotime($list->created_at)) !!}</td>
                <td>
                <a class="btn" href="{!! URL::route('usertype_edit',$list->id) !!}"><i class="icon-edit"></i></a>
                <a class="btn" href="{!! URL::route('usertype_delete',$list->id) !!}" onclick="return confirm('Are you sure want to delete this record?')"><i class="icon-remove-sign"></i></a>
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