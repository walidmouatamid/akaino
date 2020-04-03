<?php


class Redirect {

    private $view_name;

    public function __construct($view_name="404")
    {
        $this->view_name = $view_name;
    }

    public function go(){
        return (new View($this->view_name))->getView();
    }

}