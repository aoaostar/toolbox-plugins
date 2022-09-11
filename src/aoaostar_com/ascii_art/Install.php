<?php

namespace plugin\aoaostar_com\ascii_art;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'ASCII艺术字生成';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '生成ASCII艺术字';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
