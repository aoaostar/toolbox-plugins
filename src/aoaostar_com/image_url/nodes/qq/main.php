<?php

class qq implements plugin
{
    public function main($filepath): string
    {

        $data['Filedata'] = new \CURLFile($filepath);

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
        );
        $res = xiaomei_post('https://om.qq.com/image/orginalupload', $data, $headers);
        $result = json_decode($res);
        if (!empty($result->data->url) && $result->response->code == 0) {
            return $result->data->url;
        }

        if (!empty($result->response->msg)) {
            $msg = $result->response->msg;
        } else {
            $msg = '上传失败';
        }
        throw new ApiException($msg, $res);
    }
}
