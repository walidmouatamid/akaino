<?php


class Router {
    protected $route;


    public function __construct()
    {
        if(isset($_GET['route']))
            $this->route = $_GET['route'];
        else
            $this->route = 'home';
    }

    public function handle(){
        return (new View($this->route))->getView();
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

}