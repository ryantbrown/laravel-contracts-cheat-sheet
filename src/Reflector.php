<?php namespace LC;

use ReflectionClass;

class Reflector {

    protected $class;

    public function __construct($class_path)
    {
        $this->class = new ReflectionClass($class_path);
    }

    public function getConstants()
    {
        return $this->class->getConstants();
    }

    public function getMethods()
    {
        return $this->class->getMethods();
    }

    public function getMethodName($method)
    {
        return $method->getName();
    }

    public function getMethodDoc($method)
    {
        return str_replace(['/**', '*', '/'], '', $method->getDocComment());
    }

    public function getMethodParamInfo($method)
    {
        return [
            'total' => $method->getNumberOfParameters(),
            'params' => $method->getParameters()
        ];
    }

    public function getParamInfo($param)
    {
        return [
            'name' => $param->getName(),
            'position' => $param->getPosition(),
            'allows_null' => $param->allowsNull(),
            //'default_value' => $param->getDefaultValue(),
            'is_array' => $param->isArray(),
            'is_callable' => $param->isCallable(),
            'is_optional' => $param->isOptional(),
        ];
    }

}