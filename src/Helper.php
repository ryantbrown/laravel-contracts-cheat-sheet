<?php namespace LC;

class Helper {

    public static function getConfig($key)
    {
        $config = require __DIR__.'/../config/paths.php';

        return isset($config[$key]) ? $config[$key] : null;
    }

    public static function getReflector($group, $file)
    {
        return new Reflector(Helper::getClassNamespace($group, $file));
    }

    public static function getClassDataAttribute($group, $file)
    {
        return strtolower($group.'-'.$file);
    }

    public static function getGroupNamespace($group)
    {
        return 'Illuminate\Contracts\\' . $group . '\\';
    }

    public static function getClassName($class)
    {
        return str_replace('.php', '', $class);
    }

    public static function getClassNamespace($group, $class)
    {
        return self::getGroupNamespace($group).self::getClassName($class);
    }

    public static function getContracts()
    {
        $contracts = [];

        $iterator = new Iterator(self::getConfig('contracts'));

        foreach($iterator->getFolderIterators($iterator->getFolders()) as $folder => $folder_iterator)
        {
            $contracts[$folder] = $iterator->getFolderClasses($folder_iterator);
        }

        return $contracts;
    }

}