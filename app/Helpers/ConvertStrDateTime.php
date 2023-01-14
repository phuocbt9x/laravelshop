<?php
if(!function_exists('ConvertStrDateTime')){
    function ConvertStrDateTime ($strTime, $format = 'Y-m-d H:i:s'){
        $arrTime = explode(' ', $strTime);
        $date = explode('/',$arrTime[0]);
        $strTime = $date[2] . '-' . $date[0] . '-' . $date[1] . ' ' . $arrTime[1] . ' ' . $arrTime[2];
        return DateTime::createFromFormat('Y-m-d g:i a', $strTime)->format($format);
    }
}
if(!function_exists('ConvertDateTime')){
    function ConvertDateTime ($strTime, $format = 'd-m-Y H:i:s'){
        return date($format, strtotime($strTime));
    }
    
}
