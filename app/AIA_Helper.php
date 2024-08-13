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

    static function point_of_view_list(): array
    {
        return [
            'first-person'  => __('First Person (I, me, mine, we, us, our)', AIA_DOMAIN),
            'second-person' => __('Second Person (you, your, yours)', AIA_DOMAIN),
            'third-person'  => __('Third Person (he, she, they)', AIA_DOMAIN)
        ];
    }

    static function languages_list(): array
    {
        return [
            'en' => 'English',
            'fr' => 'French',
            'de' => 'German',
            'it' => 'Italian',
            'uk' => 'Ukrainian',
            'ar' => 'Arabic',
            'cs' => 'Czech',
            'da' => 'Danish',
            'es' => 'Spanish',
            'et' => 'Estonian',
            'hi' => 'Hindi',
            'hr' => 'Croatian',
            'hy' => 'Armenian',
            'id' => 'Indonesian',
            'ja' => 'Japanese',
            'ka' => 'Georgian',
            'ko' => 'Korean',
            'lt' => 'Lithuanian',
            'nl' => 'Dutch',
            'pl' => 'Polish',
            'pt' => 'Portuguese',
            'sk' => 'Slovak',
            'sv' => 'Swedish',
            'zh' => 'Chinese'
        ];
    }
}