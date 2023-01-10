<?php

namespace Admin;

use Admin\Controller;

class AdminSettings extends Controller
{

    public $page;

    /**
     * Calls admin hook to register side menu
     */
    public function run()
    {
        add_action('admin_menu', array($this, 'addAdminMenu'));
    }


    /**
     * Adds menu item to side bar
     */
    public function addAdminMenu()
    {
        $this->page = array(
            'page_title' => __("Api"),
            'menu_title' => __("Api Table"),
            'capability' => 'manage_options',
            'menu_slug' => 'api_plugin',
            'callback' => function () {
                return require_once "$this->plugin_path/views/index.php";
            },
            'icon_url' => 'dashicons-editor-table',
            'position' => 110
        );
        add_menu_page($this->page['page_title'], $this->page['menu_title'], $this->page['capability'], $this->page['menu_slug'], $this->page['callback'], $this->page['icon_url'], $this->page['position']);
    }
}
