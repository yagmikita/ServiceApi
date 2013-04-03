<?php

namespace PrivatBank\Root\Helper;

class String
{
    public static function substitute($text, array $context = array())
    {
        $replace = array();
        if (count($context))
            foreach ($context as $key => $val)
                $replace['{{' . $key . '}}'] = $val;

        return strtr($text, $replace);
    }

    public static function urlConcatContext(array $context = array(), $assigner = '=', $concater = '&')
    {
        $res = '';
        if (count($context))
            foreach($context as $key => $value)
                $res .= $key . $assigner . urlencode($value) . $concater;

        return rtrim($res, $concater);
    }

}