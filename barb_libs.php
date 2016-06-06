<?php

if(!function_exists('bp_log')) {
    /**
     * ログファイル出力する
     * @param $message
     */
    function bp_log($message) {
        if (defined('BARB_DEBUG') && BARB_DEBUG) {
            $trace = debug_backtrace();
            $time = date('Y-m-d H:i:s');
            error_log("$time $message {$trace[0]['file']} {$trace[0]['line']}\n", 3, ABSPATH.date('Y-m-d').'.log');
        }
    }
}

if(!function_exists('doSqlEscape')) {
    /**
     * SQL用のエスケープ
     * @param string $str エスケープする対象の文字列
     */
    function doSqlEscape(&$str)
    {
        $str = str_replace("\\", "\\\\", $str);
        $str = str_replace(";", "\;", $str);
        $str = str_replace("'", "\'", $str);
        $str = str_replace('"', '\'', $str);
        $str = str_replace('%', '\%', $str);
        $str = str_replace("`", "\`", $str);
    }
}