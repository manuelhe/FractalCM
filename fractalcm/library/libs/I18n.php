<?php
class I18n{
    /**
     *
     * init control system
     * @return object I18n instance
     */
    static function init(){
        //return self::getInstance();
    }
    /**
     *
     * I18n string translation
     * @param string|array $input Required. String to be translated to selected locale form. This could be an multidimensional array of strings
     * @param string $locale Required. Locale signature, ie: en_EN. If $locale && $input are not found, it will try to get default $locale value
     * @return string|array
     */
    static function t($input='',$locale=NULL) {
        $input = is_string($input) ? trim($input) : $input;
        if(!$input){
            return false;
        }
        if(is_array($input) && count($input)){
            while (list($k,$v) = each($input)){
                $input[$k] = self::t($v,$locale,$namespace);
            }
            reset($input);
            return $input;
        }
        //@todo Some sort of magic conversion not conjured yet
        return $input;
    }
    /**
     * Asociative multidimensional array sorting
     *
     * @todo Implement real locale ordering
     * @param array $array Required. Asociative multidimensional array
     * @param string $index Required. Key used to order
     * @param string $order Optional. Default value: asc. Sort direction
     * @param boolean $natsort Optional. Default value: FALSE. Use natural sort
     * @param boolean $case_sensitive Optional. Default value: FALSE.  Case sentive sort
     * @return array
     */
    static function array_asoc_sort ($array, $index, $order='asc', $natsort=FALSE, $case_sensitive=FALSE) {
        if(!(is_array($array) && count($array))){
            return FALSE;
        }
        $index = trim($index);
        if(!$index){
           return FALSE;
        }
        $order = strtolower($order);
        if(is_array($array) && count($array)>0) {
            foreach(array_keys($array) as $key){
                $temp[$key]=$array[$key][$index];
            }
            if(!$natsort){
                ($order=='asc')? asort($temp) : arsort($temp);
            }else {
                ($case_sensitive)? natsort($temp) : natcasesort($temp);
                if($order!='asc'){
                    $temp=array_reverse($temp,TRUE);
                }
            }
            foreach(array_keys($temp) as $key){
                (is_numeric($key))? $sorted[]=$array[$key] : $sorted[$key]=$array[$key];
            }
            return $sorted;
        }
        return $array;
    }
}