<?php


class AIA_Contents
{
    /**
     * Fields for the main settings page
     * @return array
     */
    static function settings_api_keys_data(): array
    {
        return [
            'openai_api_key' => [
                'title' => __('OpenAI API Key', AIA_DOMAIN)
            ],
            'undetectableai_api_key' => [
                'title' => __('UndetectableAI API Key', AIA_DOMAIN)
            ]
        ];
    }
}