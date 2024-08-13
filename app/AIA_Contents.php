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
            'aia_openai_api_key' => [
                'title' => __('OpenAI API Key', AIA_DOMAIN)
            ],
            'aia_undetectableai_api_key' => [
                'title' => __('UndetectableAI API Key', AIA_DOMAIN)
            ],
        ];
    }
}