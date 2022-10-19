<?php

namespace plugin\aoaostar_com\image_url\nodes\niupic;

use plugin\aoaostar_com\image_url\ApiException;
use plugin\aoaostar_com\image_url\Plugin;

class main implements Plugin
{

    public function main($filepath): string
    {

        $data = [
            'image_field' => new \CURLFile($filepath),
        ];

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
        );
        $res = xiaomei_post('https://niupic.com/index/upload/process', $data, $headers);
        $result = json_decode($res);
        if (!empty($result->data)) {
            return preg_replace('#http(s)://#', "https://i0.wp.com/", $result->data);
        }

        if (!empty($result->msg)) {
            $msg = $result->msg;
        } else {
            $msg = '上传失败';
        }
        throw new ApiException($msg, $res);
    }
}
