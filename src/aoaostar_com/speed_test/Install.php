<?php

namespace plugin\aoaostar_com\speed_test;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        # 标题
        $model->title = "网速测试";
        # 类名、无需修改
        $model->class = plugin_current_class_get(__NAMESPACE__);
        # 路由、即 example
        $model->alias = base_space_name(__NAMESPACE__);
        # 描述
        $model->desc = $model->title.'提供网速测试，网络质量测试，宽带测速，Wi-Fi测速，5G测速，IPv6测速，带宽检测，路由器测速，网关测速，宽带提速，宽带升级，网络加速，内网测速，专网测速，视频测试，游戏测速，直播测速，网络诊断，蹭网检测，物联网监测，网站监测，API监测，Ping测试，路由测试等专业服务，拥有国内外大量高性能测试点，覆盖电信，移动，联通，网通，广电，长城宽带，鹏博士等运营商。';
        $model->template = 'iframe';
        $model->config = [
            'url'=>'https://plugin.speedtest.cn/'
        ];
        # 版本号
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}