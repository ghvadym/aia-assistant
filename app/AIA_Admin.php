<?php


class AIA_Admin
{
    static function init()
    {
        add_action('admin_enqueue_scripts', [self::class, 'admin_enqueue_scripts_call']);
        add_action('add_meta_boxes', [self::class, 'register_meta_boxes']);
        add_action('edit_form_after_title', [self::class, 'edit_form_after_title_call']);
    }

    static function admin_enqueue_scripts_call()
    {
        wp_enqueue_style('aia-custom-styles', FV_THEME_URL . '/dest/css/admin-styles.css');
        wp_enqueue_script('aia-custom-scripts', FV_THEME_URL . '/dest/js/admin-scripts.js');

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
}