	$(function(){
		$(window).scroll(function(){
			if ($(this).scrollTop()>120) {
				$('.header').css({
					'position' : 'fixed',
					'height' : '40px',
					'width' : '100%'
				});
				
				$('.header').addClass('header__fixed');
			}
			else{
				$('.header').css({
					'position' : 'relative',
					'height' : '80px',
					'width' : ''
				});
				$('.header').removeClass('header__fixed');
				
			}
		});
	});