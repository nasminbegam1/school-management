@extends('layout')
@section('pageheader')
<style type="text/css">
    .modal-loader {
    background: rgba(246,246,246, 0.5) none repeat scroll 0 0;
    height: 100%;
    position: absolute;
    text-align: center;
    width: 100%;
    z-index: 999;
    display: none;
}

.modal-sub-content-1, .modal-sub-content-2 {
    color: #0b6dcf;
    font-size: 15px;
    font-weight: bold;
    left: 40%;
    position: absolute;
    top: 44%;
    display: none;
}
.modal-sub-content-2{
    left: 30%;
}
</style>
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
                <th>Module Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($lists) > 0 )
            @foreach($lists as $list)
            <tr>
                <td>{!! $list['name'] !!}</td>
                <td>{!! $list['module'] !!}</td>
                <td>{!! (($list['status'] == 1)?'Active':'Inactive') !!}</td>
                <td>
                <a href="{{ URL::route('screen_edit',$list['alise']) }}" data-remote="false" data-toggle="modal"  data-target="#screenModal" class="btn btn-default modleScreenLink"><i class="fa fa-pencil"></i></a>

                </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="3">------No record Found------</td></tr>
            @endif
        </tbody>
    </table>
    <div class="modal fade" id="screenModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="screenModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-loader">
            <div class="modal-sub-content-1"><i class="fa fa-cog fa-spin"></i> <br/> Processing...</div>
            <div class="modal-sub-content-2"><i class="fa fa-check-circle"></i> <br/> Record updated successfully</div>
        </div>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Screen Box</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary saveScreenBtn">Save changes</button>
          </div>
        </div>
      </div>
    </div>
@stop