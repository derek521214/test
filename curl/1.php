<?php
/**
 * curl 多线程
 * @param array $array 并行网址
 * @param int $timeout 超时时间
 * @return array
 */
function Curl_http($array,$timeout)
{
    $res = array();
    $mh = curl_multi_init();//创建多个curl语柄
    $conn = [];
    foreach ($array as $k => $url) {
        $conn[$k] = curl_init($url);
        curl_setopt($conn[$k], CURLOPT_TIMEOUT, $timeout);//设置超时时间
//        curl_setopt($conn[$k], CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($conn[$k], CURLOPT_MAXREDIRS, 7);//HTTp定向级别
        curl_setopt($conn[$k], CURLOPT_HEADER, 0);//这里不要header，加块效率
        curl_setopt($conn[$k], CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
        curl_setopt($conn[$k], CURLOPT_RETURNTRANSFER, 1);
        curl_multi_add_handle($mh, $conn[$k]);
    }

    // 执行批处理句柄
    $active = null;
    do {
        $mrc = curl_multi_exec($mh, $active);//当无数据，active=true
    } while ($mrc == CURLM_CALL_MULTI_PERFORM); //当正在接受数据时

    while ($active && $mrc == CURLM_OK) {//当无数据时或请求暂停时，active=true
//        if(curl_multi_select($mh) != -1){
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
//        }
    }

    foreach ($array as $k => $url) {
        curl_error($conn[$k]);
        $res[$k] = curl_multi_getcontent($conn[$k]);//获得返回信息
        $header[$k] = curl_getinfo($conn[$k]);//返回头信息
        curl_multi_remove_handle($mh, $conn[$k]);//释放资源
        curl_close($conn[$k]);//关闭语柄

    }
    curl_multi_close($mh);
    return $res;
}
//测试
$array = array(
    "http://www.weibo.com/",
    "http://www.renren.com/",
    "http://www.qq.com/"
);
$data = Curl_http($array, '10');//调用
print_r($data);//输出

