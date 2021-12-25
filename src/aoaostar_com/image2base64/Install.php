<?php

namespace plugin\aoaostar_com\image2base64;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '图片转base64';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '将图片文件转为base64格式的图片';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
