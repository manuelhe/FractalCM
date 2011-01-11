<?php
class DbConf {
    //Tables Sufix
    static $_TSUFIX        = 'fw_';
    // Tables names
    static $_TNODE         = "node_";
    static $_TTEMPLATE     = "template";
    static $_TUSER         = "user";
    static $_TPROPERTY     = "property";
    static $_TPROUSERCON   = "property_user_content";
    static $_TPROUSER      = "property_user";
    static $_TPROCON       = "property_content";
    static $_TLOGDOC       = "log_document";
    static $_TLOGEMAIL     = "log_email";
    static $_TLOGPAGE      = "log_page";
    static $_TLOGSEARCH    = "log_search";
    static $_TLOGUSER      = "log_user";
    //Fields names
    static $_NODE_ID       = "node_id";
    static $_NODE_LEVELID  = "level_id";  // Definition to maintain legacy because this field really not exists
    static $_NODE_PARENTID = "parent_id";
    static $_NODE_MAP      = "map";
    static $_NODE_TLAYOUT  = "template_layout";
    static $_NODE_THEAD    = "template_head";
    static $_NODE_TMENU1   = "template_menu1";
    static $_NODE_TMENU2   = "template_menu2";
    static $_NODE_TMAIN    = "template_main";
    static $_NODE_TSECOND  = "template_secondary";
    static $_NODE_TFOOT    = "template_footer";
    static $_NODE_VISIBLE  = "visible";
    static $_NODE_TITLE    = "title";
    static $_NODE_SUMMARY  = "summary";
    static $_NODE_CONTENT  = "content";
    static $_NODE_AUTOR    = "autor";
    static $_NODE_IMAGE    = "image";
    static $_NODE_DATE     = "date";
    static $_NODE_CATEGOR  = "categories";
    static $_NODE_ORDER    = "order";
    static $_NODE_PARAMS   = "params";
    static $_NODE_RAWTEXT  = "rawtext";

    static $_TEMPL_ID       = "template_id";
    static $_TEMPL_PARENTID = "parent_id";
    static $_TEMPL_TYPE     = "type";
    static $_TEMPL_NAME     = "name";
    static $_TEMPL_FUNCTION = "function";
    static $_TEMPL_FEDIT    = "function_edit";
    static $_TEMPL_FILE     = "file";
    static $_TEMPL_HTML     = "html";
    static $_TEMPL_VISIBLE  = "visible";
    static $_TEMPL_CUSTOM   = "custom";
	/**
	 *
	 * init control system
	 */
	static function init(){
	    self::$_TNODE    = self::$_TSUFIX.self::$_TNODE.LangConf::$_SYSTEM_LANGUAGE;
	    self::$_TTEMPLATE   = self::$_TSUFIX.self::$_TTEMPLATE;
	    self::$_TUSER       = self::$_TSUFIX.self::$_TUSER;
	    self::$_TPROPERTY   = self::$_TSUFIX.self::$_TPROPERTY;
	    self::$_TPROUSERCON = self::$_TSUFIX.self::$_TPROUSERCON;
	    self::$_TPROUSER    = self::$_TSUFIX.self::$_TPROUSER;
	    self::$_TPROCON     = self::$_TSUFIX.self::$_TPROCON;
	    self::$_TLOGDOC     = self::$_TSUFIX.self::$_TLOGDOC;
	    self::$_TLOGEMAIL   = self::$_TSUFIX.self::$_TLOGEMAIL;
	    self::$_TLOGPAGE    = self::$_TSUFIX.self::$_TLOGPAGE;
	    self::$_TLOGSEARCH  = self::$_TSUFIX.self::$_TLOGSEARCH;
	    self::$_TLOGUSER    = self::$_TSUFIX.self::$_TLOGUSER;
	}
}
DbConf::init();