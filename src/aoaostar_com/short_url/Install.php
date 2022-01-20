<?php

namespace plugin\aoaostar_com\short_url;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = "短网址生成";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '短网址生成,短链接生成';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
