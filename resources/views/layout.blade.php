<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Shamcey - Metro Style Admin Template</title>

<link rel="stylesheet" href="/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="/css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="/css/bootstrap-timepicker.min.css" type="text/css" />

<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="/js/jquery.autogrow-textarea.js"></script>
<script type="text/javascript" src="/js/charCount.js"></script>
<script type="text/javascript" src="/js/colorpicker.js"></script>
<script type="text/javascript" src="/js/ui.spinner.min.js"></script>
<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/modernizr.min.js"></script>
<script type="text/javascript" src="/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
<script type="text/javascript" src="/js/forms.js"></script>
</head>

<body>

<div id="mainwrapper" class="mainwrapper">
    
    <div class="header">
        @include('layout.header')
    </div>
    
    <div class="leftpanel">
        @include('layout.leftmenu')
    </div><!-- leftpanel -->
    
    <div class="rightpanel">
        
        {!! Breadcrumbs::render() !!}
        
        @yield('pageheader')
        
        <div class="maincontent">
            <div class="maincontentinner">
            
            @yield('content')
<!--        New Line    -->
            <div class="footer">
                @include('layout.footer')
            </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->

</body>
</html>
