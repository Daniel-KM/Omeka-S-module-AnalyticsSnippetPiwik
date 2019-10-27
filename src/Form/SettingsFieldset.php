<?php
namespace AnalyticsSnippetPiwik\Form;

use Zend\Form\Element;
use Zend\Form\Fieldset;

class SettingsFieldset extends Fieldset
{
    protected $label = 'Analytics Snippet Piwik / Matomo'; // @translate

    public function init()
    {
        $this
            ->add([
                'name' => 'analyticssnippetpiwik_tracker_url',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Piwik tracker api url', // @translate
                ],
                'attributes' => [
                    'placeholder' => 'https://stats.example.com/piwik.php',
                ],
            ])
            ->add([
                'name' => 'analyticssnippetpiwik_site_id',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Piwik site id', // @translate
                ],
                'attributes' => [
                    'placeholder' => '1',
                ],
            ])
            ->add([
                'name' => 'analyticssnippetpiwik_token_auth',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Piwik token authentication', // @translate
                    'info' => 'API token with at least Admin permission in order to save visitor ip. See https://piwik.org/faq/general/faq_114/', // @translate
                ],
                'attributes' => [
                    'placeholder' => '4fbb1496d7b563acbfe08a6f07a061c5',
                ],
            ])
        ;
    }
}
