<?php


class View {
    private $view_name;
    public static $suffix = ".akaino.php";
    private $root_directory = "View/";

    public function __construct($view_name="404"){
        $this->view_name = $view_name;
    }

    public function getView(){
        $view_path = $this->root_directory . $this->view_name . self::$suffix;
        if(file_exists($view_path)) $data_content = file_get_contents($view_path);
        else $data_content = file_get_contents($this->root_directory . '404' . self::$suffix);
        return $this->replaceIncludes($data_content);
    }

    public function replaceRoutes($data_content){
        $content_parts = explode('[[', $data_content);
        $routes = [];
        for($i = 1;$i<count($content_parts);$i++){
            $route = trim(explode(']]', trim($content_parts[$i]))[0]);
            $route_parts = explode("('", $route);
            if($route_parts[0] == 'route'){
                $route_name = str_replace("')", "", $route_parts[1]);
                array_push($routes, $route_name);
                $del_route = trim(str_replace("route('$route_name')", "", trim($content_parts[$i])));
                $content_parts[$i] = str_replace("]]", "", $del_route);
            }
        }

        $cleared_parts = [$content_parts[0]];
        for($i = 1;$i<count($content_parts);$i++){
            $pos = strpos($content_parts[$i], "\"");
            array_push($cleared_parts,  substr($content_parts[$i], $pos));
        }

        $data_content = $content_parts[0];
        for($i = 1;$i<count($content_parts);$i++){
            $data_content .= "?route=" . $routes[$i-1] . $content_parts[$i];
        }

        return $data_content;
    }

    public function replaceIncludes($data_content){
        if(! is_numeric(strpos($data_content, "@include"))) return $this->replaceRoutes($data_content);
        $data_content = $this->replaceRoutes($data_content);
        $content_parts = explode("@include('", $data_content);
        for($i=1; $i < count($content_parts); $i++){
            $route_name = trim(explode("')", $content_parts[$i])[0]);
            $this->setViewName($route_name);
            $content_parts[$i] = str_replace("$route_name')", $this->getView(), $content_parts[$i]);
        }

        return implode("", $content_parts);
    }

    /**
     * @return string
     */
    public function getViewName()
    {
        return $this->view_name;
    }

    /**
     * @param string $view_name
     */
    public function setViewName($view_name)
    {
        $this->view_name = $view_name;
    }

    /**
     * @return string
     */
    public static function getSuffix()
    {
        return self::$suffix;
    }

    /**
     * @param string $suffix
     */
    public static function setSuffix($suffix)
    {
        self::$suffix = $suffix;
    }

    /**
     * @return string
     */
    public function getRootDirectory()
    {
        return $this->root_directory;
    }

    /**
     * @param string $root_directory
     */
    public function setRootDirectory($root_directory)
    {
        $this->root_directory = $root_directory;
    }

}