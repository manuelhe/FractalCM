<?php
class ContentMap {
    private $contentId        = 1;
    private $flatMap          = array();
    private $relMap           = array();
    private $contentParams    = array();
    /**
     *
     * General instance method
     */
    private static function &getInstance(){
        static $instance;
        if(!isset($instance)){
            $c=__CLASS__;
            $instance=new $c;
        }
        return $instance;
    }
    /**
     *
     * init control system
     * @param int $contentId Required. Default value: 1. Content ID
     */
    static function init($contentId=1){
        $contentId = intval($contentId,10);
        self::$contentId = $contentId ? $contentId : self::$contentId;
    }
    private static function buildMap() {
        self::mapFromDb();
    }
    private static function mapFromDb(){
        $db = Database::open(array('type'=>'mysql','database'=>'fractalcms_db1', 'user'=>'root', 'password'=>'zemoga'));
        $q1 = sprintf("SELECT %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s FROM %s ORDER BY %s, %s"
            ,DbConf::$_CONT_ID
            ,DbConf::$_CONT_PARENTID
            ,DbConf::$_CONT_MAP
            ,DbConf::$_CONT_VISIBLE
            ,DbConf::$_CONT_TITLE
            ,DbConf::$_TEMPL_ID
            ,DbConf::$_CONT_TLAYOUT
            ,DbConf::$_CONT_THEAD
            ,DbConf::$_CONT_TMENU1
            ,DbConf::$_CONT_TMENU2
            ,DbConf::$_CONT_TMAIN
            ,DbConf::$_CONT_TSECOND
            ,DbConf::$_CONT_TFOOT
            ,DbConf::$_CONT_DATE
            ,DbConf::$_CONT_ORDER
            ,DbConf::$_TCONTENT
            ,DbConf::$_CONT_PARENTID
            ,DbConf::$_CONT_ID
        );
        $r1 = $db->fetch($q1);
        if (!$db->numberRows()) {
            trigger_error('<strong>ContentMap</strong> :: ERROR001: No data in Content table', E_ERROR);
            return false;
        }
        while($d1 = $this->dbcon->fetch_array($r1)){
            if($d1[DbConf::$_CONT_PARENTID]==0){
                $level = 1;
            }else{
                $level = self::$flatMap[$d1[DbConf::$_CONT_PARENTID]][DbConf::$_CONT_LEVELID]+1;
            }
            self::$relMap[$nivel][$d1[DbConf::$_CONT_PARENTID]][$d1[DbConf::$_CONT_ID]]= array(
                DbConf::$_CONT_TITLE    => $d1[DbConf::$_CONT_TITLE]
                ,DbConf::$_CONT_VISIBLE => $d1[DbConf::$_CONT_VISIBLE]
                ,DbConf::$_CONT_MAP     => $d1[DbConf::$_CONT_MAP]
                ,DbConf::$_TEMPL_ID     => $d1[DbConf::$_TEMPL_ID]
                ,DbConf::$_CONT_TLAYOUT => $d1[DbConf::$_CONT_TLAYOUT]
                ,DbConf::$_CONT_THEAD   => $d1[DbConf::$_CONT_THEAD]
                ,DbConf::$_CONT_TMENU1  => $d1[DbConf::$_CONT_TMENU1]
                ,DbConf::$_CONT_TMENU2  => $d1[DbConf::$_CONT_TMENU2]
                ,DbConf::$_CONT_TMAIN   => $d1[DbConf::$_CONT_TMAIN]
                ,DbConf::$_CONT_TSECOND => $d1[DbConf::$_CONT_TSECOND]
                ,DbConf::$_CONT_TFOOT   => $d1[DbConf::$_CONT_TFOOT]
                ,DbConf::$_CONT_DATE    => $d1[DbConf::$_CONT_DATE]
                ,DbConf::$_CONT_ORDER   => $d1[DbConf::$_CONT_ORDER]
            );
            self::$flatMap[$d1[DbConf::$_CONT_ID]]= array(
                DbConf::$_CONT_LEVELID  => $nivel
                ,DbConf::$_CONT_PARENTID=> $d1[DbConf::$_CONT_PARENTID]
                ,DbConf::$_CONT_TITLE   => $d1[DbConf::$_CONT_TITLE]
                ,DbConf::$_CONT_VISIBLE => $d1[DbConf::$_CONT_VISIBLE]
                ,DbConf::$_CONT_MAP     => $d1[DbConf::$_CONT_MAP]
                ,DbConf::$_TEMPL_ID     => $d1[DbConf::$_TEMPL_ID]
                ,DbConf::$_CONT_TLAYOUT => $d1[DbConf::$_CONT_TLAYOUT]
                ,DbConf::$_CONT_THEAD   => $d1[DbConf::$_CONT_THEAD]
                ,DbConf::$_CONT_TMENU1  => $d1[DbConf::$_CONT_TMENU1]
                ,DbConf::$_CONT_TMENU2  => $d1[DbConf::$_CONT_TMENU2]
                ,DbConf::$_CONT_TMAIN   => $d1[DbConf::$_CONT_TMAIN]
                ,DbConf::$_CONT_TSECOND => $d1[DbConf::$_CONT_TSECOND]
                ,DbConf::$_CONT_TFOOT   => $d1[DbConf::$_CONT_TFOOT]
                ,DbConf::$_CONT_DATE    => $d1[DbConf::$_CONT_DATE]
                ,DbConf::$_CONT_ORDER   => $d1[DbConf::$_CONT_ORDER]
            );
            if(isset(self::$flatMap[self::$contentId])){
                //@todo Design and implement error handling for this
                header("Location: "._URL_PREFIX._ID_ERROR."?ref=".self::$contentId."&msg=IDNOVAL");
                exit();
            }
            self::$contentParams = self::getParams();
            return true;
        }
    }
    public static function getParams($contentId) {
        $contentId = intval($contentId,10);
        $contentId = $contentId ? $contentId : self::$contentId;
        global $configVars;
        $db = Database::open(array('type'=>'mysql','database'=>'fractalcms_db1', 'user'=>'root', 'password'=>'zemoga'));
        $q1	= "SELECT ".DbConf::$_CONT_PARAMS." FROM ".DbConf::$_TCONTENT." WHERE ".DbConf::$_CONT_ID."=?";
        $r1 = $db->fetchCall($q1,array($contentId));
        if (!$db->numberRows()) {
            //trigger_error('<strong>ContentMap</strong> :: ERROR002: No Params in selected content', E_ERROR);
            return false;
        }
        $params	= unserialize($r1);
        $ret	= array();
        while(list(,$v)=each($configVars)){
            $dVal	= isset($v['values']) && isset($v['values'][0]) && isset($v['values'][0]['val']) ? $v['values'][0]['val'] : $v['values'];
            $ret[$v['param']]	= isset($params[$v['param']]) ? $params[$v['param']] : $dVal;
        }
        reset($configVars);
        return $ret;
    }

}