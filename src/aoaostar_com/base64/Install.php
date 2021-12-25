<?php

namespace plugin\aoaostar_com\base64;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'base64编码/解码';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '对字符串进行base64编码/解码';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
