<?php namespace LC\Translators;

class DocTranslator {

    public static function getMethodDoc($doc)
    {
        return
            self::getParamPart(
                self::getThrowPart(
                    self::getReturnPart(
                        self::formatDoc($doc)
                    )
                )
            );
    }

    private static function formatDoc($doc)
    {
        return str_replace(['/**', '*', '/'], '', $doc);
    }

    private static function getReturnPart($doc)
    {
        $parts['doc'] = explode('@return', $doc);

        $parts['return'] = count($parts['doc']) == 1 ? 'void' : trim(end($parts['doc']));

        return $parts;
    }

    private static function getThrowPart(Array $parts)
    {
        if(strpos($parts['return'], '@throws') !== false)
        {
            $throw = explode('@throws', $parts['return']);

            $parts['throw'] = trim(end($throw));

            $parts['return'] = $throw[0];
        }

        return $parts;
    }

    private static function getParamPart(Array $parts)
    {
        $param = explode('@param', $parts['doc'][0]);

        $parts['desc'] = $param[0];

        $parts['params'] = array_slice($param, 1);

        return $parts;
    }

}