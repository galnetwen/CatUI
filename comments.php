<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
$textarea = Helper::options()->commentsHTMLTagAllowed;
function threadedComments($comments, $options) {
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;
    if ($comments->url) {
        $author = '<a href="'.$comments->url.'"target="_blank" rel="external nofollow" tooltip="'.$comments->author.'">'.$comments->author.'</a>';
    } else {
        $author = $comments->author;
    }
?>
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($depth > 1 && $depth < 3) {
    echo ' comment-child ';
    $comments->levelsAlt('comment-level-odd', ' comment-level-even');
}
else if( $depth > 2){
    echo ' comment-child2';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
}
else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
?>">
    <div id="<?php $comments->theId(); ?>">
        <?php
            //$host = '//cdn.v2ex.com';
  			$host = '//cn.gravatar.com';
  			//$url = '/gravatar/';
            $url = '/avatar/';
            $size = '100';
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $email = strtolower($comments->mail);
            $sjtx = Typecho_Widget::widget('Widget_Options')->motx;
            $qq = str_replace('@qq.com','',$email);
            if(strstr($email,"qq.com") && is_numeric($qq)){
                $avatar = '//q.qlogo.cn/g?b=qq&nk='.$qq.'&s=100';
            }else{
                $avatar = $host.$url.$hash.'?s='.$size.'&r='.$rating.'&d='.$sjtx;
            }
        ?>
        <div class="comment-view" onclick="">
            <div class="comment-header">
                <a href="<?php echo $comments->url; ?>"target="_blank" rel="external nofollow"><img class="avatar" src="<?php echo $avatar ?>"></a>
            </div>
            <div class="comment-content">
                <p>
                    <?php 
                        getCommentAt($comments->coid);
                        $cos = preg_replace('#<p>#','',$comments->content);
                        $cos1 = preg_replace('#</p>#','',$cos);
                        echo $cos1;
                    ?>
                </p>
                <div class="comment-meta">
                    <span class="comment-author"><i class="fa fa-user"></i> <?php echo $author; ?></span>
                    <span class="comment-time" tooltip="<?php $comments->date('Y-m-d H:i:s A'); ?>"><i class="fa fa-clock-o"></i> <?php $comments->date('n月j日'); ?></span>
                    <span class="comment-reply" tooltip="回复"><?php $comments->reply('<i class="fa fa-reply"></i> 回复'); ?></span>
                </div>
            </div>
        </div>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <div id="response">
                    <div class="avatar">
                        <img src="<?php $this->options->themeUrl('img/comments.png'); ?>" />
                    </div>
                    <textarea name="text" id="textarea" placeholder='客官您不美言几句么...' required><?php $this->remember('text'); ?></textarea>
                    <button type="submit" class="fa fa-send float-button-light waves-effect waves-light"></button>
                </div>
                <?php if($this->user->hasLogin()): ?>
                <?php else: ?>
                <div class="info center">
                    <input type="text" name="author" id="author" class="text" placeholder="昵称" value="<?php $this->remember('author'); ?>" required />
                    <input type="email" name="mail" id="mail" class="text" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    <input type="url" name="url" id="url" class="text" placeholder="博客" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                </div>
                <?php endif; ?>
            </form>
        </div>
    <?php else: ?>
    <h3 class="center"><?php _e('这里不可以评论噢...'); ?></h3>
    <?php endif; ?>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>
</div>
