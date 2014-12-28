<?php namespace LC;

use ReflectionClass;

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
            'doc' => $this->getMethodDoc($method),
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

    public function getMethodDoc($method)
    {
        // strip comment characters
        $formatted_doc = str_replace(['/**', '*', '/'], '', $method->getDocComment());

        // @return
        $return_part = explode('@return', $formatted_doc);
        $return = count($return_part) == 1 ? 'void' : trim(end($return_part));

        // @throw
        $throw = false;
        if(strpos($return, '@throws') !== false)
        {
            $throw_part = explode('@throws', $return);
            $throw = trim(end($throw_part));
            // reset return
            $return = $throw_part[0];
        }

        // @param
        $param_parts = explode('@param', $return_part[0]);
        $desc = $param_parts[0];
        $params = array_slice($param_parts, 1);

        return compact('desc', 'params', 'return', 'throw');

    }

}