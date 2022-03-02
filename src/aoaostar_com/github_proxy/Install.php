<?php

namespace plugin\aoaostar_com\github_proxy;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'GitHub Proxy';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = 'GitHub Proxy代理加速';
        $model->version = 'v1.2';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
