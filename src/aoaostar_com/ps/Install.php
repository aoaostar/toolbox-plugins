<?php

namespace plugin\aoaostar_com\ps;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '在线PS';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '在线使用PS进行图片编辑';
    }

    public function UnInstall(Plugin $model)
    {

    }
}