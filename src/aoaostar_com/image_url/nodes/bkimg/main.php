<?php

class bkimg implements plugin
{

    public function main($filepath): string
    {

        $data['file'] = new \CURLFile($filepath);

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
        );
        $res = xiaomei_post('http://baike.baidu.com/api/common/uploadimage', $data, $headers);
        $result = json_decode($res);
        if (!empty($result->picUrl)) {
            return $result->picUrl;
        }
        $msg = '上传失败';

        throw new ApiException($msg, $res);
    }
}
