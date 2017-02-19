<?php
	$url_encode=urlencode(get_permalink());
	$title_encode=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>

<div class="share">

	<h3 class="share-title">
		<span class="en">SHARE</span>
		<span class="jp">この記事をシェアする</span>
	</h3>
	<ul>
		<!--Facebookボタン-->
		<li class="facebook"><a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
			<span class="icon-facebook"></span>facebook<?php if(function_exists('scc_get_share_facebook')) echo (scc_get_share_facebook()==0)?'':scc_get_share_facebook(); ?></a>
		</li>

		<!--ツイートボタン-->
		<li class="tweet"><a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&tw_p=tweetbutton" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
			<span class="icon-twitter"></span>tweet<?php if(function_exists('scc_get_share_twitter')) echo (scc_get_share_twitter()==0)?'':scc_get_share_twitter(); ?></a>
		</li>

		<!--はてなボタン-->
		<li class="hatena"><a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_encode ?>"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;"><span class="icon-hatena"></span>hatena<?php if(function_exists('scc_get_share_hatebu')) echo (scc_get_share_hatebu()==0)?'':scc_get_share_hatebu(); ?></a>
		</li>

		<!--ポケットボタン-->
		<li class="pocket">
			<a href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>"><span class="icon-pocket"></span>Pocket<?php if(function_exists('scc_get_share_pocket')) echo (scc_get_share_pocket()==0)?'':scc_get_share_pocket(); ?></a>
		</li>

		<!--RSSボタン-->
		<!-- <li class="rss">
			<a href="<?php echo home_url(); ?>/?feed=rss2"><span class="icon-rss"></span> RSS</a>
		</li> -->

	</ul>
</div>