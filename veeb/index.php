<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 7.03.2016
 * Time: 15:04
 */
error_reporting(E_ALL);

//vajalikud konstandid
define('BASE_DIR', './');

define('SITENAME', 'Veebiprogrammeerimine');

define('CLASSES_DIR', BASE_DIR.'classes/');
define('TMPL_DIR', BASE_DIR.'tmpl/');

//võtame vajalikud failid kaasa
require_once(CLASSES_DIR.'template.php');
require_once(CLASSES_DIR.'http.php');
require_once(CLASSES_DIR.'linkobject.php');
require_once (CLASSES_DIR.'mysql.php');
require_once ('../dbconf.php');

$http = new linkobject();
$db = new mysql(DBHOST, DBUSER, DBPASS, DBNAME);



//loome pealehe template
$tmpl = new template('main');

require_once('menu.php');

$tmpl->set('menuu', $menu->parse());
$tmpl->set('nav_bar', strftime(' %A, %d.%B.%Y %H:%M'));
$tmpl->set('lang_bar', 'Siia tuleb keelevahetus (kunagi)');
$tmpl->set('body', 'Lehe sisu');
$tmpl->add('body', '<br /> ja midagi veel');

// väljastamise täidetud template
echo $tmpl->parse();

$db->showHistory();
?>