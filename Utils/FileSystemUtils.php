<?php


namespace Infinity\Utils;


class FileSystemUtils
{
    /**
     * @param $name
     */
    private static function folderCreate($name)
    {
        mkdir($name, 0700);
    }

    /**
     * @param $name
     * 
     * @return bool
     */
    public static function folderExists($name) {
        return file_exists($name);
    }

    /**
     * @param $fileName
     * 
     * @return bool
     */
    public static function isCSVFile($fileName)
    {
        return StringUtils::stringEndsWith($fileName, '.csv');
    }

    /**
     * Move a file to a new folder and delete it from it's previous location
     * 
     * @param $filename
     * @param $origin
     * @param $destination
     */
    public static function fileMove($filename, $origin, $destination)
    {
        $prev = $origin . '/' . $filename;
        $new = $destination . '/' . $filename;
        
        try {
            if (!self::folderExists($destination)) {
                self::folderCreate($destination);
            }

            if (copy($prev, $new)) {
                unlink($prev);
            } 
        } 
        catch (\Exception $e) {
            die("Cannot move the file");
        }
    }
}