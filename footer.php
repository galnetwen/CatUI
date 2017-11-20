<?php $this->footer(); ?>
    <div class="btn-top fa fa-angle-up float-button-light waves-effect waves-float waves-light"></div>

    <script src="//cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="<?php $this->options->themeUrl('js/waves.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/catui.js'); ?>"></script>
    <?php if (!empty($this->options->OtherTool) && in_array('smoothscroll', $this->options->OtherTool)): ?>
    <script src="<?php $this->options->themeUrl('js/smoothscroll.js'); ?>"></script>
    <?php endif;?>
    <?php if (!empty($this->options->OtherTool) && in_array('fireworks', $this->options->OtherTool)): ?>
    <script src="<?php $this->options->themeUrl('js/fireworks.js'); ?>"></script>
    <script>
        POWERMODE.colorful = 1; //启用礼花特效
        POWERMODE.shake = 0; //关闭震动特效
        document.body.addEventListener('input', POWERMODE);
    </script>
    <?php endif;?>
    <?php $this->options->statistics(); ?>
