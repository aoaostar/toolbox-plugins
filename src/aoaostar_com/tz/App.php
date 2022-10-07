<?php

namespace plugin\aoaostar_com\tz;

use PDO;
use plugin\aoaostar_com\tz\Utils\UtilsCpu;
use plugin\aoaostar_com\tz\Utils\UtilsDisk;
use plugin\aoaostar_com\tz\Utils\UtilsMemory;
use plugin\aoaostar_com\tz\Utils\UtilsNetwork;
use plugin\aoaostar_com\tz\Utils\UtilsTime;
use plugin\Drive;
use SQLite3;

class App implements Drive
{
    private function getServerInfo($key)
    {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : '';
    }

    public function Index()
    {

        $data = [
            'networkStats' =>
                [
                    'networks' => UtilsNetwork::getStats(),
                    'timestamp' => time(),
                ],
            'serverInfo' =>
                [
                    'serverName' => $this->getServerInfo('SERVER_NAME'),
                    'serverUtcTime' => UtilsTime::getUtcTime(),
                    'serverTime' => UtilsTime::getTime(),
                    'serverUptime' => UtilsTime::getUptime(),
                    'serverIp' => $this->getServerInfo('SERVER_ADDR'),
                    'serverSoftware' => $this->getServerInfo('SERVER_SOFTWARE'),
                    'phpVersion' => \PHP_VERSION,
                    'cpuModel' => UtilsCpu::getModel(),
                    'serverOs' => php_uname(),
                    'scriptPath' => __FILE__,
                ],
            'serverStatus' => [
                'sysLoad' => UtilsCpu::getLoadAvg(),
                'cpuUsage' => UtilsCpu::getUsage(),
                'memRealUsage' => [
                    'value' => UtilsMemory::getMemoryUsage('MemRealUsage'),
                    'max' => UtilsMemory::getMemoryUsage('MemTotal'),
                ],
                'memBuffers' => [
                    'value' => UtilsMemory::getMemoryUsage('Buffers'),
                    'max' => UtilsMemory::getMemoryUsage('MemUsage'),
                ],
                'memCached' => [
                    'value' => UtilsMemory::getMemoryUsage('Cached'),
                    'max' => UtilsMemory::getMemoryUsage('MemUsage'),
                ],
                'swapUsage' => [
                    'value' => UtilsMemory::getMemoryUsage('SwapUsage'),
                    'max' => UtilsMemory::getMemoryUsage('SwapTotal'),
                ],
                'swapCached' => [
                    'value' => UtilsMemory::getMemoryUsage('SwapCached'),
                    'max' => UtilsMemory::getMemoryUsage('SwapUsage'),
                ],
                'diskUsage' => [
                    'value' => UtilsDisk::getTotal() - UtilsDisk::getFree(),
                    'max' => UtilsDisk::getTotal(),
                ],
            ]
        ];
        return success($data);
    }

    public function server_info()
    {

        $data = [
            'serverName' => $this->getServerInfo('SERVER_NAME'),
            'serverUtcTime' => UtilsTime::getUtcTime(),
            'serverTime' => UtilsTime::getTime(),
            'serverUptime' => UtilsTime::getUptime(),
            'serverIp' => $this->getServerInfo('SERVER_ADDR'),
            'serverSoftware' => $this->getServerInfo('SERVER_SOFTWARE'),
            'phpVersion' => \PHP_VERSION,
            'cpuModel' => UtilsCpu::getModel(),
            'serverOs' => php_uname(),
            'scriptPath' => __FILE__,
            'serverAdmin' => $this->getServerInfo('SERVER_ADMIN'),
        ];
        return success($data);
    }

