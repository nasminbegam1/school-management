//jQuery.noConflict();

jQuery(document).ready(function(){
	
	// dropdown in leftmenu
	jQuery('.leftmenu .dropdown > a').click(function(){
		if(!jQuery(this).next().is(':visible'))
			jQuery(this).next().slideDown('fast');
		else
			jQuery(this).next().slideUp('fast');	
		return false;
	});
	
	
	if(jQuery.uniform) 
	   jQuery('input:checkbox, input:radio, .uniform-file').uniform();
		
	if(jQuery('.widgettitle .close').length > 0) {
		  jQuery('.widgettitle .close').click(function(){
					 jQuery(this).parents('.widgetbox').fadeOut(function(){
								jQuery(this).remove();
					 });
		  });
	}
	
	
   // add menu bar for phones and tablet
   jQuery('<div class="topbar"><a class="barmenu">'+
		    '</a><div class="chatmenu"></a></div>').insertBefore('.mainwrapper');
	
	jQuery('.topbar .barmenu').click(function() {
		  
		  var lwidth = '260px';
		  if(jQuery(window).width() < 340) {
					 lwidth = '240px';
		  }
		  
		  if(!jQuery(this).hasClass('open')) {
					 jQuery('.rightpanel, .headerinner, .topbar').css({marginLeft: lwidth},'fast');
					 jQuery('.logo, .leftpanel').css({marginLeft: 0},'fast');
					 jQuery(this).addClass('open');
		  } else {
					 jQuery('.rightpanel, .headerinner, .topbar').css({marginLeft: 0},'fast');
					 jQuery('.logo, .leftpanel').css({marginLeft: '-'+lwidth},'fast');
					 jQuery(this).removeClass('open');
		  }
	});
	
	jQuery('.topbar .chatmenu').click(function(){
		if(!jQuery('.onlineuserpanel').is(':visible')) {
			jQuery('.onlineuserpanel,#chatwindows').show();
			jQuery('.topbar .chatmenu').css({right: '210px'});
		} else {
			jQuery('.onlineuserpanel, #chatwindows').hide();
			jQuery('.topbar .chatmenu').css({right: '10px'});
		}
	});
	
	// show/hide left menu
	jQuery(window).resize(function(){
		  if(!jQuery('.topbar').is(':visible')) {
		         jQuery('.rightpanel, .headerinner').css({marginLeft: '260px'});
					jQuery('.logo, .leftpanel').css({marginLeft: 0});
		  } else {
		         jQuery('.rightpanel, .headerinner').css({marginLeft: 0});
					jQuery('.logo, .leftpanel').css({marginLeft: '-260px'});
		  }
   });
	
	// dropdown menu for profile image
	jQuery('.userloggedinfo img').click(function(){
		  if(jQuery(window).width() < 480) {
					 var dm = jQuery('.userloggedinfo .userinfo');
					 if(dm.is(':visible')) {
								dm.hide();
					 } else {
								dm.show();
					 }
		  }
   });
	
	// change skin color
	jQuery('.skin-color a').click(function(){ return false; });
	jQuery('.skin-color a').hover(function(){
		var s = jQuery(this).attr('href');
		if(jQuery('#skinstyle').length > 0) {
			if(s!='default') {
				jQuery('#skinstyle').attr('href','css/style.'+s+'.css');	
				jQuery.cookie('skin-color', s, { path: '/' });
			} else {
				jQuery('#skinstyle').remove();
				jQuery.cookie("skin-color", '', { path: '/' });
			}
		} else {
			if(s!='default') {
				jQuery('head').append('<link id="skinstyle" rel="stylesheet" href="css/style.'+s+'.css" type="text/css" />');
				jQuery.cookie("skin-color", s, { path: '/' });
			}
		}
		return false;
	});
	
	// load selected skin color from cookie
	/*if(jQuery.cookie('skin-color')) {
		var c = jQuery.cookie('skin-color');
		if(c) {
			jQuery('head').append('<link id="skinstyle" rel="stylesheet" href="css/style.'+c+'.css" type="text/css" />');
			jQuery.cookie("skin-color", c, { path: '/' });
		}
	}*/
	
	
	// expand/collapse boxes
	if(jQuery('.minimize').length > 0) {
		  
		  jQuery('.minimize').click(function(){
					 if(!jQuery(this).hasClass('collapsed')) {
								jQuery(this).addClass('collapsed');
								jQuery(this).html("&#43;");
								jQuery(this).parents('.widgetbox')
										      .css({marginBottom: '20px'})
												.find('.widgetcontent')
												.hide();
					 } else {
								jQuery(this).removeClass('collapsed');
								jQuery(this).html("&#8211;");
								jQuery(this).parents('.widgetbox')
										      .css({marginBottom: '0'})
												.find('.widgetcontent')
												.show();
					 }
					 return false;
		  });
			  
	}
	
	// fixed right panel
	var winSize = jQuery(window).height();
	if(jQuery('.rightpanel').height() < winSize) {
		jQuery('.rightpanel').height(winSize);
	}
	
	
	// if facebook like chat is enabled
	/*if(jQuery.cookie('enable-chat')) {
		
		jQuery('body').addClass('chatenabled');
		jQuery.get('ajax/chat.html',function(data){
			jQuery('body').append(data);
		});
		
	} else {
		
		if(jQuery('.chatmenu').length > 0) {
			jQuery('.chatmenu').remove();
		}
		
	}*/
	
	jQuery(".form-validation").validate();
	setTimeout(function () {
		jQuery(".title-success").animate({opacity: 1.0}, 1000).fadeOut("900")
	    }, 10000
	);
	
	jQuery(".module_checkbox").click(function(){
		 var c = jQuery(this).prop('checked');
		 if(c == true){
			jQuery(this).parents('.sub').find('.uncheck_module_checkbox').prop('checked',false);
		 }else{
			jQuery(this).parents('.sub').find('.uncheck_module_checkbox').prop('checked',true);
		 }
		 
	});

	jQuery('.changeStatusBtn').click(function(){

		var id = jQuery(this).attr('data-id');
		var type = jQuery(this).attr('data-type');
		var status = jQuery(this).attr('data-status');
		var element = jQuery(this);
		jQuery.ajax({
			type:'POST',
			url: BASE_URL+'/change-status',
			data:{
				id 	: id,
				type : type,
				status : status,
				_token : CSRF_TOKEN
			},
			beforeSend: function(){
				jQuery(element).find('i').removeAttr('class');
				jQuery(element).find('i').addClass('fa fa-cog fa-spin');
			},
			dataType: 'JSON',
			success:function(response){
				jQuery(element).find('i').removeAttr('class');
				if(response.status == 1){
					jQuery(element)
						.attr('title','Approved')
						.removeClass('inactiveStatus')
						.addClass('activeStatus');
					jQuery(element).find('i').addClass('fa fa-check-circle');		
				}
				else if(response.status == 0){
					jQuery(element)
						.attr('title','Rejected')
						.removeClass('activeStatus')
						.addClass('inactiveStatus');
					jQuery(element).find('i').addClass('fa fa-times-circle');		
				}
			}
		})
	});

$(".modleScreenLink[data-toggle='modal']").on('click', function(e) {
    $_clObj = $(this); //clicked object
    $_mdlObj = $_clObj.attr('data-target'); //modal element id 
    $($_mdlObj).on('shown.bs.modal',{ _clObj: $_clObj }, function (event) {
           $_clObj = event.data._clObj; //$_clObj is the clicked element !!!
           //do your stuff here...
           $($_mdlObj).find(".modal-body").load($($_clObj).attr('href'),function(){
           			$(".saveScreenBtn").click(function(){

           				var action = $(".screenUpdateFrm").attr('action');
           				var data   = $(".screenUpdateFrm").serialize() ;
           				$.ajax({
           						url 			: action,
           						data 			: data,
           						type 			: 'POST',
           						dataType 		: 'JSON',
           						beforeSend		: function(){
			           							$(".modal-loader").show();
			           							$(".modal-loader .modal-sub-content-1").show();
           						},
           						success 		:function(response){
		           							if(response.status == 1){
			           							$(".modal-loader .modal-sub-content-1").hide();
			           							$(".modal-loader .modal-sub-content-2").show();
			           							setTimeout(function(){
			           								$(".modal-loader .modal-sub-content-2").hide();
			           								$(".modal-loader").hide();
			           							},1500);
		           							}
           						}
           				});
           			});
		    });
    });
    $($_mdlObj).on('hidden.bs.modal', function () {
	    window.location.reload();
	})
});


	/*$("#screenModal").on("show.bs.modal", function(e) {
	    var link = $(e.relatedTarget);
	    //var link = $("#modleScreenLink").attr('href');
	    
	});*/
});