$(document).ready(function() {



		$('a.logo').hover(function()
		{
			var img=$(this),
				nr=img.data('nr'),
				imgwidth=img.position().left+($(this).width()/2);

			img.children('img').stop().fadeTo(300, 1);

			//$('#boxes').find('div').eq(nr).css('left', imgwidth-106).css('opacity',0).show().animate({'opacity':1});
			//$('#slideshow').cycle('pause');
		}, function () 
		{
			$(this).children('img').stop().fadeTo(500, 0);
			var nr=$(this).data('nr');
			//$('#boxes').find('div').eq(nr).hide();
			//$('#slideshow').cycle('resume');			
		});
					

	});