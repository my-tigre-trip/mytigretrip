<?php if ( comments_open() ) { ?>
	<div class="mkdf-comment-holder clearfix" id="comments">
		<?php if ( post_password_required() ) { ?>
			<p class="mkdf-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'gotravel' ); ?></p>
		<?php } ?>
		
		<?php if ( have_comments() ) { ?>
			<h4 class="mkdf-comments-label"><?php esc_html_e('Comments:', 'gotravel'); ?></h4>
			<div class="mkdf-comments">
				<ul class="mkdf-comment-list">
					<?php wp_list_comments( array( 'callback' => 'gotravel_mikado_comment' ) ); ?>
				</ul>
			</div>
		<?php } ?>
	</div>
	
	<?php
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	
	$args = array(
		'id_form'              => 'commentform',
		'id_submit'            => 'submit_comment',
		'title_reply'          => esc_html__( 'Leave a Reply:', 'gotravel' ),
		'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h4>',
		'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'gotravel' ),
		'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'gotravel' ),
		'label_submit'         => esc_html__( 'Submits', 'gotravel' ),
		'comment_field'        => '<textarea id="comment" placeholder="' . esc_html__( 'Comment', 'gotravel' ) . '" name="comment" cols="45" rows="12" aria-required="true"></textarea>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'fields'               => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="mkdf-three-columns clearfix"><div class="mkdf-three-columns-inner"><div class="mkdf-column"><div class="mkdf-column-inner"><input id="author" name="author" placeholder="' . esc_html__( 'Your full name', 'gotravel' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
			'email'  => '<div class="mkdf-column"><div class="mkdf-column-inner"><input id="email" name="email" placeholder="' . esc_html__( 'E-mail address', 'gotravel' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
			'url'    => '<div class="mkdf-column"><div class="mkdf-column-inner"><input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website', 'gotravel' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div></div>'
		) )
	);
	
	$args = apply_filters( 'gotravel_mikado_comment_form_final_fields', $args );
	?>
	
	<?php if ( get_comment_pages_count() > 1 ) { ?>
		<div class="mkdf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>
	<div class="mkdf-comment-form clearfix">
		<?php comment_form( $args ); ?>
	</div>
<?php } else { ?>
	<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'gotravel'); ?></p>
<?php } ?>
