<?php



class AIA_Undetectable_API
{
    static function makeTextUndetectable($text)
    {
        if (empty($text)) {
            return null;
        }

        $apiKey = get_field('undetectableai_api_key', 'options');

        if (empty($apiKey)) {
            return null;
        }

        try {
            $response = api_request([
                'method'    => 'POST',
                'curl_url'  => 'https://api.undetectable.ai/submit',
                'headers'   => [
                    'Content-Type: application/json',
                    "api-key: $apiKey"
                ],
                'data' => [
                    'content'    => $text,
                    'readability'=> "Journalist",
                    'purpose'    => "General Writing",
                    'strength'   => "More Human"
                ]
            ]);

            if (empty($response->id)) {
                return null;
            }

            $uniqueTextResponse = null;

            while (empty($uniqueTextResponse)) {
                sleep(2);

                $checkResponse = api_request([
                    'method'    => 'POST',
                    'curl_url'  => 'https://api.undetectable.ai/document',
                    'headers'   => [
                        'Content-Type: application/json',
                        "api-key: 1721729181930x813884018359923200"
                    ],
                    'data' => [
                        'id'   => $response->id
                    ]
                ]);

                if ($checkResponse->status === 'done') {
                    $uniqueTextResponse = $checkResponse->output ?? null;
                }
            }

            return $uniqueTextResponse;
        } catch (Exception $e) {
            wp_send_json([
                'error'       => true,
                'message'     => __('Something went wrong, try again', DOMAIN),
                'message_dev' => 'Error during text processing in undetectable.ai: ' . $e->getMessage()
            ]);

            return false;
        }
    }
}