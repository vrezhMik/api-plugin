<?php

namespace Admin;

class Controller
{
    public $plugin_url;
    public $plugin_path;

    public function __construct()
    {
        $this->plugin_url = dirname(plugin_dir_url(__FILE__), 1);
        $this->plugin_path = dirname(plugin_dir_path(__FILE__), 1);
    }
}
