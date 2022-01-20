<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class dwz_tax implements api
{

    public function main($url): string
    {
        $get = aoaostar_post('https://dwz.tax/api/shorten', [
            'longurl' => $url,
            'token' => '5kis3h4itrr82bfl66decullra',
        ]);
        $json = json_decode($get);
        if (!empty($json) && !empty($json->short)) {
            return $json->short;
        }
        if (!empty($json->msg)) {

            throw new \Exception($json->msg);
        }
        throw new \Exception('生成失败');

    }
}