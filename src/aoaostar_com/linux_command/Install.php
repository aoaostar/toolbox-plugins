<?php

namespace plugin\aoaostar_com\linux_command;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = "Linux命令查询";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '快速查询Linux命令';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
