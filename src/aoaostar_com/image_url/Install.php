<?php

namespace plugin\aoaostar_com\image_url;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '图片外链';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '上传图片并获取外链地址';
        $model->version = 'v1.3';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
