<?php


class AIA_Helper
{
    static function get_path(string $fileName): string
    {
        if (!$fileName) {
            return '';
        }

        $pathToFile = AIA_PLUGIN_DIR . "{$fileName}.php";

        if (!file_exists($pathToFile)) {
            return '';
        }

        return $pathToFile;
    }
}