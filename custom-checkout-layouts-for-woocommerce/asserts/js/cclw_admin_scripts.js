(function($) {
	$(document).ready(function(){	
	   /*color picker code in admin fields*/
	   $('.cclw-color-picker').wpColorPicker();
	   /*accordian fields*/
	    $('.wp-panel').first().show();
		$('.shipping-first-tab').first().show();
	    $('.wp-accordion').on('click', function() {
        $(this).toggleClass('active');
        let panel = $(this).next('.wp-panel');

        if (panel.is(':visible')) {
            panel.slideUp();
        } else {
            panel.slideDown();
        }
    });
	   
	   $('.cclw_rating_wrap').delay(2000).slideDown('slow');
	   
	   /*customize checkout settings */
	   $('#billing_details_group_wrap').on("click",function(){
			 $('.shipping_details_group_wrap').hide();	
			 $('.billing_details_group_wrap').show();	
		
		});
		$('#shipping_details_group_wrap').on("click",function(){
			 $('.shipping_details_group_wrap').show();	
			 $('.billing_details_group_wrap').hide();
					 
		});
    });
	
	$(".cclw_rating_links .button2").on("click",function(){
                        var data = {
                    		action: 'cclw_update_rating',
                    		cclw_ratings: 'no',
						};
						
						
                    	$.post(cclw_ajax.ajax_url, data, function( response )
                		{
							$('.cclw_rating_wrap').slideUp('slow');
						}); 
                    });
	$(".cclw_rating_links .button3").on("click",function(){
	$('.cclw_rating_wrap').slideUp('slow');
	
	});	


	/** Customize checkout page tabs  */
	document.addEventListener('DOMContentLoaded', function () {
		const tabs = document.querySelectorAll('.nav-tab');
		const billing = document.getElementById('cclw_billing_fields');
		const shipping = document.getElementById('cclw_shipping_fields');

		tabs.forEach(tab => {
			tab.addEventListener('click', function (e) {
				e.preventDefault();
				tabs.forEach(t => t.classList.remove('nav-tab-active'));
				this.classList.add('nav-tab-active');

				if (this.dataset.tab === 'billing') {
					billing.style.display = 'block';
					shipping.style.display = 'none';
				} else {
					billing.style.display = 'none';
					shipping.style.display = 'block';
				}
			});
		});
	});

// Dispaly Hide/show Field when required field is false

jQuery(document).ready(function($) {
  function cclw_show_hide_visibility(target) {
    if (jQuery('input[data-target="' + target + '"]:checked').val() === 'false') {
      jQuery('.cclw-show-hide.' + target).slideDown();
    } else {
      jQuery('.cclw-show-hide.' + target).slideUp();
	  jQuery('input[name="cclw_checkout_fields[' + target + '][show_hide]"][value="show"]').prop('checked', true);
    }
  }

  // Initial check for all required fields
  jQuery('.required-toggle').each(function() {
    cclw_show_hide_visibility(jQuery(this).data('target'));
  });

  // On change
  jQuery('.required-toggle').on('change', function() {
    var target = jQuery(this).data('target');
    cclw_show_hide_visibility(target);
  });
});
	
})(jQuery);