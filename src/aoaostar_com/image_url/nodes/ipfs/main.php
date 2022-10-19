<?php

namespace plugin\aoaostar_com\image_url\nodes\ipfs;

use plugin\aoaostar_com\image_url\ApiException;
use plugin\aoaostar_com\image_url\Plugin;

class main implements Plugin
{

    public function main($filepath): string
    {

        $data = [
            'file' => new \CURLFile($filepath),
        ];

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
            base64_decode('QXV0aG9yaXphdGlvbjogQmFzaWMgTWtSRmVYSmtUbkJTY21Gb1JVRXdSazEzVlcxbFRGSjVRVUpVT2pWaFl6QTFaamcwWTJGbU16aGlOV0l3Wldaak5qQTVaamMwTkdNeE5ERm0='),
        );
        $res = xiaomei_post('https://ipfsapi.glitch.me/api/v0/add?pin=true', $data, $headers);
        $explode = explode("\n", $res);
        $result = json_decode($explode[0]);
        if (!empty($result->Hash)) {
            return 'https://cf-ipfs.com/ipfs/' . $result->Hash;
        }
        $msg = '上传失败';
        throw new ApiException($msg, $res);
    }
}
