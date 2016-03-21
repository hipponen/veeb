<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 21.03.2016
 * Time: 12:29
 */

if (!defined('BASE_DIR')){
    exit;
}

$menu = new template('menu.menu');
$m_item= new template('menu.item');

$m_item->set('name','kontakt');
$link = $http->getLink(array('act'=>'contact'));
$m_item->set('link', $link);
$menu->add('items',$m_item->parse());
?>