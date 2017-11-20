<?php 
/** 
  * 情托于物。人情冷暖，世态炎凉。
  * @package Cat UI 
  * @author 折影轻梦 
  * @version 1.3.3
  * @link http://i.chainwon.com/ 
*/ 
$this->need('header.php'); ?>
<body>
    <div id="content">
        <div class="container">
            <?php $this->need('nav.php'); ?>
            <?php while($this->next()): ?>
            <article class="h-lists">
                <h2 class="h-list"><a href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title() ?></a></h2>
                <ul class="h-meta">
                    <li tooltip="该文章使用的标签"><i class="fa fa-tags"></i> <?php $this->tags(' ', true); ?></li>
                    <?php if($this->user->hasLogin()):?>
                    <li class="right" tooltip="编辑该文章"><a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" class="edit-btn" target="_blank"><i class="fa fa-edit"></i> 编辑</a></li>
                    <?php endif;?>
                    <li class="right" tooltip="该文章在<?php $this->date('Y'); ?>年<?php $this->date('n'); ?>月<?php $this->date('d'); ?>日最后发布"><i class="fa fa-clock-o"></i> <?php $this->date('n'); ?>月<?php $this->date('d'); ?>日</li>
                    <li class="right" tooltip="该文章已经有<?php get_post_view($this) ?>次围观了"><i class="fa fa-eye"></i> <?php get_post_view($this) ?>次围观</li>
                </ul>
            </article>
            <?php endwhile; ?>
            <?php $this->pageNav(); ?>
            <?php $this->need('bottom.php'); ?>
        </div>
    </div>
    <?php $this->need('footer.php'); ?>
</body>
</html>