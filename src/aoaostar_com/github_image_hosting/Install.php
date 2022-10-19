<?php

namespace plugin\aoaostar_com\github_image_hosting;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'GitHub图床';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '上传图片到GitHub并获取外链地址';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
