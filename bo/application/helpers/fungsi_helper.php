<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('timeAgo'))
{
	function timeAgo($timestamp){
        $time = time() - $timestamp;
 
        if ($time < 60)
        return ( $time > 1 ) ? $time . ' detik yang lalu' : 'satu detik';
        elseif ($time < 3600) {
        $tmp = floor($time / 60);
        return ($tmp > 1) ? $tmp . ' menit yang lalu' : ' satu menit yang lalu';
        }
        elseif ($time < 86400) {
        $tmp = floor($time / 3600);
        return ($tmp > 1) ? $tmp . ' jam yang lalu' : ' satu jam yang lalu';
        }
        elseif ($time < 2592000) {
        $tmp = floor($time / 86400);
        return ($tmp > 1) ? $tmp . ' hari lalu' : ' satu hari lalu';
        }
        elseif ($time < 946080000) {
        $tmp = floor($time / 2592000);
        return ($tmp > 1) ? $tmp . ' bulan lalu' : ' satu bulan lalu';
        }
        else {
        $tmp = floor($time / 946080000);
        return ($tmp > 1) ? $tmp . ' years' : ' a year';
        }
    }
}

if ( ! function_exists('contul'))
{
	function contul($string){
        if($string == '') {
            return null;
        }else{
            return $string;
        }
    }
}

if ( ! function_exists('contul'))
{
    function get_kode_ref($len = 5){
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $base = strlen($charset);
        $result = '';

        $now = explode(' ', microtime())[1];
        while ($now >= $base){
        $i = $now % $base;
        $result = $charset[$i] . $result;
        $now /= $base;
        }

        return substr($result, -5);
    }
}
?>