    public function php_info()
    {

        $data = [
            'version' => \PHP_VERSION,
            'zend_version' => zend_version(),
            'sapi' => \PHP_SAPI,
            'displayErrors' => (bool)\ini_get('display_errors'),
            'errorReporting' => (int)\ini_get('error_reporting'),
            'memoryLimit' => (string)\ini_get('memory_limit'),
            'postMaxSize' => (string)\ini_get('post_max_size'),
            'uploadMaxFilesize' => (string)\ini_get('upload_max_filesize'),
            'maxInputVars' => (int)\ini_get('max_input_vars'),
            'maxExecutionTime' => (int)\ini_get('max_execution_time'),
            'defaultSocketTimeout' => (int)\ini_get('default_socket_timeout'),
            'allowUrlFopen' => (bool)\ini_get('allow_url_fopen'),
            'smtp' => (bool)\ini_get('SMTP'),
            'disableFunctions' => array_filter(explode(',', (string)\ini_get('disable_functions'))),
            'disableClasses' => array_filter(explode(',', (string)\ini_get('disable_classes'))),
        ];
        return success($data);
    }

    public function php_extensions()
    {
        $isOpcEnabled = (function () {
            $isOpcEnabled = \function_exists('opcache_get_configuration');
            if ($isOpcEnabled) {
                $isOpcEnabled = opcache_get_configuration();
                $isOpcEnabled = isset($isOpcEnabled['directives']['opcache.enable']) && true === $isOpcEnabled['directives']['opcache.enable'];
            }
            return $isOpcEnabled;
        })();
        $jitEnabled = false;
        if (\function_exists('opcache_get_status')) {
            $status = opcache_get_status();
            if (isset($status['jit']['enabled']) && true === $status['jit']['enabled']) {
                $jitEnabled = true;
            }
        }

        $data = [
            'redis' => \extension_loaded('redis') && class_exists('Redis'),
            'sqlite3' => \extension_loaded('sqlite3') && class_exists('Sqlite3'),
            'memcache' => \extension_loaded('memcache') && class_exists('Memcache'),
            'memcached' => \extension_loaded('memcached') && class_exists('Memcached'),
            'opcache' => \function_exists('opcache_get_status'),
            'opcacheEnabled' => $isOpcEnabled,
            'opcacheJitEnabled' => $jitEnabled,
            'swoole' => \extension_loaded('swoole') && \function_exists('swoole_version'),
            'imagick' => \extension_loaded('imagick') && class_exists('Imagick'),
            'gmagick' => \extension_loaded('gmagick'),
            'exif' => \extension_loaded('exif') && \function_exists('exif_imagetype'),
            'fileinfo' => \extension_loaded('fileinfo'),
            'simplexml' => \extension_loaded('simplexml'),
            'sockets' => \extension_loaded('sockets') && \function_exists('socket_accept'),
            'mysqli' => \extension_loaded('mysqli') && class_exists('mysqli'),
            'zip' => \extension_loaded('zip') && class_exists('ZipArchive'),
            'mbstring' => \extension_loaded('mbstring') && \function_exists('mb_substr'),
            'phalcon' => \extension_loaded('phalcon'),
            'xdebug' => \extension_loaded('xdebug'),
            'zendOptimizer' => \function_exists('zend_optimizer_version'),
            'ionCube' => \extension_loaded('ioncube loader'),
            'sourceGuardian' => \extension_loaded('sourceguardian'),
            'ldap' => \function_exists('ldap_connect'),
            'curl' => \function_exists('curl_init'),
            'loadedExtensions' => get_loaded_extensions(),
        ];
        return success($data);
    }

    public function database()
    {

        $sqlite3Version = class_exists('SQLite3') ? SQLite3::version() : false;

        $data = ['sqlite3' => $sqlite3Version ? $sqlite3Version['versionString'] : false,
            'sqliteLibversion' => \function_exists('sqlite_libversion') ? sqlite_libversion() : false,
            'mysqliClientVersion' => \function_exists('mysqli_get_client_version') ? mysqli_get_client_version() : false,
            'mongo' => class_exists('Mongo'),
            'mongoDb' => class_exists('MongoDB'),
            'postgreSql' => \function_exists('pg_connect'),
            'paradox' => \function_exists('px_new'),
            'msSql' => \function_exists('sqlsrv_server_info'),
            'pdo' => class_exists('PDO') ? PDO::getAvailableDrivers() : false,

        ];
        return success($data);
    }
}