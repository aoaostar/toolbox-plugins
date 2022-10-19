<?php

namespace plugin\aoaostar_com\image_url\nodes\ai58;

use plugin\aoaostar_com\image_url\ApiException;
use plugin\aoaostar_com\image_url\Plugin;

class main implements Plugin
{

    public function main($filepath): string
    {

        $data = [
            "Pic-Size" => "0*0",
            "Pic-Encoding" => "base64",
            "Pic-Path" => "/nowater/webim/big/",
            "Pic-Data" => file_to_base64($filepath),
        ];

        $headers = array(
            CONTENT_TYPE_APPLICATION_JSON,
            USERAGENT,
        );
        $data = json_encode($data);
        $res = xiaomei_post('https://upload.58cdn.com.cn/json', $data, $headers);

        if (!empty($res) && strpos($res, 'n_v2') !== false) {

            return "https://pic" . mt_rand(1, 8) . ".58cdn.com.cn/nowater/webim/big/" . $res;
        }

        throw new ApiException('上传失败',$res);

    }
}
