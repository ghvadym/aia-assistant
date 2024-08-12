<?php


class AIA_Ajax
{
    static function init()
    {
        $names = [
            'ai_prompt'
        ];

        foreach ($names as $name) {
            add_action("wp_ajax_$name", [self::class, $name]);
        }
    }

    static function ai_prompt()
    {
        if (empty($_POST)) {
            wp_send_json_error('There is no post data.');
            return;
        }

        $data = sanitize_post($_POST);
    }
}