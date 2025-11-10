function initiate_dropdowns(dropdown_selectors, onChangeF){
	$(dropdown_selectors).each(function(){
		//var ph = $(this).attr('placeholder');
		// var width = '200px';
		$(this).multiselect({
			buttonWidth: '125px',
			maxHeight: 300,
            onChange: onChangeF,
            // buttonClass: '',
			nonSelectedText: $(this).attr('placeholder'),
			nSelectedText: $(this).attr('placeholder'),
			numberDisplayed: 0,
			templates: {
				button: '<button type="button" class="multiselect dropdown-toggle btnFilterer" data-toggle="dropdown"><span class="multiselect-selected-text"></span></button>',
				ul: '<ul class="multiselect-container dropdown-menu bkgr-green-op" ></ul>',
				filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
				filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span>',
				li: '<li><a href="javascript:void(0);"><label class="" style="color:white;width:100%"></label></a></li>',
				divider: '<li class="multiselect-item divider"></li>',
				liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
			}
		});
	});
}

function show_loader(){
	$('.loading-div').removeClass('invisible');
}

function hide_loader(){
	$('.loading-div').addClass('invisible');
}

/*
$(document).ajaxSend(function(e, xhr, opt) {
	//show_loader();
});

$(document).ajaxStop(function(e, xhr, opt) {
	//hide_loader();
});
*/

function goBack(hash='') {
	//
	var isSearchReferral = document.referrer.indexOf('search') > -1;
	//console.log( document.referrer + ( hash !== '' && !isSearchReferral ? '#' + hash : '' ) );
	
	if( hash !== '' && !isSearchReferral ){
		 window.location = document.referrer + '#' + hash;
	} else {
		window.history.back();
	}
	
}

//
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-28164702-1']);
_gaq.push(['_trackPageview']);

(function() {
	var ga = document.createElement('script');
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(ga, s);
})();



// Unveil initializes
$(document).ready(function() {
	$("img").not('.force-preload').unveil();
});

// When URL contains 'opuzen.com/product/<specific item name>',
// find the specific item and fire off the pop-up modal
$(document).ready(function() {
    // PKL Get the current URL
    var currentUrl = window.location.href;
    // PKL Check if 'opuzen.com/product/' is in the URL
    if (currentUrl.includes('opuzen.com/product/')) {
        var urlParts = currentUrl.split('/');
        var productLineIndex = urlParts.indexOf('product') + 1;
        var specificItem = urlParts[productLineIndex + 1]; 
        if (specificItem !== undefined) {
			specificItem = specificItem.toLowerCase();
            console.log("The specific item is: ", specificItem);
			// Use jQuery to find the img element with the data-color attribute
			var imgElement = $('img').filter(function() {
				let color = $(this).attr('data-color');
				color = color ? color.toLowerCase() : '';
				return color === specificItem;
			});
			if (imgElement.length > 0) {
				console.log('Image with data-color "'+specificItem+'" found:');
				// Fire off the pop-up modal
				on_figure_img_click(imgElement);
			} else {
				console.log('No image with data-color "'+specificItem+'" found.');
			}
        } else {
			console.log("Specific item not found in " + currentUrl );
		}

    } else {
        console.log("'opuzen.com/product/' not found in the current URL.");
    }
});

// Neccesary for submenu clicking
$('a.redir').off('click').on('click', function() {
	window.stop();
	var id = $(this).attr('data-id');
	var name = $(this).attr('data-name');
	var category = $(this).attr('data-category');
	var contr = $(this).attr('data-contr');

	$('input#category').val(category);
	$('input#member_id').val(id);
	var old = $('form#menu_ex').attr('action');
	$('form#menu_ex').attr('action', old + contr + '/' + name);
	$('form#menu_ex').submit();
});

/*
  To view a product
*/
$(document).on("click", 'img.image-preview', function(event) {
	var id = $(this).attr('data-id');
	var category = $(this).attr('data-category');
	var name = $(this).attr('data-name');
	//var url_title = $(this).attr('data-url');

	if (category == 'digital_styles') {
		name = 'digital/' + name; // the form action (1)
	}
	if (category == 'digital_grounds') {
		instantView(id, $(this).attr('src'), category);
	} else {
		$('input#category').val(category);
		$('input#member_id').val(id);
		var old = $('form#product_view').attr('action');
		$('form#product_view').attr('action', old + name); // (1) here
		$('form#product_view').submit();
	}

})

/*
	Controlls the HASH in the urls
*/

$( document ).ajaxComplete(function() {
	var hash = window.location.hash;
	console.log('hash', hash);
	if( hash !== '' ){
		target_element = document.getElementById( hash.substr(1) );
		// Search for the element that has the hash name and scroll down
		// window.scroll(0, findPos(target_element));
		target_element.scrollIntoView();

		var urlstr = window.location.href;
		if( urlstr.indexOf('digital/grounds') >= 0 ){
			 $("img[data-name='"+hash.substr(1)+"']").trigger('click');
		}
		
	}
});

function findPos(obj) {
    var curtop = 0;
    if (obj.offsetParent) {
        do {
            curtop += obj.offsetTop;
        } while(obj == obj.offsetParent);
    return [curtop];
    }
}