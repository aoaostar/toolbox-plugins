<?php

namespace plugin\aoaostar_com\icp;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        $model->title = "ICP备案查询";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '通过域名可查询该域名是否有备案及相关的ICP备案许可信息。';
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}