<?php

namespace plugin\aoaostar_com\roll_call;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = "随机点名";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '本随机点名工具广泛应用于老师上课点名，随机任务分配，抽奖活动等需要随机抽取名单的情景，使用方便快捷。';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
