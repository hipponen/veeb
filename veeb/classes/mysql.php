<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 21.03.2016
 * Time: 10:26
 */

// /classes/mysql.php

class mysql{
    var $conn = false;
    var $host = false;
    var $user = false;
    var $pass = false;
    var $dbname = false;
    var $history = array ();

    function __construct($h, $u, $p, $n){
        $this->host = $h;
        $this->user = $u;
        $this->pass = $p;
        $this->dbname = $n;
        $this->connect();
    } // konstruktor

    function connect() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if (mysqli_connect_error()){
            echo 'Viga andmebaasiga ühendamisel<br />';
            exit;
        }
    } // connect funktsioon

    function selectDb(){
        $res = mysqli_select_db($this->conn, $this->dbname);
        if ($res===false){
            echo 'Ei saanud andmebaasi kätte<br />';
            exit;
        }
    }// vali andmebaas

    function getMicrotime () {
        list ($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    } //getMicroTime

    function query($sql) {
        $begin = $this->getMicrotime();
        $res = mysqli_query($this->conn, $sql);
        if ($res == false) {
            echo 'Viga päringus!<br />'.$sql.'<br />';
            echo mysqli_error($this->conn).'<br />';
        }
        $time = $this->getMicrotime() - $begin;
        $this->history[] = array(
            'sql'=> $sql,
            'time'=> $time
        );
        return $res;
    } //päring

    function getArray ($sql) {
        $res = $this->query($sql);
        $data = array();
        while($record = mysqli_fetch_assoc($res)) {
            $data[] = $record;
        }
        if(count($data)== 0) {
            return false;
        }
        return $data;
    } //getArray

    function showHistory () {
        if (count($this->history) > 0) {
            echo '<hr />';
            foreach($this->history as $key => $val) {
                echo '<li>'.$val['sql'].'<br /><strong>';
                echo round($val['time'],6).'</strong>';
            }
        }
    }

} // mysql klassi lõpp

// $db = new mysql('localhost', 'timohipponen', 'ootoad3v', 'timohipponen_lennud');
// $db->query('SHOW TABLES');
// $db->getArray('SELECT * FROM klient');
// $db->showHistory();

// echo '<pre>';
// print_r($db->query('SHOW TABLES'));
// print_r($db->getArray('SELECT * FROM klient'));
// echo '</pre>';

?>
