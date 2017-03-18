@extends('layout')
@section('pageheader')
    <div class="pageheader">
        {!! Form::open(array('route'=>'user_list','method'=>'get','class'=>'searchbar')) !!}
        {!! Form::text('keyword',$keyword,array('placeholder'=>'To search type name and hit enter...')) !!}
        {!! Form::email('email_key',$email_key,array('placeholder'=>'To search type email and hit enter...')) !!}
        {!! Form::text('registerdate',$registerdate,array('placeholder'=>'Register Date','id'=>'datepicker')) !!}
        {!! Form::select('status',[''=>'Select.....','accepted'=>'Accepted','rejected'=>'Rejected'],$status) !!}
        {!! Form::button('Search',['class'=>'btn btn-info','type'=>'submit']) !!}
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
                <th>Email Verified</th>
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
                <td>{!! ($list->is_email_verified == 1)? 'Yes':'No' !!}</td>
                <td>
                @if($list->is_deleted == 1)
                    <em style="color:#D20D0A">Rejected</em>
                @else
                    <span data-status="{{ $list->is_active }}" data-type="user" data-id="{{ $list->id }}" class="changeStatusBtn @if($list->is_active == 1) activeStatus @else inactiveStatus  @endif" title="{!! ($list->is_active == 1)?'Active':'Inactive' !!}">
                      @if($list->is_active == 1 )
                        <i class="fa fa-check-circle" aria-hidden="true" ></i>
                      @else
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                      @endif
                        
                    </span>
                @endif
                </td>
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
        @if($keyword!='' || $registerdate!='' || $status!='')
        {{ $lists->appends(['keyword'=>$keyword,'email_key'=>$email_key,'registerdate'=>$registerdate,'status'=>$status])->links() }}
        @else
        {{ $lists->links() }}
        @endif
    </div>
    @endif
@stop