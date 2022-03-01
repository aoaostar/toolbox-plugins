<?php

namespace plugin\aoaostar_com\urlencode;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'URL编码/解码';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '对URL进行编码/解码';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
