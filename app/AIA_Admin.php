<?php


class AIA_Admin
{
    static function init()
    {
        add_action('admin_enqueue_scripts', [self::class, 'admin_enqueue_scripts_call']);
        add_action('admin_menu', [self::class, 'admin_menu_call']);
        add_action('admin_init', [self::class, 'admin_init_call']);
        add_action('add_meta_boxes', [self::class, 'register_meta_boxes']);
        add_action('edit_form_after_title', [self::class, 'edit_form_after_title_call']);
        add_filter('plugin_action_links', [self::class, 'add_plugin_link'], 10, 2);
    }

    static function admin_enqueue_scripts_call()
    {
        wp_enqueue_style('aia-custom-styles', AIA_PLUGIN_URL . '/dest/css/admin-styles.css');
        wp_enqueue_script('aia-custom-scripts', AIA_PLUGIN_URL . '/dest/js/admin-scripts.js');

        wp_localize_script('aia-custom-scripts', 'aiajax', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('aia-nonce')
        ]);
    }

    static function register_meta_boxes()
    {
        add_meta_box(
            'aia-fields',
            __('AI Assistant', AIA_DOMAIN),
            [self::class, 'metabox_call'],
            'post',
            'advanced',
            'high'
        );
    }

    static function metabox_call()
    {
        include AIA_Helper::get_path('parts/aia-process');
    }

    static function edit_form_after_title_call()
    {
        global $post, $wp_meta_boxes;
        do_meta_boxes(get_current_screen(), 'advanced', $post);
        unset($wp_meta_boxes[get_post_type($post)]['advanced']);
    }

    static function add_plugin_link($plugin_actions, $plugin_file)
    {
        $new_actions = [];

        if ('ai-assistant/ai-assistant.php' === $plugin_file) {
            $new_actions['cl_settings'] = sprintf(__(
                '<a href="%s">Settings</a>', AIA_DOMAIN),
                esc_url(admin_url('options-general.php?page='.AIA_SETTING_PAGE))
            );
        }

        return array_merge($new_actions, $plugin_actions);
    }

    static function admin_menu_call()
    {
        add_submenu_page(
            'options-general.php',
            __('AI Assistant', DOMAIN),
            __('AI Assistant', DOMAIN),
            'manage_options',
            AIA_SETTING_PAGE,
            [self::class, 'options_page'],
        );
    }

    static function admin_init_call()
    {
        $apiKeysFields = AIA_Contents::settings_api_keys_data();

        /*$fields = array_merge($apiKeysFields);*/
        $fields = $apiKeysFields;

        if (empty($fields)) {
            return;
        }

        $settings = array_keys($fields);

        foreach ($settings as $setting) {
            register_setting(AIA_SETTINGS_FIELDS, $setting);
        }
    }

    static function options_page()
    {
        include AIA_Helper::get_path('parts/aia-options');
    }
}