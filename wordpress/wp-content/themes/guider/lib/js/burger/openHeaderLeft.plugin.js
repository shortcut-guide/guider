// プラグインの定義
$.fn.openHeaderLeft = function(options){
  options = $.extend({
		wrapName: ".site-header.active",
    navName: ".h_nav-outer",
    btnName: ".js-header-btn"
  }, options);
  return this.each(function(){
    var $this = $(this),
        $r1 = $(options.wrapName),
        $r2 = $(options.navName);
    // メイン関数
    function openHeader(){
      if( $r1.hasClass('open') ){
        //CSS クラスを外して、transionを実行させる
       $r1.removeClass('open');
        //コンテンツの非表示の時差を付ける
        setTimeout( function(){
            $r2.css('visibility','hidden');
            $('.h-h1').css('visibility','visible');
          },500);
      }else{
        $r1.addClass('open');
        $r2.css('visibility','visible');

        // ロゴの非表示
        $('.h-h1').css('visibility','hidden');
      }
    }
    //メイン関数の実行
    $(document).on('click',options.btnName,openHeader);
  });
}
