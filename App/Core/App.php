<?php

namespace App;

class App
{
    // set default value for controller, action and param
    protected $_controller = 'index';
    protected $_action = 'show';
    protected $_param = null;

    //Routing process
    public function __construct()
    {
        //Role
        $role = isset($_GET['role']) ? $_GET['role'] : 'users';

        //Controllers
        /**
         * Check if controller exist
         */
        if (file_exists('App/Controllers/' . $role . '/' . $_GET['controller'] . 'controller.php')) {
            $this->_controller = $_GET['controller'] . 'controller';
        }
        require_once 'App/Controllers/'.$role.'/'. $this->_controller . '.php';

        $this->_controller = new $this->_controller;

        // //Action
        // /**
        //  * Check if action exist in controller
        //  */
        if (method_exists($this->_controller, $_GET['action'])) {
            $this->_action = $_GET['action'];
        }
        // echo $this->_action;
        // //Param
        $this->_param = $this->_paramProcess();
        // echo $this->_param;
        // //exceute url
        call_user_func_array([$this->_controller, $this->_action], $this->_param);
    }

    //param type -> array
    protected function _paramProcess()
    {
        /**
         * Check if param exist in url
         */
        if (isset($_GET['param'])) {
            return explode("/", filter_var(trim($_GET['param'])));
        }

        return [];
    }

    protected function _roleDefine(): string
    {
        if (isset($_GET['role'])) {
            return $_GET['role'];
        }

        return 'users';
    }
}
