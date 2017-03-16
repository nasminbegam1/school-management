
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(array('route'=>array('screen_update',$screen_alise_name),'class'=>'screenUpdateFrm stdform form-validation','files'=>true,'method'=>'post')) !!}
        {!! Form::hidden('screen_alise',$screen_alise_name) !!}
        {!! Form::hidden('screen_name',$screen_name) !!}
        {!! Form::hidden('group_name',$group_name) !!}
        <div class="col-md-12">
        <div class="form-group">
        <label class="control-label col-md-3">Group Name</label>
        <div class="col-md-9">{!! $group_name !!}</div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
        <label class="control-label col-md-3">Screen Name</label>
        <div class="col-md-9">{!! $screen_name !!}</div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
        <label class="control-label col-md-3">Screen Module</label>
        {!! Form::select('module',[''=>'Select Any Module']+$module,'',array('class'=>'form-control col-md-9')) !!}
        </div>
         <div class="clearfix"></div>
        
        <div class="form-group">
        <label class="control-label col-md-3">Screen Status</label>
        {!! Form::select('status',[''=>'Select Status','1'=>'Active','0'=>'Inactive'],'',array('class'=>'form-control col-md-9')) !!}
        </div>
         <div class="clearfix"></div>
         <div class="form-group">
        <label class="control-label col-md-3">Is Visible in left panel?</label>
        {!! Form::checkbox('is_left_visible','1','') !!}
        </div>
        <div class="clearfix"></div>
        </div>
                    
        {!! Form::close() !!}
     