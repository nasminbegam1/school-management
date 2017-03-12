@extends('layout')
@section('pageheader')
    <div class="pageheader">
        {!! Form::open(array('route'=>'screen_list','method'=>'post','class'=>'searchbar')) !!}
        {!! Form::text('keyword',$keyword,array('placeholder'=>'To search type and hit enter...')) !!}
        {!! Form::text('keyword',$keyword,array('placeholder'=>'To search type and hit enter...')) !!}
        {!! Form::text('keyword',$keyword,array('placeholder'=>'To search type and hit enter...')) !!}
        {!! Form::close() !!}
        <div class="pageicon"><span class="iconfa-user"></span></div>
        <div class="pagetitle">
            <h5>User</h5>
            <h1>List</h1>
        </div>
    </div><!--pageheader-->
@stop
@section('content')
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>User Type</th>
                <th>Name</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($lists) > 0 )
            @foreach($lists as $list)
            <tr>
                <td>{!! $list->usertype->type !!}</td>
                <td>{!! $list->name !!}</td>
                <td>{!! $list->user_id !!}</td>
                <td>{!! $list->email !!}</td>
                <td>{!! ($list->is_active == 1)?'Active':'Inactive' !!}</td>
                <td>
                <a class="btn" href="{!! URL::route('role_assign',$list->id) !!}" title="Role Assign"><i class="icon-edit"></i></a>
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