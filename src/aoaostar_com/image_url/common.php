<?php

!defined('USERAGENT') && define("USERAGENT", 'User-Agent:Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50');
!defined('CONTENT_TYPE_MULTIPART_FORM_DATA') &&define("CONTENT_TYPE_MULTIPART_FORM_DATA", 'Content-Type:multipart/form-data');
!defined('CONTENT_TYPE_APPLICATION_JSON') &&define("CONTENT_TYPE_APPLICATION_JSON", 'Content-Type: application/json');


if (!function_exists('rand_ip')) {
    //随机IP
    function rand_ip()
    {
        $ip2id = round(rand(600000, 2550000) / 10000); //第一种方法，直接生成
        $ip3id = round(rand(600000, 2550000) / 10000);
        $ip4id = round(rand(600000, 2550000) / 10000);
        //下面是第二种方法，在以下数据中随机抽取
        $arr_1 = array("218", "218", "66", "66", "218", "218", "60", "60", "202", "204", "66", "66", "66", "59", "61", "60", "222", "221", "66", "59", "60", "60", "66", "218", "218", "62", "63", "64", "66", "66", "122", "211");
        $randarr = mt_rand(0, count($arr_1) - 1);
        $ip1id = $arr_1[$randarr];
        return $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;
    }
}

if (!function_exists('xiaomei_post')) {

    function xiaomei_post(
        $url,
        $post,
        $headers = []
    ): string
    {
        $rand_ip = rand_ip();
        // 初始化
        $headers = array_merge([
            'User-Agent:Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
            "X-Real-IP:$rand_ip",
            "CLIENT-IP:$rand_ip",

        ], $headers);
        // 创建一个新 cURL 资源
        $curl = curl_init();
        // 设置URL和相应的选项
        // 需要获取的 URL 地址
        curl_setopt($curl, CURLOPT_URL, $url);
        #启用时会将头文件的信息作为数据流输出。
        curl_setopt($curl, CURLOPT_HEADER, false);
        #设置头部信息
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        #在尝试连接时等待的秒数。设置为 0，则无限等待。
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        #允许 cURL 函数执行的最长秒数。
        curl_setopt($curl, CURLOPT_TIMEOUT, 600);
        #设置请求信息
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        #关闭ssl
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        #TRUE 将 curl_exec获取的信息以字符串返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // 抓取 URL 并把它传递给浏览器
        $return = curl_exec($curl);
        if ($return === false) {
            return 'CURL Error:' . curl_error($curl);
        }
        curl_close($curl);
        return $return;
    }
}

if (!function_exists('xiaomei_get')) {
    function xiaomei_get($url, $headers = []): string
    {
        $rand_ip = rand_ip();
        $headers = array_merge([
            'User-Agent:Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
            "X-Real-IP:$rand_ip",
            "CLIENT-IP:$rand_ip",
        ], $headers);
        // 创建一个新 cURL 资源
        $curl = curl_init();
        // 设置URL和相应的选项
        // 需要获取的 URL 地址
        curl_setopt($curl, CURLOPT_URL, $url);
        #启用时会将头文件的信息作为数据流输出。
        curl_setopt($curl, CURLOPT_HEADER, false);
        #在尝试连接时等待的秒数。设置为 0，则无限等待。
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        #允许 cURL 函数执行的最长秒数。
        curl_setopt($curl, CURLOPT_TIMEOUT, 600);
        #关闭ssl
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        #TRUE 将 curl_exec获取的信息以字符串返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        #设置header
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // 跟踪重定向
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        // 抓取 URL 并把它传递给浏览器
        $res = curl_exec($curl);
        // 关闭 cURL 资源，并且释放系统资源
        if ($res === false) {
            return "CURL Error:" . curl_error($curl);
        }
        curl_close($curl);
        return $res;
    }
}

if (!function_exists('file_to_base64')) {

    function file_to_base64($filepath): string
    {
        return base64_encode(file_get_contents($filepath));
    }
}
/**
 * 是否为合法URL
 * @param null $url
 * @return bool
 */

if (!function_exists('is_valid_url')) {

    function is_valid_url($url = null)
    {
        if (empty($url)) return false;
        if (!is_string($url)) return false;
        $filter_var = boolval(filter_var($url, FILTER_VALIDATE_URL));
        if ($filter_var) return $filter_var;
        $parse_url = parse_url($url);
        $path = array_pop($parse_url);

        $url = str_ireplace($path, '/' . urlencode($path), $url);
        return boolval(filter_var($url, FILTER_VALIDATE_URL));
    }

}
