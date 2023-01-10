<?php

namespace Admin;

use Admin\Controller;


class Enqueue extends Controller
{

    public function run()
    {
        add_filter('admin_enqueue_scripts', array($this, 'registerStyles'));
    }

    public function registerStyles()
    {
        wp_enqueue_style('style', "$this->plugin_url/src/css/style.css");
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js');
        wp_enqueue_script('jqueryUI', 'https://code.jquery.com/ui/1.13.1/jquery-ui.min.js');
        wp_enqueue_script('mainJS', "$this->plugin_url/src/js/main.js");
    }
}
