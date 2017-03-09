@extends('layout')

@section('pageheader')
    <div class="pageheader">
        <div class="pageicon"><span class="iconfa-pencil"></span></div>
        <div class="pagetitle">
            <h5>Screen</h5>
            <h1>Add</h1>
        </div>
    </div><!--pageheader-->
@stop

@section('content')         
    <div class="widget">
        <h4 class="widgettitle">With Form Validation</h4>
        <div class="widgetcontent wc1">
            <form id="form1" class="stdform" method="post" action="forms.html">
                    <div class="par control-group">
                            <label class="control-label" for="firstname">First Name</label>
                        <div class="controls"><input type="text" name="firstname" id="firstname" class="input-xxlarge" /></div>
                    </div>
                    
                    <div class="control-group">
                            <label class="control-label" for="lastname">Last Name</label>
                        <div class="controls"><input type="text" name="lastname" id="lastname" class="input-xxlarge" /></div>
                    </div>
                    
                    <div class="par control-group">
                            <label class="control-label" for="email">Email</label>
                        <div class="controls"><input type="text" name="email" id="email" class="input-xxlarge" /></div>
                    </div>
                    
                    <div class="par control-group">
                            <label class="control-label" for="location">Location</label>
                        <div class="controls"><textarea cols="80" rows="5" name="location" class="input-xxlarge" id="location"></textarea></div> 
                    </div>
                                            
                    <p class="stdformbutton">
                            <button class="btn btn-primary">Submit Button</button>
                    </p>
            </form>
        </div><!--widgetcontent-->
    </div><!--widget-->
@stop