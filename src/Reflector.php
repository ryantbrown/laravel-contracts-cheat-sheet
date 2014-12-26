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

    public function getMethodData()
    {
        $methods = [];

        foreach($this->getMethods() as $method)
        {
            $methods[] = [
                'name' => $this->getMethodName($method),
                'doc' => $this->getMethodDoc($method),
                'param_info' => $this->getMethodParamInfo($method)
            ];
        }

        return $methods;
    }

    public function getParamsInfo($params)
    {
        $param_array = [];

        foreach($params as $param)
        {
            $param_array[] = $this->getParamInfo($param);
        }

        return $param_array;
    }

    public function getParamInfo($param)
    {
        return [
            'name' => $param->getName(),
            'position' => $param->getPosition(),
            'allows_null' => $param->allowsNull(),
            'is_array' => $param->isArray(),
            'is_callable' => $param->isCallable(),
            'is_optional' => $param->isOptional(),
        ];
    }

    public function getMethodParamInfo($method)
    {
        return [
            'total' => $method->getNumberOfParameters(),
            'params' => $this->getParamsInfo($method->getParameters())
        ];
    }

}