<?php $this->need('header.php'); ?>
<body>
    <div id="content">
        <div class="container">
            <?php $this->need('nav.php'); ?>
            <article>
                <h2 class="t-list center"><?php $this->title(); ?></h2>
                <ul class="h-meta center">
                    <li tooltip="该文章使用的标签"><i class="fa fa-tags"></i> <?php $this->tags(' ', true); ?></li>
                    <li tooltip="该文章总计有<?php art_count($this->cid); ?>个汉字"><i class="fa fa-bar-chart"></i> <?php art_count($this->cid); ?>个汉字</li>
                    <li tooltip="该文章已经有<?php get_post_view($this) ?>次围观了"><i class="fa fa-eye"></i> <?php get_post_view($this) ?>次围观</li>
                    <li tooltip="该文章在<?php $this->date('Y'); ?>年<?php $this->date('n'); ?>月<?php $this->date('d'); ?>日最后发布"><i class="fa fa-clock-o"></i> <?php $this->date('n'); ?>月<?php $this->date('d'); ?>日</li>
                    <?php if($this->user->hasLogin()):?>
                    <li tooltip="编辑该文章"><a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" class="edit-btn" target="_blank"><i class="fa fa-edit"></i> 编辑</a></li>
                    <?php endif;?>
                </ul>
                <div class="t-content">
                    <?php $this->content(); ?>
                    <hr>
                </div>
                <div class="others">
                    <?php if (!empty($this->options->OtherTool) && in_array('pages', $this->options->OtherTool)): ?>
                    <div class="pages">
                        <div class="prev flat-icon-light waves-effect waves-circle waves-light">
                            <?php $this->thePrev('<i class="fa fa-arrow-left"></i> %s', '<i class="fa fa-arrow-left"></i> <a>没有上一篇文章了！</a>'); ?>
                        </div>
                        <div class="pnext flat-icon-light waves-effect waves-circle waves-light">
                            <?php $this->theNext('%s <i class="fa fa-arrow-right"></i>', '<a>没有下一篇文章了！</a> <i class="fa fa-arrow-right"></i>'); ?>
                        </div>
                    </div>
                    <?php endif;?>
                    <div class="tags">
                        <?php $this->tags(' ', true); ?>
                    </div>
                </div>
                <?php $this->need('comments.php'); ?>
            </article>
            <?php $this->need('bottom.php'); ?>
        </div>
    </div>
    <?php $this->need('footer.php'); ?>
</body>
</html>