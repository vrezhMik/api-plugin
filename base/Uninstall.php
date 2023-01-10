<?php

namespace Base;

use \Admin\DataBase;

class Uninstall
{
    public static function uninstall()
    {
        Database::delete_all();
    }
}
