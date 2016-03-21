<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 14.03.2016
 * Time: 11:58
 */
require_once('http.php');
// /classes/linkobject.php

function fixUrl($val){
    return urlencode($val);
}
class linkobject extends http{
    var $baseUrl = false;
    var $delim = '&aml;';
    var $eq = '=';
    var $protocol = 'http://';


    function __construct(){
        parent::__construct();
        $this->baseUrl = $this->protocol.HTTP_HOST.SCRIPT_NAME;

    }


    function addToLink (&$link, $name, $val){

        if($link != '') {
            $link = $link.$this->delim;
        }
        $link = $link.fixUrl($name).$this->eq.fixUrl($val);
        #echo 'addToLink:'.$link.'<br />';
    }//addToLink

    function getLink($add = array()){
        $link = '';

        foreach($add as $name=>$val){
            $this->addToLink($link, $name, $val);
        }
        #echo 'getLink: '.$link.'<br />';
        if ($link != ''){
            $link = $this->baseUrl.'?'.$link;
        }
        else{
            $link = $this->baseUrl;
        }
        #echo 'lopp getLink: '.$link.'<br />';
        return $link;
    }//getLink
}// linkobject
$http = new linkobject();
$http->getLink(array('eesnimi'=>'Siim-Kaarel', 'perenimi'=>'Kabel'));
?>