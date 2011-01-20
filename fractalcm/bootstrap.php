<?php
$t = microtime(true);

header("Content-Type: text/html; charset=UTF-8");
require_once 'library/init.php';
require_once 'config/LangConf.php';
require_once 'config/DbConf.php';
require_once 'config/NodeParams.php';

//$dbconfig = dbConfig::init();
//echo $dbconfig::$_TSUFIX;
$id = 3;
echo "<h1>Bootstrap Test for ID: {$id}</h1>";
$contentMap = NodeMap::init($id);

/*****
var_dump($_SERVER['HTTP_ACCEPT_LANGUAGE']);
$locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
var_dump($locale);
var_dump(Locale::getDisplayLanguage($locale));
var_dump(Locale::getDisplayName($locale));
var_dump(Locale::getDisplayRegion($locale));
var_dump(Locale::getKeywords($locale));
$locale = Locale::parseLocale($locale);
var_dump($locale);
$coll = collator_create($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
$err_code = intl_get_error_code();
var_dump($coll);
printf("ICU error code %d: %s.\n", $err_code, intl_error_name($err_code));


/*****
var_dump(dirname(Path::this_url()));
var_dump(Path::request_uri());
/*****/


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
echo "<h2>Siblings (ver 2)</h2>";
var_dump($contentMap::siblings(null,false,true));

$t = printf('%01.5f',microtime(true) - $t);