<?php namespace LC;

use ReflectionClass;
use LC\Translators\DocTranslator;

class Reflector {

    protected $class;

    public function __construct($class_path)
    {
        $this->class = new ReflectionClass($class_path);
    }

    public function getReflectionInstance()
    {
        return $this->class;
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

    public function getMethodData()
    {
        return array_map([$this, 'getMethodDataEntry'], $this->getMethods());
    }

    public function getParamsInfo($params)
    {
        return array_map([$this, 'getParamInfo'], $params);
    }

    protected function getMethodDataEntry($method)
    {
        return [
            'name' => $this->getMethodName($method),
            'doc' => DocTranslator::translate($method->getDocComment()),
            'param_info' => $this->getMethodParamInfo($method)
        ];
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