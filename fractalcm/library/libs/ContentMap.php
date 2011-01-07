<?php
class ContentMap {
    private static $contentId        = 1;
    private static $flatMap          = array();
    private static $relMap           = array();
    private static $contentParams    = array();
    private static $db               = null;
    /**
     *
     * General instance method
     * @return object ContentMap instance
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
     * @return object ContentMap instance
     */
    static function init($contentId=1){
        $contentId       = intval($contentId,10);
        self::$contentId = $contentId ? $contentId : self::$contentId;
        self::$db        = Database::open(array('type'=>'mysql','database'=>'fractalcms_db1', 'user'=>'root', 'password'=>'zemoga'));
        self::buildMap();
        return self::getInstance();
    }
    private static function buildMap() {
        self::mapFromDb();
    }
    private static function mapFromDb(){
        $q1 = sprintf("SELECT `%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s` FROM `%s` ORDER BY `%s`, `%s`"
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
        $r1 = self::$db->fetch($q1);
        if (!self::$db->numberRows()) {
            trigger_error('<strong>ContentMap</strong> :: ERROR001: No data in Content table', E_USER_ERROR);
            return false;
        }
        $level = 1;
        foreach ($r1 as $d1) {
            if($d1[DbConf::$_CONT_PARENTID]>0){
                $level = self::$flatMap[$d1[DbConf::$_CONT_PARENTID]][DbConf::$_CONT_LEVELID]+1;
            }
            self::$relMap[$level][$d1[DbConf::$_CONT_PARENTID]][$d1[DbConf::$_CONT_ID]]= array(
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
                DbConf::$_CONT_LEVELID  => $level
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
        }
        if(!isset(self::$flatMap[self::$contentId])){
            //@todo Design and implement error handling for this
            //header("Location: "._URL_PREFIX._ID_ERROR."?ref=".self::$contentId."&msg=IDNOVAL");
            //exit();
            trigger_error('<strong>ContentMap</strong> :: NOTICE001: No Content from Submited ID', E_USER_NOTICE);
        }
        //self::$contentParams = self::params();
        return true;
    }
    /**
     *
     * Returns non inherited Content paramameters
     * @param int $contentId Optional. Content ID
     * @return array
     */
    public static function params($contentId=FALSE) {
        $contentId = intval($contentId,10);
        $contentId = $contentId ? $contentId : self::$contentId;
        global $configVars;

        $q1	= "SELECT ".DbConf::$_CONT_PARAMS." FROM ".DbConf::$_TCONTENT." WHERE ".DbConf::$_CONT_ID."=?";
        $r1 = self::$db->fetchCell($q1,array($contentId));
        if (!self::$db->numberRows()) {
            //trigger_error('<strong>ContentMap</strong> :: ERROR003: No Params in selected content', E_USER_ERROR);
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
    /**
     *
     * Returns path to root of a submited ID
     * @param int $contentId Optional. Content ID
     * @param bool $stringMode Optional. Default value: FALSE. Return path as a concatenated string of IDs
     * @return array
     */
	public static function path($contentId=false,$stringMode=false){
	    $contentId   = intval($contentId,10);
        $contentId   = $contentId ? $contentId : self::$contentId;
        if(!isset(self::$flatMap[$contentId])){
            trigger_error('<strong>ContentMap</strong> :: NOTICE002: No Content from Submited ID', E_USER_NOTICE);
        }
		$level       = self::$flatMap[$contentId][DbConf::$_CONT_LEVELID];
		$path        = array();
		for($i=$level;$i>0;$i--){
			if($stringMode){
				$path[] = $contentId;
			}else{
				$path[] = array(
				    DbConf::$_CONT_ID        => $contentId,
				    DbConf::$_CONT_LEVELID   => $i,
				    DbConf::$_CONT_TITLE     => self::$flatMap[$contentId][DbConf::$_CONT_TITLE]
				);
			}
			$contentId		= self::$flatMap[$contentId][DbConf::$_CONT_PARENTID];
		}
		if(is_array($path)){
		    $path	= array_reverse($path);
		}
		$path	= ($stringMode) ? implode(",",$path) : $path;
		return $path;
	}
	/**
	 *
	 * Finds a recursive value for a specific field for a specific content
	 * @param int $contentId Required. Base Content ID
	 * @param string $field Required. Field name to find its recursive value
	 * @param bool $returnValue Optional. Default value: TRUE. Return only the value or an array with the content inheritance
	 * @param mixed $inheritedValue Optional. This parameter is only used as a referent in the recursive search
	 * @return mixed
	 */
	public static function property($contentId=false,$field=null,$returnValue=true,$inheritedValue=false){
	    $contentId   = intval($contentId,10);
        $contentId   = $contentId ? $contentId : self::$contentId;

		if(!(isset(self::$flatMap[$contentId]) && isset(self::$flatMap[$contentId][$field]))){
			return false;
		}
		if(self::$flatMap[$contentId][$field]!=$inheritedValue || $contentId==1){
			if($returnValue){
				return self::$flatMap[$contentId][$field];
			}
			return self::$flatMap[$contentId];
		}
		return self::property(self::$flatMap[$contentId][DbConf::$_CONT_PARENTID],$field,$returnValue,$inheritedValue);
	}
	/**
	 *
	 * Retruns all Content data
	 * @param mixed $contentId If an array value is submited, it returns and array with all founded content data
	 * @param bool $breakLines Returns break lines as HTML BRs
	 * @return array
	 */
	public static function data($contentId=false,$breakLines=false){
	    $group = false;
	    if(is_array($contentId) && count($contentId)){
	        while (list($k,$v) = each($contentId)){
	            $v = intval($v,10);
	            if($v){
	                continue;
	            }
                unset($contentId[$k]);
	        }
	        if(!count($contentId)){
	            return false;
	        }
	        $group = true;
	    }else{
    	    $contentId   = intval($contentId,10);
            $contentId   = $contentId ? $contentId : self::$contentId;
	    }

		$q1	= sprintf("SELECT * FROM `%s` WHERE `%s` %s %s"
			,DbConf::$_TCONTENT
			,DbConf::$_CONT_ID
			,$group ? 'IN' : '='
		    ,$group ? '('.implode(',', $contentId).')' : "'".$contentId."'"
		);
		$r1	= self::$db->fetch($q1,array($contentId));
		if(!self::$db->numberRows()){
			return false;
		}
		$ret = array();
		if($group){
		    foreach ($r1 as $d1) {
        		//$d1 = procesarContenido($d1,$bl);
		        $ret[] = $d1;
		    }
		}else{
		    $ret = $r1[0];
		}
		return $ret;
	}
	public static function children($contentId=null,$visible=true,$completeData=false){
	    $contentId   = intval($contentId,10);
        $contentId   = $contentId ? $contentId : self::$contentId;

		if(!isset( self::$flatMap[$contentId] )){
			return false;
		}
		$level	= self::$flatMap[$contentId][DbConf::$_CONT_LEVELID] + 1;
		$params	= self::$contentId == $contentId ? self::$contentParams : self::params($contentId);

		if(!isset(self::$relMap[$level][$contentId])){
			return false;
		}

		$nav = array();
		$idList = array();
		while (list($k1,$v1) = each(self::$relMap[$level][$contentId])) {
			if (!$v1[DbConf::$_CONT_VISIBLE] && $visible) {
			    continue;
			}
		    $idList[] = $k1;
			$nav[]	= array(
				DbConf::$_CONT_ID      => $k1,
				DbConf::$_CONT_TITLE   => $v1[DbConf::$_CONT_TITLE],
				DbConf::$_CONT_DATE    => $v1[DbConf::$_CONT_DATE],
				DbConf::$_CONT_ORDER   => $v1[DbConf::$_CONT_ORDER],
			);
		}
		reset(self::$relMap[$level][$contentId]);
		if($completeData){
		    $nav = self::data($idList);
		}
		//$nav	= array_asoc_sort($nav,$params['orderBy'],$params['orderDir']);
		return $nav;
	}
}

