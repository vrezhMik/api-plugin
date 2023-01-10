<?php

namespace Admin;

use Admin\Controller;

class Init extends Controller
{
    public static $bashName = "testfile.sh";

    public static function get_services()
    {
        return array(
            Enqueue::class,
            AdminSettings::class,
            API_CLI::class
        );
    }

    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = new $class;
            if (method_exists($service, 'run')) {
                $service->run();
            }
        }
    }

    public static function countTheTime($time)
    {
        return (time() - strtotime($time) > 3601);
    }

    public  function runBash()
    {
        $bashFile = fopen($this->plugin_path . "/testfile.sh", "w");
        $txt = "#!/bin/bash\ncomposer install && npm i";
        fwrite($bashFile, $txt);
    }

    public function getObject()
    {
        return new Init();
    }
}
