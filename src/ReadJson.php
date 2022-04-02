<?php

namespace victorap93;

class ReadJson
{
    private $json_object;

    public function __construct($json_path, $default_keys = [])
    {
        if (is_file($json_path) && file_exists($json_path)) {
            $json_object = $this->getJsonContent($json_path);
            $this->json_object = $this->accessRecursiveKeys($json_object, $default_keys);
        } else {
            throw new \Exception("Can't find \"$json_path\" file.");
        }
    }

    private function getJsonContent($json_path)
    {
        if ($json_object = json_decode(file_get_contents($json_path))) {
            return $json_object;
        } else {
            throw new \Exception("The file \"$json_path\" is not a valid json.");
        }
    }

    public function accessRecursiveKeys($json_object, $keys)
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $json_object)) {
                $json_object = is_array($json_object) ? $json_object[$key] : $json_object->$key;
            } else {
                throw new \Exception("Key \"$key\" does not exist in specified json position.");
            }
        }
        return $json_object;
    }

    public function getJsonObject($keys = [])
    {
        return $this->accessRecursiveKeys($this->json_object, $keys);
    }
}
