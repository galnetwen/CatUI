<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw=&atom=&rss1=&rss2='); ?>
    <title><?php $this->archiveTitle(array( 'category' => _t('分类 %s 下的文章'), 'search' => _t('包含关键字 %s 的文章'), 'tag' => _t('标签 %s 下的文章'), 'author' => _t('%s 发布的文章') ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/waves.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/tooltip.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/catui.css'); ?>">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/highlight.js/9.12.0/styles/monokai-sublime.min.css">
    <style>
        body {
            background: #f3f3f3 url(<?php $this->options->themeUrl('img/bg-bottom.svg'); ?>) no-repeat center bottom fixed;
        }
    </style>
</head>
