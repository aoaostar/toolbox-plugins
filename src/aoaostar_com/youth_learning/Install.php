<?php

namespace plugin\aoaostar_com\youth_learning;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '青年大学习完成图生成';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '在线生成青年大学习完成图，无需播放，一键获取完成记录';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
