(function($){

	// MENU drawer
	$('.drawer').drawer({
	  class: {
		nav: 'drawer-nav',
		toggle: 'drawer-toggle',
		overlay: 'drawer-overlay',
		open: 'drawer-open',
		close: 'drawer-close',
		dropdown: 'drawer-dropdown'
	  },
	  iscroll: {
		mouseWheel: true,
		preventDefault: false
	  },
	  showOverlay: true
	});

	//スクロール禁止用関数
	function no_scroll(){
		addEventListener(document, "touchstart", function(e) {
			e.preventDefault();
		},{passive: true});
	}

	// INDEX overlay
	$(".m-header-locallink-box").click(function() {
		$(".m-header-locallink-nav").fadeIn();
		$(".m-header-locallink-box.close").css({
			"display":"block"
		});
		//スクロールリスナージャンク
		no_scroll();
	});
	$(".m-header-locallink-box.close").click(function(){
		$(".m-header-locallink-nav").fadeOut();
		$(".m-header-locallink-box.close").css({
			"display":"none"
		});
	});

	$(window).on('load resize',function(){
		// headerのwrapの自動可変計算
		var cssTemplate = '<style type="text/css">#header-wrap:after{height: #[height];}</style>',
			//　150/320 = 0.46875
			wrapHeight = $(window).width() * 0.46875,
			afterCSS = cssTemplate.replace('#[height]', wrapHeight+'px');
		$('#headerStyles').replaceWith($(afterCSS));
	});

})(jQuery);