<?php

namespace ABA;

class Model
{
    private $value = [];

    public function __call($name, $arguments)
    {

        $nameMethod = substr($name, 0, 3);
        $fieldName = substr($name, 3, strlen($name));

        switch ($nameMethod) {
            case "get":
                return (isset($this->value[$fieldName])) ? $this->value[$fieldName] : NULL;
            break;
            case "set":
                $this->value[$fieldName] = $arguments[0];
            break;
        }

    }

    public function setData($data = array())
    {

        foreach ($data as $key => $value) {

            $this->{"set" . $key}($value);

        }

    }

    public function getValues()
    {
        return $this->value;
    }

}

?>