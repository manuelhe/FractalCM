<?php
class NodeMap {
    private static $nodeId        = 1;
    private static $flatMap          = array();
    private static $relMap           = array();
    private static $contentParams    = array();
    private static $db               = null;
    /**
     *
     * General instance method
     * @return object NodeMap instance
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
     * @param int $nodeId Required. Default value: 1. Node ID
     * @return object NodeMap instance
     */
    static function init($nodeId=1){
        $nodeId       = intval($nodeId,10);
        self::$nodeId = $nodeId ? $nodeId : self::$nodeId;
        self::$db        = Database::open(array('type'=>'mysql','database'=>'fractalcms_db1', 'user'=>'root', 'password'=>'zemoga'));
        self::buildMap();
        return self::getInstance();
    }
    private static function buildMap() {
        self::mapFromDb();
    }
    private static function mapFromDb(){
        $q1 = sprintf("SELECT `%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s`,`%s` FROM `%s` ORDER BY `%s`, `%s`"
            ,DbConf::$_NODE_ID
            ,DbConf::$_NODE_PARENTID
            ,DbConf::$_NODE_MAP
            ,DbConf::$_NODE_VISIBLE
            ,DbConf::$_NODE_TITLE
            ,DbConf::$_TEMPL_ID
            ,DbConf::$_NODE_TLAYOUT
            ,DbConf::$_NODE_THEAD
            ,DbConf::$_NODE_TMENU1
            ,DbConf::$_NODE_TMENU2
            ,DbConf::$_NODE_TMAIN
            ,DbConf::$_NODE_TSECOND
            ,DbConf::$_NODE_TFOOT
            ,DbConf::$_NODE_DATE
            ,DbConf::$_NODE_ORDER
            ,DbConf::$_TNODE
            ,DbConf::$_NODE_PARENTID
            ,DbConf::$_NODE_ID
        );
        $r1 = self::$db->fetch($q1);
        if (!self::$db->numberRows()) {
            trigger_error('<strong>NodeMap</strong> :: ERROR001: No data in Content table', E_USER_ERROR);
            return false;
        }
        $level = 1;
        foreach ($r1 as $d1) {
            if($d1[DbConf::$_NODE_PARENTID]>0){
                $level = self::$flatMap[$d1[DbConf::$_NODE_PARENTID]][DbConf::$_NODE_LEVELID]+1;
            }
            self::$relMap[$level][$d1[DbConf::$_NODE_PARENTID]][$d1[DbConf::$_NODE_ID]]= array(
                DbConf::$_NODE_TITLE    => $d1[DbConf::$_NODE_TITLE]
                ,DbConf::$_NODE_VISIBLE => $d1[DbConf::$_NODE_VISIBLE]
                ,DbConf::$_NODE_MAP     => $d1[DbConf::$_NODE_MAP]
                ,DbConf::$_TEMPL_ID     => $d1[DbConf::$_TEMPL_ID]
                ,DbConf::$_NODE_TLAYOUT => $d1[DbConf::$_NODE_TLAYOUT]
                ,DbConf::$_NODE_THEAD   => $d1[DbConf::$_NODE_THEAD]
                ,DbConf::$_NODE_TMENU1  => $d1[DbConf::$_NODE_TMENU1]
                ,DbConf::$_NODE_TMENU2  => $d1[DbConf::$_NODE_TMENU2]
                ,DbConf::$_NODE_TMAIN   => $d1[DbConf::$_NODE_TMAIN]
                ,DbConf::$_NODE_TSECOND => $d1[DbConf::$_NODE_TSECOND]
                ,DbConf::$_NODE_TFOOT   => $d1[DbConf::$_NODE_TFOOT]
                ,DbConf::$_NODE_DATE    => $d1[DbConf::$_NODE_DATE]
                ,DbConf::$_NODE_ORDER   => $d1[DbConf::$_NODE_ORDER]
            );
            self::$flatMap[$d1[DbConf::$_NODE_ID]]= array(
                DbConf::$_NODE_LEVELID  => $level
                ,DbConf::$_NODE_PARENTID=> $d1[DbConf::$_NODE_PARENTID]
                ,DbConf::$_NODE_TITLE   => $d1[DbConf::$_NODE_TITLE]
                ,DbConf::$_NODE_VISIBLE => $d1[DbConf::$_NODE_VISIBLE]
                ,DbConf::$_NODE_MAP     => $d1[DbConf::$_NODE_MAP]
                ,DbConf::$_TEMPL_ID     => $d1[DbConf::$_TEMPL_ID]
                ,DbConf::$_NODE_TLAYOUT => $d1[DbConf::$_NODE_TLAYOUT]
                ,DbConf::$_NODE_THEAD   => $d1[DbConf::$_NODE_THEAD]
                ,DbConf::$_NODE_TMENU1  => $d1[DbConf::$_NODE_TMENU1]
                ,DbConf::$_NODE_TMENU2  => $d1[DbConf::$_NODE_TMENU2]
                ,DbConf::$_NODE_TMAIN   => $d1[DbConf::$_NODE_TMAIN]
                ,DbConf::$_NODE_TSECOND => $d1[DbConf::$_NODE_TSECOND]
                ,DbConf::$_NODE_TFOOT   => $d1[DbConf::$_NODE_TFOOT]
                ,DbConf::$_NODE_DATE    => $d1[DbConf::$_NODE_DATE]
                ,DbConf::$_NODE_ORDER   => $d1[DbConf::$_NODE_ORDER]
            );
        }
        if(!isset(self::$flatMap[self::$nodeId])){
            //@todo Design and implement error handling for this
            //header("Location: "._URL_PREFIX._ID_ERROR."?ref=".self::$nodeId."&msg=IDNOVAL");
            //exit();
            trigger_error('<strong>NodeMap</strong> :: NOTICE001: No Content from Submited ID', E_USER_NOTICE);
        }
        //self::$contentParams = self::params();
        return true;
    }
    /**
     *
     * Returns non inherited Content paramameters
     * @param int $nodeId Required. Node ID
     * @return array
     */
    public static function params($nodeId=FALSE) {
        $nodeId = intval($nodeId,10);
        $nodeId = $nodeId ? $nodeId : self::$nodeId;
        global $configVars;

        $q1	= "SELECT ".DbConf::$_NODE_PARAMS." FROM ".DbConf::$_TNODE." WHERE ".DbConf::$_NODE_ID."=?";
        $r1 = self::$db->fetchCell($q1,array($nodeId));
        if (!self::$db->numberRows()) {
            //trigger_error('<strong>NodeMap</strong> :: ERROR003: No Params in selected content', E_USER_ERROR);
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
     * @param int $nodeId Required. Node ID
     * @param bool $stringMode Optional. Default value: FALSE. Return path as a concatenated string of IDs
     * @return array
     */
	public static function path($nodeId=false,$stringMode=false){
        $nodeId   = intval($nodeId,10);
        $nodeId   = $nodeId ? $nodeId : self::$nodeId;
        if(!isset(self::$flatMap[$nodeId])){
            trigger_error('<strong>NodeMap</strong> :: NOTICE002: No Content from Submited ID', E_USER_NOTICE);
        }
		$level       = self::$flatMap[$nodeId][DbConf::$_NODE_LEVELID];
		$path        = array();
		for($i=$level;$i>0;$i--){
			if($stringMode){
				$path[] = $nodeId;
			}else{
				$path[] = array(
				    DbConf::$_NODE_ID        => $nodeId,
				    DbConf::$_NODE_LEVELID   => $i,
				    DbConf::$_NODE_TITLE     => self::$flatMap[$nodeId][DbConf::$_NODE_TITLE]
				);
			}
			$nodeId		= self::$flatMap[$nodeId][DbConf::$_NODE_PARENTID];
		}
		if(is_array($path)){
		    $path	= array_reverse($path);
		}
		$path	= ($stringMode) ? implode(",",$path) : $path;
		return $path;
	}
	/**
	 *
	 * Finds a recursive value for a specific field for a specific node
	 * @param int $nodeId Required. Base Node ID
	 * @param string $field Required. Field name to find its recursive value
	 * @param bool $returnValue Optional. Default value: TRUE. Return only the value or an array with the node inheritance
	 * @param mixed $inheritedValue Optional. This parameter is only used as a referent in the recursive search
	 * @return mixed
	 */
	public static function property($nodeId=false,$field=null,$returnValue=true,$inheritedValue=false){
        $nodeId   = intval($nodeId,10);
        $nodeId   = $nodeId ? $nodeId : self::$nodeId;

		if(!(isset(self::$flatMap[$nodeId]) && isset(self::$flatMap[$nodeId][$field]))){
			return false;
		}
		if(self::$flatMap[$nodeId][$field]!=$inheritedValue || $nodeId==1){
			if($returnValue){
				return self::$flatMap[$nodeId][$field];
			}
			return self::$flatMap[$nodeId];
		}
		return self::property(self::$flatMap[$nodeId][DbConf::$_NODE_PARENTID],$field,$returnValue,$inheritedValue);
	}
	/**
	 *
	 * Retruns all Content data
	 * @param mixed $nodeId If an array value is submited, it returns and array with all found node data
	 * @param bool $breakLines Returns break lines as HTML BRs
	 * @return array
	 */
	public static function data($nodeId=false,$breakLines=false){
	    $group = false;
	    if(is_array($nodeId) && count($nodeId)){
	        while (list($k,$v) = each($nodeId)){
	            $v = intval($v,10);
	            if($v){
	                continue;
	            }
                unset($nodeId[$k]);
	        }
	        if(!count($nodeId)){
	            return false;
	        }
	        $group = true;
	    }else{
            $nodeId   = intval($nodeId,10);
            $nodeId   = $nodeId ? $nodeId : self::$nodeId;
	    }

		$q1	= sprintf("SELECT * FROM `%s` WHERE `%s` %s %s"
			,DbConf::$_TNODE
			,DbConf::$_NODE_ID
			,$group ? 'IN' : '='
		    ,$group ? '('.implode(',', $nodeId).')' : "'".$nodeId."'"
		);
		$r1	= self::$db->fetch($q1,array($nodeId));
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
	/**
	 *
	 * Returns current node children list
	 * @param int $nodeId Required. Node Id
	 * @param bool $visible Optional. Default value: True. Returns only visible nodes
	 * @param bool $completeData. Optional. Default value: False. Returns all nodes data
	 * @return array
	 */
	public static function children($nodeId=null,$visible=true,$completeData=false){
        $nodeId   = intval($nodeId,10);
        $nodeId   = $nodeId ? $nodeId : self::$nodeId;

		if(!isset( self::$flatMap[$nodeId] )){
			return false;
		}
		$level	= self::$flatMap[$nodeId][DbConf::$_NODE_LEVELID] + 1;
		$params	= self::$nodeId == $nodeId ? self::$contentParams : self::params($nodeId);

		if(!isset(self::$relMap[$level][$nodeId])){
			return false;
		}

		$nav = array();
		$idList = array();
		while (list($k1,$v1) = each(self::$relMap[$level][$nodeId])) {
			if (!$v1[DbConf::$_NODE_VISIBLE] && $visible) {
			    continue;
			}
		    $idList[] = $k1;
			$nav[]	= array(
				DbConf::$_NODE_ID      => $k1,
				DbConf::$_NODE_TITLE   => $v1[DbConf::$_NODE_TITLE],
				DbConf::$_NODE_DATE    => $v1[DbConf::$_NODE_DATE],
				DbConf::$_NODE_ORDER   => $v1[DbConf::$_NODE_ORDER],
			);
		}
		reset(self::$relMap[$level][$nodeId]);
		if($completeData){
		    $nav = self::data($idList);
		}
		//$nav	= array_asoc_sort($nav,$params['orderBy'],$params['orderDir']);
		return $nav;
	}
	/**
	 *
	 * Returns current node siblings list
	 * @param int $nodeId Required. Node Id
	 * @param bool $visible Optional. Default value: True. Returns only visible nodes
	 * @param bool $completeData. Optional. Default value: False. Returns all nodes data
	 * @param bool $plainlist Optional. Default value: False. Returns siblings as a flat array instead a grouped array of previous, current and next siblings
	 * @return array
	 */
	public static function siblings($nodeId=null,$visible=true,$completeData=false,$plainlist=FALSE){
        $nodeId   = intval($nodeId,10);
        $nodeId   = $nodeId ? $nodeId : self::$nodeId;

		if(!isset( self::$flatMap[$nodeId] )){
			return false;
		}
		$siblings = self::children(self::$flatMap[$nodeId][DbConf::$_NODE_PARENTID],$visible,$completeData);
		if($plainlist){
		    return $siblings;
		}
		$ret = array('previous'=>array(),'current'=>array(),'next'=>array());
		while(list(,$v) = each($siblings)){
		    if ($ret['current']){
		        $ret['next'][]=$v;
		        continue;
		    }
            if($v[DbConf::$_NODE_ID]==$nodeId){
                $ret['current'][]=$v;
                continue;
            }
            $ret['previous'][]=$v;
		}
		return $ret;
	}
}

