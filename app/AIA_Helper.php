<?php


class AIA_Helper
{
    /**
     * Return the path to file into the plugin
     * @param string $fileName
     * @return string
     */
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

    /**
     * Return the array of conditions for the select field Point Of View
     * @return array
     */
    static function point_of_view_list(): array
    {
        return [
            'first-person'  => __('First Person (I, me, mine, we, us, our)', AIA_DOMAIN),
            'second-person' => __('Second Person (you, your, yours)', AIA_DOMAIN),
            'third-person'  => __('Third Person (he, she, they)', AIA_DOMAIN)
        ];
    }

    /**
     * Return the list of languages for the select field Languages
     * @return string[]
     */
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

    /**
     * Return field from options table by key
     * @param string $key
     * @return mixed|null
     */
    static function get_field(string $key = '')
    {
        if (!$key) {
            return null;
        }

        $settings = get_option(AIA_OPTIONS_KEY);

        return $settings[$key] ?? null;
    }

    /**
     * Check if Gutenberg is active.
     * Must be used not earlier than plugins_loaded action fired.
     *
     * @return bool
     */
    static function is_gutenberg_active(): bool
    {
        $gutenberg = false;
        $block_editor = false;

        if (has_filter('replace_editor', 'gutenberg_init')) {
            /* Gutenberg is installed and activated */
            $gutenberg = true;
        }

        if (version_compare($GLOBALS['wp_version'], '5.0-beta', '>')) {
            /* Block editor */
            $block_editor = true;
        }

        if (!$gutenberg && !$block_editor) {
            return false;
        }

        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        if (!is_plugin_active('classic-editor/classic-editor.php')) {
            return true;
        }

        return get_option('classic-editor-replace') === 'block';
    }

    /**
     * Return the list of all custom post types names
     * @return array
     */
    static function post_types(): array
    {
        $defaultPostTypes = ['post', 'page'];

        $customPostTypes = get_post_types([
            'public'   => true,
            '_builtin' => false
        ]);

        $postTypes = array_merge($defaultPostTypes, $customPostTypes);

        return array_values($postTypes);
    }

    /**
     * Return the list of taxonomies names
     * @return array
     */
    static function taxonomies(): array
    {
        $taxonomies = [];
        $exclude = [
            'post_format'
        ];

        foreach (self::post_types() as $postType) {
            $taxonomies = array_merge($taxonomies, get_object_taxonomies($postType));
        }

        /* Remove system taxonomies from the list */
        foreach ($taxonomies as $taxonomy) {
            if (in_array($taxonomy, $exclude)) {
                unset($taxonomies[array_search($taxonomy, $taxonomies)]);
            }
        }

        return $taxonomies;
    }
}