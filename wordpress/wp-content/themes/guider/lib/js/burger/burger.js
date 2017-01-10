$(function($){
	//バーガーメニュー
	var burger = $('#navBurger'),
		burgerSpan = $('.square span'),
		burgerSpanwrap = $('.burgerwrap');

	burger.on('click',BurgerButton);
	
	function BurgerButton(){

		if($(this).hasClass('squareHover burgerwrap squareSpan')){
			$(this).addClass('squareSpanL').removeClass('squareHover burgerwrap squareSpan squareSpanL_r');
		}else{
			$(this).removeClass('squareSpanL').addClass('squareHover burgerwrap squareSpan squareSpanL_r');
		}
	}
});