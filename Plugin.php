<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 自定义鼠标光标样式
 * 
 * @package CustomCursor
 * @author Mr_Fang
 * @version beta 0.1
 * @link https://fang.blog.miri.site
 */
class CustomCursor_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header'); 
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /** 分类名称 */
        
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->normal))){
            $normal_img = Helper::options()->pluginUrl . '/CustomCursor/cursors/normal.cur';
        }else{
            $normal_img = htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->normal);
        }
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->text))){
            $text_img = Helper::options()->pluginUrl . '/CustomCursor/cursors/texto.cur';
        }else{
            $text_img = htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->text);
        }
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link))){
            $link_img = Helper::options()->pluginUrl . '/CustomCursor/cursors/ayuda.cur';
        }else{
            $link_img = htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link);
        }
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link_active))){
            $link_active_img = Helper::options()->pluginUrl . '/CustomCursor/cursors/work.cur';
        }else{
            $link_active_img = htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link_active);
        }
        
        $normal = new Typecho_Widget_Helper_Form_Element_Text('normal', NULL, Helper::options()->pluginUrl . '/CustomCursor/cursors/normal.cur', _t('正常选择'), _t('默认显示的光标 <img style="float:right;" src="' . $normal_img . '">'));
            $form->addInput($normal);
        $text = new Typecho_Widget_Helper_Form_Element_Text('text', NULL, Helper::options()->pluginUrl . '/CustomCursor/cursors/texto.cur', _t('文本选择'), _t('鼠标悬停在<code>&lt;p&gt; &lt;textarea&gt; &lt;input&gt;</code>标签时显示的光标 <img style="float:right;" src="' . $text_img . '">'));
            $form->addInput($text);
        $link = new Typecho_Widget_Helper_Form_Element_Text('link', NULL, Helper::options()->pluginUrl . '/CustomCursor/cursors/ayuda.cur', _t('链接选择'), _t('鼠标悬停在<code>&lt;a&gt;</code>标签时显示的光标 <img style="float:right;" src="' . $link_img . '">'));
            $form->addInput($link);
        $link_active = new Typecho_Widget_Helper_Form_Element_Text('link_active', NULL, Helper::options()->pluginUrl . '/CustomCursor/cursors/work.cur', _t('链接按下时'), _t('鼠标按下<code>&lt;a&gt;</code>标签时显示的光标 <img style="float:right;" src="' . $link_active_img . '">'));
            $form->addInput($link_active);
        $custom = new Typecho_Widget_Helper_Form_Element_Textarea('custom', NULL, '', _t('自定义CSS'), _t('如果想设置其他标签的光标样式，可在此自定义css'));
            $form->addInput($custom);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    
    // 为header添加css文件
    public static function header() {
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->normal))){
            $style1 = '* {cursor: url(' . Helper::options()->pluginUrl . '/CustomCursor/cursors/normal.cur), auto;}';
        }else{
            $style1 = '* {cursor: url(' . htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->normal) . '), auto;}';
        }
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->text))){
            $style2 = 'p,textarea,input {cursor: url(' . Helper::options()->pluginUrl . '/CustomCursor/cursors/texto.cur), auto;}';
        }else{
            $style2 = 'p,textarea,input {cursor: url(' . htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->text) . '), auto;}';
        }
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link))){
            $style3 = 'a {cursor: url(' . Helper::options()->pluginUrl . '/CustomCursor/cursors/ayuda.cur), auto;}';
        }else{
            $style3 = 'a {cursor: url(' . htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link) . '), auto;}';
        }
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link_active))){
            $style4 = 'a:active {cursor: url(' . Helper::options()->pluginUrl . '/CustomCursor/cursors/work.cur), auto;}';
        }else{
            $style4 = 'a:active {cursor: url(' . htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->link_active) . '), auto;}';
        }
        if(empty(htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->custom))){
            $style5 = "// 未设置custom";
        }else{
            $style5 = htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('CustomCursor')->custom);
        }
        echo <<<HTML
<style>
    $style1
    $style2
    $style3
    $style4
    $style5
</style>
HTML;
    }
}
