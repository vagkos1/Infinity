<?php


namespace Infinity\Utils;


class StringUtils
{
    /**
     * http://stackoverflow.com/a/5253800/2526181
     *
     * @return bool
     */
    public static function stringEndsWith($whole, $end)
    {
        return (@strpos($whole, $end, strlen($whole) - strlen($end)) !== false);
    }
}