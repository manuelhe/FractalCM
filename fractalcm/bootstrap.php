<?php
$t = microtime(true);

require_once 'config/LangConf.php';
require_once 'config/DbConf.php';
require_once 'library/init.php';

//$dbconfig = dbConfig::init();
//echo $dbconfig::$_TSUFIX;
$id = 16;
echo "<h1>Bootstrap Test for ID: {$id}</h1>";
$contentMap = ContentMap::init($id);

echo "<h2>Path</h2>";
var_dump($contentMap::path());
echo "<h2>Property: ".DbConf::$_CONT_THEAD."</h2>";
var_dump($contentMap::property(null,DbConf::$_CONT_THEAD));
echo "<h2>Data</h2>";
var_dump($contentMap::data());

$t = printf('%01.5f',microtime(true) - $t);