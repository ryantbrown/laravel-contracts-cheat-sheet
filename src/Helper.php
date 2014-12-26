<?php namespace LC;

class Helper {

    const CONTRACTS_PATH = '../vendor/illuminate/contracts';
    const CONTRACTS_NAMESPACE = 'Illuminate\Contracts\\';
    const STATIC_CLASSES_PATH = '../public/classes/';

    private static function getContractsPath()
    {
        return __DIR__.'/'.self::CONTRACTS_PATH;
    }

    public static function getStaticClassesPath()
    {
        return __DIR__.'/'.self::STATIC_CLASSES_PATH;
    }

    public static function getReflector($group, $file)
    {
        return new Reflector(Helper::getClassNamespace($group, $file));
    }

    public static function getContracts()
    {
        $contracts = [];

        $iterator = new Iterator(self::getContractsPath());

        foreach($iterator->getFolderIterators($iterator->getFolders()) as $folder => $folder_iterator)
        {
            $contracts[$folder] = $iterator->getFolderClasses($folder_iterator);
        }

        return $contracts;
    }

    public static function getClassDataAttribute($group, $file)
    {
        return strtolower($group.'-'.$file);
    }

    public static function getGroupNamespace($group)
    {
        return self::CONTRACTS_NAMESPACE . $group . '\\';
    }

    public static function getClassName($class)
    {
        return str_replace('.php', '', $class);
    }

    public static function getClassNamespace($group, $class)
    {
        return self::getGroupNamespace($group).self::getClassName($class);
    }

}