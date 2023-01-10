<?php

namespace Base;

use \Admin\DataBase;
use \Admin\Init;
use \Admin\Controller;

class Activate extends Controller
{

    public function runActivation()
    {
        DataBase::connect();
        $bashFile = fopen("$this->plugin_path/testfile.sh", "w");
        $txt = "#!/bin/bash\ncomposer require --dev php-stubs/wp-cli-stubs && composer install && npm i";
        fwrite($bashFile, $txt);
        fclose($bashFile);
        shell_exec("bash " . Init::$bashName);
        unlink("$this->plugin_path/testfile.sh");
        flush_rewrite_rules();
    }

    public static function activate()
    {
        return new Activate;
    }
}
