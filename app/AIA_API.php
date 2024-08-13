<?php

require_once(AIA_PLUGIN_DIR . 'app/API/AIA_OpenAI_API.php');
require_once(AIA_PLUGIN_DIR . 'app/API/AIA_Undetectable_API.php');

class AIA_API
{
    static function init() {}

    static function ai_assistant_request($data = [])
    {
        if (empty($data)) {
            return false;
        }

        $question = $data['topic'];
        $keywords = $data['keywords'] ?? '';
        $lang = $data['lang'] ?? 'en';
        $wordCount = $data['words'] ?? 75;
        $toneOfVoice = $data['voice'] ?? '';
        $pointOfView = $data['point_of_view'] ?? '';

        $pointsOfViewList = AIA_Helper::point_of_view_list();
        $languagesList = AIA_Helper::languages_list();
        $langName = $languagesList[$lang] ?? 'English';

        $fullQuestion = "Question: $question".PHP_EOL;

        if ($keywords) {
            $fullQuestion .= "Keywords: $keywords".PHP_EOL;
        }
        if ($toneOfVoice) {
            $fullQuestion .= "Tone of voice: $toneOfVoice".PHP_EOL;
        }
        if ($pointOfView || !empty($pointsOfViewList)) {
            $pointOfView = $pointsOfViewList[$pointOfView] ?? '';
            if ($pointOfView) {
                $fullQuestion .= "Point of view: $pointOfView".PHP_EOL;
            }
        }

        $fullQuestion .= "Language: $langName".PHP_EOL;
        $fullQuestion .= "Word count: $wordCount".PHP_EOL;
        $fullQuestion .= PHP_EOL."Please provide an answer based on the information above.";

        try {
            $finalAnswer = '';

            $answer = AIA_OpenAI_API::generateAnswer($fullQuestion);

            if ($answer) {
                $finalAnswer = $answer;
            }

            $textUndetectable = AIA_Undetectable_API::makeTextUndetectable($answer);

            if ($textUndetectable) {
                $finalAnswer = $textUndetectable;
            }

            $finalText = AIA_OpenAI_API::changeTextWithOpenAI($textUndetectable, $question, $keywords);

            if ($finalText) {
                $finalAnswer = $finalText;
            }

            return $finalAnswer;
        } catch (Exception $e) {
            wp_send_json([
                'error'       => true,
                'message'     => __('Something went wrong, try again', DOMAIN),
                'message_dev' => 'An error occurred during text generation or processing: ' . $e->getMessage(),
            ]);

            return false;
        }
    }
}