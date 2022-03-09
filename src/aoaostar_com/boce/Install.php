<?php

namespace plugin\aoaostar_com\boce;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        # 标题
        $model->title = "BOCE拨测";
        # 类名、无需修改
        $model->class = plugin_current_class_get(__NAMESPACE__);
        # 路由、即 example
        $model->alias = base_space_name(__NAMESPACE__);
        # 描述
        $model->desc = '网站测速工具,ping检测,域名污染检测,域名被墙查询,dns查询,网速测试,测网速,ipv6网站测试';
        $model->template = 'redirect';
        $model->config = [
            'url' => 'https://www.boce.com/'
        ];
        # 版本号
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}