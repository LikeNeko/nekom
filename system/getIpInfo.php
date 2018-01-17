<?php
/**
 * User: 猫
 * Date: 2018/1/17
 * Time: 下午 14:28:25
 */

$Ip = $_SERVER[ "REMOTE_ADDR" ];
$data = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $Ip);
$ipinfo = json_decode($data, true);
if ( $ipinfo[ 'code' ] == 0 ) {

    $ret[ 'country' ] = $ipinfo[ 'data' ][ 'country' ];// 国
    $ret[ 'region' ] = $ipinfo[ 'data' ][ 'region' ] == '北京市' ? '帝都' : $ipinfo[ 'data' ][ 'region' ];// 省
    $ret[ 'city' ] = $ipinfo[ 'data' ][ 'city' ] == '北京市' ? "(" . $ipinfo[ 'data' ][ 'city' ] . ")" : $ipinfo[ 'data' ][ 'city' ];// 市

    $time = Date('H');

    if($time>6&&$time<=11){
        $ret['msg']= '早上好呀！来自'.$ret[ 'country' ].$ret[ 'region' ].$ret[ 'city' ].'的朋♀友/滑稽';
    }else if($time>11&&$time<=14){
        $ret['msg']= '中午好呀！来自'.$ret[ 'country' ].$ret[ 'region' ].$ret[ 'city' ].'的朋♀友，玩的愉快哟~';
    }else if($time>14&&$time<=19){
        $ret['msg']= '下午好呀！来自'.$ret[ 'country' ].$ret[ 'region' ].$ret[ 'city' ].'的朋♀友，来一发吗~';
    }else if($time>19&&$time<24){
        $ret['msg']= '晚上好呀！来自'.$ret[ 'country' ].$ret[ 'region' ].$ret[ 'city' ].'的朋♀友，来一杯咖啡提提神吗~~';
    }else{
        $ret['msg']= '来自'.$ret[ 'country' ].$ret[ 'region' ].$ret[ 'city' ].'的朋友，欢迎你~';
    }
    if(!$_COOKIE['welcome']){
        setcookie('welcome',1,time()+7200,'/');
        echo json_encode($ret);
    }



}
