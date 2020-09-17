<?php

// Main Controller
// As a bridge to connect DB to view
class Controller
{
    public function model($model)
    {
        require_once 'App/Model/' . $model . '.php';
        return new $model;
    }

    public function view($view, $folder, $data = [])
    {
        require_once 'resources/view/' . $folder . $view . '.php';
    }
}
