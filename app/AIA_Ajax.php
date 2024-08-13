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
            wp_send_json([
                'error'   => true,
                'message' => __('There is no necessary data. Contact with developer.', AIA_DOMAIN)
            ]);

            return;
        }

        $data = sanitize_post($_POST);

        $question = $data['topic'] ?? '';

        if (!$question) {
            wp_send_json([
                'error'   => true,
                'message' => __('Topic is a necessary field.', AIA_DOMAIN)
            ]);

            return;
        }

        $answer = AIA_API::ai_assistant_request($data);

        if (!$answer) {
            wp_send_json([
                'error'   => true,
                'message' => __('There is no answer.', AIA_DOMAIN)
            ]);

            return;
        }

        wp_send_json([
            'success' => true,
            'answer'  => $answer
        ]);
    }
}