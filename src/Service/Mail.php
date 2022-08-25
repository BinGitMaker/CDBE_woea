<?php

namespace App\Service;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = 'e19b3d751f75d0260086f78743976364';
    private $api_key_secret = 'ac561b273f7b3a341fd8ede7c4b106ea';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "sandrine.bienetre@outlook.fr",
                        'Name' => "Sandrine - Bien-Être"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4150134,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}