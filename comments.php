<div class="comments">
  <?php if( have_comments() ): ?>
  <h3>コメント</h3>
  <ul>
    <?php
      $args = array(
        // 'avatar_size'=>0,// アバターを非表示
        // 'max_depth'=>0,// 返信欄を非表示
        'format'=>'html5',
    ); ?>
    <?php wp_list_comments( $args ); ?>
  </ul>
  <?php endif; ?>

  <?php
  $commenter = wp_get_current_commenter();
  // $aria_req = true;
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $comments_args = array(
    'class_submit'=>'submit btn btn-primary',
    'format'=>'html5',
    'title_reply'=>'コメントを残す',
    'comment_field' =>  '<div class="form-group"><label for="comment">' . __( '<i class="fas fa-envelope"></i> Message', 'noun' ) .
       '</label><textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true">' .
       '</textarea></div>',

    'fields' => apply_filters( 'comment_form_default_fields', array(

      'author' =>
        '<div class="form-row"><div class="form-group col-md-6 author">' .
        '<label for="author">' . __( '<i class="fas fa-user"></i> Name', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . '></div>',

      'email' =>
        '<div class="form-group col-md-6 email">' .
        '<label for="email">' . __( '<i class="fas fa-at"></i> E-mail', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . '></div></div>',

      'url' =>
        '<div class="form-group url">' .
        '<label for="url">' . __( '<i class="fas fa-link"></i> Website url', 'domainreference' ) . '</label>' .
        '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30"></div>'
      )
    ),
  ); ?>
  <?php comment_form( $comments_args ); ?>
</div>
