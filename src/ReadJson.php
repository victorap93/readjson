<?php

namespace Victorap93;

class ReadJson{

    private $path = "";
    private $json_str = null;
    private $default_indexes = [];

    function __construct($path = "") {
        if(!empty($path))
            $this->set_path($path);
    }

    public function set_path($path)
    {
        if(is_file($path) && pathinfo($path)["extension"] == "json")
            if(file_exists($path)){
                $this->path = str_replace(['\\', '/', '\\\\', '//', '\\/', '\\/\\/'], DIRECTORY_SEPARATOR, $path);
                $json_file = file_get_contents($this->path);
                $this->json_str = json_decode($json_file, true);            
            }else
                throw new Exception("File not found.");
        else
            throw new Exception("Not a json file.");
    }

    public function get_path()
    {
        return $this->path;
    }

    public function set_default_index()
    {
        $this->default_indexes = func_get_args();
    }
    
    public function get_default_index()
    {
        return $this->default_indexes;
    }

    public function get_json_str()
    {
        $json_str = $this->get_default_json_str();
        $indexes = func_get_args();
        return $this->access_recursive_index($json_str, $indexes);
    }

    private function get_default_json_str()
    {
        return $this->access_recursive_index($this->json_str, $this->default_indexes);
    }

    private function access_recursive_index($json_str, $indexes)
    {
        foreach($indexes as $index){
            if(array_key_exists($index, $json_str))
                $json_str = $json_str[$index];
            else
                throw new Exception("Index does not exist in json.");
        }
        return $json_str;
    }    
}
