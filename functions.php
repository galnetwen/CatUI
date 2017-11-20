<?php
function  themeConfig ($form){
    $nversion='1.3.3';
    $lversion=file_get_contents("https://i.chainwon.com/version.txt");
    if ($lversion>$nversion){
        echo '<p style="font-size:18px;">你正在使用 <a>'.$nversion.'</a> 版本的Cat UI，最新版本为 <a style="color:red;">'.$lversion.'</a><a href="https://i.chainwon.com/catui.html"><button type="submit" class="btn btn-warn" style="margin-left:10px;">前往更新</button></a></p>';
    }else {
        echo '<p style="font-size:18px;">你正在使用最新版的Cat UI！</p>';
    }
    $logoUrl=new Typecho_Widget_Helper_Form_Element_Text('logoUrl',NULL,NULL,_t ('喵咪の男主人的头像'),_t ('填入一个头像URL地址，必须添加以正常显示。'));
    $form->addInput ($logoUrl);
    $logoUrl2=new Typecho_Widget_Helper_Form_Element_Text('logoUrl2',NULL,NULL,_t ('喵咪の女主人的头像'),_t ('填入一个头像URL地址，留空侧显示博主简介。'));
    $form->addInput ($logoUrl2);
    $girlid=new Typecho_Widget_Helper_Form_Element_Text('girlid',NULL,NULL,_t ('喵咪の女主人的ID码'),_t ('填入一个注册在本站的用户数字ID。'));
    $form->addInput ($girlid);
    $statistics=new Typecho_Widget_Helper_Form_Element_Textarea('statistics',NULL,NULL,_t ('喵咪の主人的网页统计代码'),_t ('为你的网站添加统计代码。'));
    $form->addInput ($statistics);
    $OtherTool=new Typecho_Widget_Helper_Form_Element_Checkbox('OtherTool',array ('smoothscroll'=>_t ('喵咪の柔软（开启页面平滑滚动）'),'pages'=>_t ('喵咪の两身（文章内显示翻页按钮）'),'bottom-bar'=>_t ('喵咪の尾巴（博客页脚版权信息）'),'fireworks'=>_t ('喵咪の花花（开启评论框打字特效）')),array ('smoothscroll','pages','bottom-bar','fireworks'),_t ('其它工具与设置'));
    $form->addInput ($OtherTool->multiMode ());
}
function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text=preg_replace("/[^\x{4e00}-\x{9fa5}]/u","",$rs['text']);
    echo mb_strlen($text,'UTF-8');
}
function  img_postthumb ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i",$rs['text'],$thumbUrl);
    $img_src=$thumbUrl[1][0];
    $img_counter=count($thumbUrl[0]);
    if ($img_counter>0){
        echo $img_src;
    }else {
        echo "";
    }
}
function  get_post_view ($archive){
    $cid=$archive->cid ;
    $db=Typecho_Db::get ();
    $prefix=$db->getPrefix ();
    if (!array_key_exists('viewsNum',$db->fetchRow ($db->select ()->from ('table.contents')))){
        $db->query ('ALTER TABLE `'.$prefix.'contents` ADD `viewsNum` INT(10) DEFAULT 0;');
        echo 0;
        return ;
    }
    $row=$db->fetchRow ($db->select ('viewsNum')->from ('table.contents')->where ('cid = ?',$cid));
    if ($archive->is ('single')){
        $views=Typecho_Cookie::get ('extend_contents_viewsNum');
        if (empty($views)){
            $views=array ();
        }else {
            $views=explode(',',$views);
        }
        if (!in_array($cid,$views)){
            $db->query ($db->update ('table.contents')->rows (array ('viewsNum'=>(int )$row['viewsNum']+1))->where ('cid = ?',$cid));
            array_push($views,$cid);
            $views=implode(',',$views);
            Typecho_Cookie::set ('extend_contents_viewsNum',$views);
            //记录查看cookie
        }
    }
    echo $row['viewsNum'];
}
function  girlname (){
    $uid=Typecho_Widget::widget ('Widget_Options')->girlid ;
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.users.screenName')->from ('table.users')->where ('table.users.uid=?',$uid)->order ('table.users.uid',Typecho_Db::SORT_ASC)->limit (1));
    echo $rs['screenName'];
}
function getCommentAt($coid){
    $db=Typecho_Db::get();
    $prow=$db->fetchRow($db->select('parent')
        ->from('table.comments')
        ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent=$prow['parent'];
    if ($parent != "0") {
        $arow=$db->fetchRow($db->select('author')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author=$arow['author'];
        $href='<a class="at" href="#comment-'.$parent.'">@'.$author.'：</a> ';
        echo $href;
    } else {
        echo '';
    }
}
?>