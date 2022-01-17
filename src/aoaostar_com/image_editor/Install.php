<?php

namespace plugin\aoaostar_com\image_editor;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = "图片编辑";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '在线编辑图片';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
