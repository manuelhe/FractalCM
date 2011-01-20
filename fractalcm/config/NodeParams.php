<?php
class NodeParams{
    private static $params = array();
    /**
     *
     * General instance method
     * @return object NodeParams instance
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
     * @return object NodeParams instance
     */
    static function init(){
        self::getDefaultParams();
        return self::getInstance();
    }
    private static function getDefaultParams(){
        self::$params = array(
            array(
                "param"     => "printButton",
                "name"        => I18n::t("Print this page"),
                "type"        => "select",
                "values"    => array(
                    array(
                        "val"    => 1,
                        "label"    => I18n::t('Yes')
                    ),
                    array(
                        "val"    => 0,
                        "label"    => I18n::t('No')
                    )
                )
            ),
            array(
                "param"        => "numRegs",
                "name"        => I18n::t('Items per page'),
                "type"        => "select",
                "values"    => array(
                    array(
                        "val"    => 10,
                        "label"    => 10
                    ),
                    array(
                        "val"    => 20,
                        "label"    => 20
                    ),
                    array(
                        "val"    => 30,
                        "label"    => 30
                    ),
                    array(
                        "val"    => 50,
                        "label"    => 50
                    ),
                    array(
                        "val"    => 100,
                        "label"    => 100
                    )
                )
            ),
            array(
                "param"    => "sortBy",
                "name"        => I18n::t('Sort by'),
                "type"        => "select",
                "values"    => array(
                    array(
                        "val"    => DbConf::$_NODE_ORDER,
                        "label"    => I18n::t('Order')
                    ),
                    array(
                        "val"    => DbConf::$_NODE_DATE,
                        "label"    => I18n::t('Date')
                    ),
                    array(
                        "val"    => DbConf::$_NODE_TITLE,
                        "label"    => I18n::t('Title')
                    ),
                    array(
                        "val"    => DbConf::$_NODE_ID,
                        "label"    => I18n::t('ID')
                    ),
                    array(
                        "val"    => DbConf::$_NODE_AUTOR,
                        "label"    => I18n::t('Autor')
                    )
                )
            ),
            array(
                "param"        => "sortDir",
                "name"        => I18n::t('Sort direction'),
                "type"        => "select",
                "values"    => array(
                    array(
                        "val"    => "ASC",
                        "label"    => I18n::t('Ascendent')
                    ),
                    array(
                        "val"    => "DESC",
                        "label"    => I18n::t('Descendent')
                    )
                )
            ),
                array(
                "param"        => "subClass",
                "name"        => I18n::t('SubClass'),
                "type"        => "text",
                "values"    => ""
            )
        );
    }
    static function defaultParams(){
        return self::$params;
    }

}
NodeParams::init();
