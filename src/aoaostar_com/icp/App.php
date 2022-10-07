<?php

namespace plugin\aoaostar_com\icp;

use plugin\Drive;
use think\facade\Cache;

class App implements Drive
{
    private $token;
    private $data;

    # 访问/api/example
    public function Index()
    {
        return success(plugin_info_get());
    }

    public function auth()
    {
        $this->token = Cache::get(base64_encode(__NAMESPACE__ . __FUNCTION__));
        if (!empty($this->token)) {
            return true;
        }
        $ip = rand_ip();
        $timeStamp = time();
        $authKey = md5("testtest" . $timeStamp);
        $aoaostar_post = aoaostar_post(
            'https://hlwicpfwc.miit.gov.cn/icpproject_query/api/auth',
            'authKey=' . $authKey . '&timeStamp=' . $timeStamp, [
            "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
            "Origin: https://beian.miit.gov.cn/",
            "Referer: https://beian.miit.gov.cn/",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36",
            "CLIENT-IP: $ip",
            "X-FORWARDED-FOR: $ip"
        ]);
        $this->data = $aoaostar_post;
        $token = json_decode($aoaostar_post);
        if (empty($token->params->bussiness)) {
            return false;
        }
        $this->token = $token->params->bussiness;
        Cache::set(base64_encode(__NAMESPACE__ . __FUNCTION__), $this->token, 300000);
        return true;
    }

    public function query_miit_gov()
    {
        if (!$this->auth()) {
            return error('api抽风了，请稍等', $this->data);
        }
        $ip = rand_ip();
        $domain = request()->param('domain');

        $resp = Cache::get(base64_encode(__NAMESPACE__ . __FUNCTION__ . $domain));
        if (!empty($resp)) {
            return success($resp);
        }
        $aoaostar_post = aoaostar_post('https://hlwicpfwc.miit.gov.cn/icpproject_query/api/icpAbbreviateInfo/queryByCondition',
            json_encode([
                'pageNum' => '',
                'pageSize' => '',
                'unitName' => $domain,
            ])
            , [
                "Content-Type: application/json;charset=UTF-8",
                "Origin: https://beian.miit.gov.cn/",
                "Referer: https://beian.miit.gov.cn/",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36",
                "CLIENT-IP: $ip",
                "X-FORWARDED-FOR: $ip",
                "token: $this->token",
            ]);
        $this->data = $aoaostar_post;
        $json_decode = json_decode($aoaostar_post);
        if (empty($json_decode)) {
            return error('api抽风了，请稍等', $this->data);
        }
        if (!empty($json_decode->msg) && str_contains($json_decode->msg, 'token过期')) {
            if (!$this->auth()) {
                return error('api抽风了，请稍等', $this->data);
            }
            return $this->query();
        }
        if (!empty($json_decode->params->list[0])) {
            Cache::set(base64_encode(__NAMESPACE__ . __FUNCTION__ . $domain), $json_decode, 0);
            return success($json_decode->params->list[0]);
        }
        $message = 'error';
        if (!empty($json_decode->msg)) {
            $message = $json_decode->msg;
        }
        return error($message, $json_decode);

    }

    public function query()
    {
//        https://icp.chinaz.com/home/info?host=baidu.com
        $domain = request()->param('domain');
        $domain = str_ireplace(['http://', 'https://'], '', $domain);
        if (empty($domain) || !is_valid_url('http://' . trim($domain))) {
            return error('请输入正确的域名');
        }
        $resp = Cache::get(base64_encode(__NAMESPACE__ . __FUNCTION__ . $domain));
        if (!empty($resp)) {
            return success($resp);
        }

        $aoaostar_get = aoaostar_get('https://icp.chinaz.com/home/info?host=' . $domain);
        preg_match_all('~<p>(.+?)</p>~', $aoaostar_get, $matches);
        if (isset($matches[1]) && count($matches[1]) >= 8) {
            $data = [
                'domain' => $matches[1][7],
                'main_page' => $matches[1][6],
                'main_licence' => $matches[1][0],
                'service_licence' => $matches[1][5],
                'unit_name' => $matches[1][2],
                'update_record_time' => $matches[1][1],
                'nature_name' => $matches[1][3],
                'site_name' => $matches[1][4],
            ];
            Cache::set(base64_encode(__NAMESPACE__ . __FUNCTION__ . $domain), $data, 0);
            return success($data);
        }
        return error('api可能抽风了，请稍后再试', $aoaostar_get);

    }
}

if (!function_exists('rand_ip')) {

    function rand_ip()
    {
        return mt_rand(1, 255) . '.' . mt_rand(1, 255) . '.' . mt_rand(1, 255) . '.' . mt_rand(1, 255);
    }
}