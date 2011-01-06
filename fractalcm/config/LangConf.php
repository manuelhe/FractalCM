<?php
class LangConf {
    private static $avaliable_langs	= array(
    	'es'=>array('system'=>'spanish','locale'=>'es_ES')
    	,'en'=>array('system'=>'english','locale'=>'en_EN')
    );
    static $_DEFAULT_LANGUAGE        = '';
    static $_SYSTEM_LANGUAGE         = '';
    static $_SYSTEM_LOCALE           = '';
    static $_IMAGE_ADMIN_LANGUAGE    = '';
	/**
	 *
	 * init control system
     * @todo Change method to get lang from $_GET
	 */
	static function init(){
	    $kalng	= array_keys(self::$avaliable_langs);
        $kalng	= $kalng[0];
        self::$_DEFAULT_LANGUAGE = $kalng;
        if(isset($_GET['lng']) && isset(self::$avaliable_langs[$_GET['lng']])){
        	$kalng	= $_GET['lng'];
        }else if(isset($_COOKIE['fwalang']) && isset(self::$avaliable_langs[$_COOKIE['fwalang']])){
        	$kalng	= $_COOKIE['fwalang'];
        }

        setcookie('fwalang',$kalng);
        $_COOKIE['fwalang']	= $kalng;

        setlocale(LC_TIME,self::$avaliable_langs[$kalng]['locale']);
        self::$_SYSTEM_LANGUAGE        = self::$avaliable_langs[$kalng]['system'];
        self::$_SYSTEM_LOCALE	       = self::$avaliable_langs[$kalng]['locale'];
        self::$_IMAGE_ADMIN_LANGUAGE    = self::$_SYSTEM_LANGUAGE;
	}
}
LangConf::init();