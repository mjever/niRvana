<?php
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks.' );
?>

<?php if ( !(!$comments & 'open' != $post->comment_status) ):  ?>
			<div id="comments">
<?php
	if ( !empty($post->post_password) ) :
		if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
				<div class="nopassword"><?php _e( 'This post is protected. Enter the password to view any comments.', 'sandbox' ) ?></div>
			</div><!-- .comments -->
<?php
		return;
	endif;
endif;
?>

<div class="post-model"><i class="far fa-comment-alt"></i><?php echo $post->comment_count; ?> 条回应</div>
<div class="tip">
		<p>根据相关法律法规和政策，因技术原因暂不开放评论</p>
	</div>
			</div><!-- #comments -->
<?php endif; ?>