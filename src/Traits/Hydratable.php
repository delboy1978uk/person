<?php
namespace Del\Traits;

use DateTime;


trait Hydratable
{

    /**
     * @param array $data
     */
    public function __construct(array $data = []) {
        if(!empty($data)) {
            $this->setFromArray($data);
        }
    }

    /**
     * @param array $array
     * @return $this
     */
    public function setFromArray(array $array)
    {
        foreach ($array as $key => $val) {
            $this->processKeyAndValue($key, $val);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $methods = get_class_methods(get_class($this));
        return $this->processMethods($methods);
    }

    /**
     * @param $key
     * @param $val
     */
    public function processKeyAndValue($key, $val)
    {
        $method = $this->findSetter($key);
        if ($this->methodExists($method)) {
            $this->setValue($method, $val);
        }
    }

    /**
     * @param $key
     * @return string
     */
    private function findSetter($key)
    {
        if (strstr($key, '_')) {
            $key = $this->convertUnderscoredKey($key);
        }
        return 'set' . ucwords($key);
    }

    /**
     * @param string $key
     * @return string
     */
    private function convertUnderscoredKey($key)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
    }

    /**
     * @param $method
     * @return bool
     */
    private function methodExists($method)
    {
        return method_exists($this, $method);
    }


    /**
     * @param string $method
     * @param mixed $val @todo - identify what $mixed should be ?
     */
    private function setValue($method, $val)
    {
        if ($val instanceof DateTime) {
            $val = (string) $val->format('Y-m-d H:i:s');
        }
        $this->$method($val);
    }

    /**
     * @param array $methods
     * @return array
     */
    private function processMethods(array $methods)
    {
        $array = [];
        foreach ($methods as $method) {
            $this->processMethod($method, $array);
        }
        return $array;
    }

    /**
     * @param $method
     * @param $array
     */
    private function processMethod($method, &$array)
    {
        if (substr($method, 0, 3) == 'get') {
            $val = $this->$method();
            $val = $val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val;
            $key = $this->processKeyName($method);
            $array[$key] = $val;
        }
    }

    /**
     * @param string $method
     * @return string
     */
    private function processKeyName($method)
    {
        return strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/', "_$1", substr($method, 3)));
    }
}