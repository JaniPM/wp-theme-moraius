// WP doesn't allow $ so we use jQuery instead

// Loading page complete
jQuery(window).load(function()
{
	animateWhenVisible();  // Activate animation when visible
});

// Scroll to target
function scrollToTarget(D)
{
	if(D == 1) // Top of page
	{
		D = 0;
	}
	else if(D == 2) // Bottom of page
	{
		D = jQuery(document).height();
	}
	else // Specific Bloc
	{
		D = jQuery(D).offset().top;
		if(jQuery('.sticky-nav').length) // Sticky Nav in use
		{
			D = D-100;
		}
	}

	jQuery('html,body').animate({scrollTop:D}, 'slow');
}

// Animate when visible
function animateWhenVisible()
{
	hideAll(); // Hide all animation elements
	inViewCheck(); // Initail check on page load

	jQuery(window).scroll(function()
	{
		inViewCheck(); // Check object visability on page scroll
		scrollToTopView(); // ScrollToTop button visability toggle
		stickyNavToggle(); // Sticky nav toggle
	});
};

// Hide all animation elements
function stickyNavToggle()
{
	var V = 0; // offset Value
	var C = "sticky"; // Classes

	if(jQuery('.sticky-nav').parent().is('#hero-bloc')) // If nav is in hero animate in
	{
		V = jQuery('.sticky-nav').height();
		C = "sticky animated fadeInDown";
	}

	if(jQuery(window).scrollTop() > V)
	{
		jQuery('.sticky-nav').addClass(C);

		if(C == "sticky")
		{
			jQuery('.page-container').css('padding-top',jQuery('.sticky-nav').height());
		}
	}
	else
	{
		jQuery('.sticky-nav').removeClass(C);
		jQuery('.page-container').removeAttr('style');
	}
}

// Hide all animation elements
function hideAll()
{
	jQuery('.animated').each(function(i)
	{
		if(!jQuery(this).closest('.hero').length) // Dont hide hero object
		{
			jQuery(this).removeClass('animated').addClass('hideMe');
		}
	});
}

// Check if object is inView
function inViewCheck()
{
	jQuery(jQuery(".hideMe").get().reverse()).each(function(i)
	{
		var target = jQuery(this);
		var a = target.offset().top + target.height();
		var b = jQuery(window).scrollTop() + jQuery(window).height();

		if(target.height() > jQuery(window).height()) // If object height is greater than window height
		{
			a = target.offset().top;
		}

		if (a < b)
		{
			var objectClass = target.attr('class').replace('hideMe' , 'animated');
			target.css('visibility','hidden').removeAttr('class');
			setTimeout(function(){target.attr('class',objectClass).css('visibility','visible');},0.01);
		}
	});
};

// ScrollToTop button toggle
function scrollToTopView()
{
	if(jQuery(window).scrollTop() > jQuery(window).height()/3)
	{
		if(!jQuery('.scrollToTop').hasClass('showScrollTop'))
		{
			jQuery('.scrollToTop').addClass('showScrollTop');
		}
	}
	else
	{
		jQuery('.scrollToTop').removeClass('showScrollTop');
	}
};
