<?php
namespace AnalyticsSnippetPiwik\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;

class ConfigForm extends Form
{
    public function init()
    {
        $this->setAttribute('id', 'config-form');

        $this->add([
            'name' => 'analyticssnippetpiwik_tracker_url',
            'type' => Text::class,
            'options' => [
                'label' => 'Piwik tracker api url', // @translate
            ],
            'attributes' => [
                'placeholder' => 'https://stats.example.com/piwik.php',
            ],
        ]);

        $this->add([
            'name' => 'analyticssnippetpiwik_site_id',
            'type' => Text::class,
            'options' => [
                'label' => 'Piwik site id', // @translate
            ],
            'attributes' => [
                'placeholder' => '1',
            ],
        ]);

        $this->add([
            'name' => 'analyticssnippetpiwik_token_auth',
            'type' => Text::class,
            'options' => [
                'label' => 'Piwik token authentication', // @translate
                'info' => 'API token with at least Admin permission in order to save visitor ip. See https://piwik.org/faq/general/faq_114/', // @translate
            ],
            'attributes' => [
                'placeholder' => '4fbb1496d7b563acbfe08a6f07a061c5',
            ],
        ]);
    }
}
