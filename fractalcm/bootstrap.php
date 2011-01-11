<?php
$t = microtime(true);

require_once 'config/LangConf.php';
require_once 'config/DbConf.php';
require_once 'library/init.php';

//$dbconfig = dbConfig::init();
//echo $dbconfig::$_TSUFIX;
$id = 16;
echo "<h1>Bootstrap Test for ID: {$id}</h1>";
$contentMap = NodeMap::init($id);

echo "<h2>Path</h2>";
var_dump($contentMap::path());
echo "<h2>Property: ".DbConf::$_NODE_THEAD."</h2>";
var_dump($contentMap::property(null,DbConf::$_NODE_THEAD));
echo "<h2>Data</h2>";
var_dump($contentMap::data());
echo "<h2>Children</h2>";
var_dump($contentMap::children(null,false,true));
echo "<h2>Siblings</h2>";
var_dump($contentMap::siblings(null,false,true,true));

$t = printf('%01.5f',microtime(true) - $t);