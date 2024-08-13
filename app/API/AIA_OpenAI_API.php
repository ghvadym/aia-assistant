<?php
/* Uncomment if website does not have OpenAI library */
/* require_once(AIA_PLUGIN_DIR . 'app/lib/open-ai/vendor/autoload.php'); */

class AIA_OpenAI_API
{
    static function generateAnswer($fullQuestion)
    {
        if (empty($fullQuestion)) {
            return null;
        }

        $apiKey = AIA_Helper::get_field('openai_api_key');

        if (empty($apiKey)) {
            return null;
        }

        try {
            $client = OpenAI::client($apiKey);

            $messages = [
                ['role' => 'user', 'content' => $fullQuestion]
            ];

            $response = $client->chat()->create([
                'model'      => 'gpt-4o',
                'messages'   => $messages,
                'max_tokens' => 1024
            ]);

            return !empty($response['choices']) ? $response['choices'][0]['message']['content'] : null;
        } catch (Exception $e) {
            wp_send_json([
                'error'       => true,
                'message'     => __('Something went wrong, try again', DOMAIN),
                'message_dev' => 'Error during the First text processing in OpenAI: ' . $e->getMessage()
            ]);

            return false;
        }
    }

    static function changeTextWithOpenAI($text, $question, $keywords)
    {
        if (empty($text)) {
            return null;
        }

        $apiKey = AIA_Helper::get_field('openai_api_key');

        if (empty($apiKey)) {
            return null;
        }

        $prompt = "
Process the given answer text as follows: 1. Insert the exact keywords only once if they are not already present in the text. 2. Place the keywords as a single, unbroken phrase where most relevant in the text. 3. Do not separate the keywords with commas, spaces, or any other punctuation or words. 4. Do not change or remove any existing content in the text. 5. Replace <Name of model> with the actual model's name. 6. Insert the keywords only once, even if there are multiple relevant places. 7. Return only the modified answer text, without the question or any additional comments.

Question: $question
Keywords: $keywords

Answer text:
$text

Process the text and return only the modified version with keywords inserted as specified.    
";

        try {
            $client = OpenAI::client($apiKey);

            $response = $client->chat()->create([
                'model' => 'gpt-4o',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 1024
            ]);

            return !empty($response['choices']) ? $response['choices'][0]['message']['content'] : null;
        } catch (Exception $e) {
            wp_send_json([
                'error'       => true,
                'message'     => __('Something went wrong, try again', DOMAIN),
                'message_dev' => 'Error during the Last text processing in OpenAI: ' . $e->getMessage()
            ]);

            return false;
        }
    }
}