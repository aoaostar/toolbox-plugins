<?php

namespace plugin\aoaostar_com\aria2;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'Aria2Ng';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = 'Aria2在线管理面板';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
