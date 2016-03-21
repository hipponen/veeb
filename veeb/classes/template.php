<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 7.03.2016
 * Time: 13:44
 */

if(!defined('TMPL_DIR'))
{
    define('TMPL_DIR', '../tmpl/');
}
class template
{
    // klassi omadused
    var $file = ''; // template fail
    var $content = false; // template failist loetud sisu
    var $vars = array(); // väärtused, millega sisu täidetakse

    function __construct($f)
    {
        $this->file =$f; //template parameetriks on laaditava faili nimi
        $this->loadFile();
    }    // konstructor

    function LoadFile()
    {
        $f = $this->file;

        //kas template kataloog on olemas
        if(!is_dir(TMPL_DIR))
        {
            echo 'Kataloogi ' .TMPL_DIR.' ei ole leitud<br />';
            exit;
        }
        // kas fail on vastavate õigustega
        if(file_exists($f) and is_file($f) and is_readable($f))
        {
            // loeme faili sisu $this->content sisse
            $this->readFile($f);
        }
        // kui faili nimi on antud koos .html ja ilma kataloogi nimeta
        $f = TMPL_DIR.$this->file;
        if(file_exists($f) and is_file($f) and is_readable($f))
        {
            // loeme faili sisu $this->content sisse
            $this->readFile($f);
        }

        // lubame lisada ainult template nimi, ilma laienduseta
        $f = TMPL_DIR.$this->file.'html';

        if(file_exists($f) and is_file($f) and is_readable($f))
        {
            // loeme faili sisu $this->content sisse
            $this->readFile($f);
        }

        $f = TMPL_DIR.str_replace('.','/', $this->file).'.html';
        if(file_exists($f) and is_file($f) and is_readable($f))
        {
            // loeme faili sisu $this->content sisse
            $this->readFile($f);
        }
        if ($this->content === false)
        {
            echo 'Ei suutnud lugeda faili '.$this->file.'<br />';
            exit;
        }

    }

    function readFile($f)
    {
        /*
        $fp = fopen($f, 'rb');
        $this->content = fread($fp, filesize($f));
        fclose($fp);
        */

        $this->content = file_get_contents($f);
    } //readfile() funktsiooni lõpp

    //template sisu määramine
    // tekitame paar: template_element = väärtused
    function set($name, $val)
    {
        $this->vars[$name] = $val;
    }//set funktsiooni lõpp

    function add($name, $val)
    {
        // juhul kui sellise nimega elemendid veel ei ole lisatud
        if(!isset($this->vars[$name]))
        {
            $this->set($name, $val);

        }
        // kui aga sellise niega element on juba olemas
        // lihtsalt lisame juurde veel sama nimega elemendile lisaväärtused
        else
        {
            $this->vars[$name] = $this->vars[$name].$val;
        }
    }
    function parse()
    {
        $str = $this->content;
        foreach($this->vars as $name=>$val)
        {
            $str = str_replace('{'.$name.'}',$val, $str);
            //echo $str.'<br />';
        }
        return $str;
    }//parse funktsiooni lõpp
}//template klassi lõpp

$tmpl = new template('test');
$tmpl->set('pealkiri', 'test');
$tmpl->set('yks', 'esimene');
$tmpl->set('kaks', 'teine');
// echo '<pre>';
//print_r($tmpl);
// echo '</pre>';

?>