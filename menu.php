<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 21.03.2016
 * Time: 12:28
 */

if (!defined('BASE_DIR')){
    exit;
}

$menu = new template('menu.menu');
$menu_item= new template('menu.item');

$item->set('name','kontakt');
$link = $http->getLink(array('act'=>'contact'));
$item->set('link', $link);
$menu->add('items',$item->parse());
?>