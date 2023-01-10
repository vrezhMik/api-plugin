<?php

/**
 * Plugin Name: API
 */

if (!defined('ABSPATH')) die();

require_once "vendor/autoload.php";

use Admin\DataBase;

function activateApiPlugin()
{
    Base\Activate::activate()->runActivation();
}
register_activation_hook(__FILE__, "activateApiPlugin");


function deactivateApiPlugin()
{
    Base\Deactivate::deactivate();
}
register_activation_hook(__FILE__, "deactivateApiPlugin");

function uninstallApiPlugin()
{
    Base\Uninstall::uninstall();
}
register_uninstall_hook(__FILE__, "uninstallApiPlugin");

if (isset($_POST['save'])) {
    DataBase::save($_POST);
}


if (isset($_POST['reload'])) {
    DataBase::reload($_POST);
}
if (class_exists('WP_CLI')) {
    WP_CLI::add_command('wds', 'API_CLI');
}
Admin\Init::register_services();
