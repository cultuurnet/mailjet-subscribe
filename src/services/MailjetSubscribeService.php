<?php

namespace publiq\mailjetsubscribe\services;

use Craft;
use craft\base\Component;
use publiq\mailjetsubscribe\MailjetSubscribe as Plugin;
use Mailjet\Client;
use Mailjet\Resources;

class MailjetSubscribeService extends Component
{
    protected mixed $mailJet;

    protected mixed $settings;

    protected function initMailjetApi(): array
    {
        $this->settings = Plugin::getInstance()->getSettings();

        if ($this->settings->apiKeyPublic === '') {
            return [
                'success' => false,
                'message' => 'MailJet API Key Public not supplied. Check your settings.'
            ];
        }

        if ($this->settings->apiKeyPrivate === '') {
            return [
                'success' => false,
                'message' => 'MailJet API Key Private not supplied. Check your settings.'
            ];
        }

        if ($this->settings->listId === '') {
            return [
                'success' => false,
                'message' => 'MailJet List ID not supplied. Check your settings.'
            ];
        }

        $this->mailJet = new Client($this->settings->apiKeyPublic, $this->settings->apiKeyPrivate);
    }

    public function subscribe($emailAddress, $formListId, $contentProperties = null): array
    {
        $this->initMailjetApi();

        $body = [
            'Email' => $emailAddress,
            'Action' => 'addforce'
        ];

        // the casing used by the MailJet API causes Warnings
        // @codingStandardsIgnoreStart
        $response = $this->mailJet->post(
            Resources::$ContactslistManagecontact,
            ['id' => $formListId, 'body' => $body]
        );

        if ($contentProperties) {
            $contactID = $response->getBody()['Data'][0]['ContactID'];

            $properties = [];
            foreach ($contentProperties as $prop => $value) {
                $properties[] = [
                    'Name' => $prop,
                    'Value' => $value
                ];
            }

            $response = $this->mailJet->put(Resources::$Contactdata, array(
                'id' => $contactID,
                'body' => ['Data' => $properties]
            ));

        }

        if ($response->success())
            return [
                'success' => true,
                'message' => Craft::t('mailjet-subscribe', 'Email address added successfully')
            ];
        else {
            return [
                'success' => false,
                'message' => Craft::t('mailjet-subscribe', 'Email address was not added')
            ];
        }
    }
}