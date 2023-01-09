<?php declare(strict_types=1);

namespace AnalyticsSnippetPiwik\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class SettingsFieldset extends Fieldset
{
    protected $label = 'Analytics Snippet Matomo (Piwik)'; // @translate

    protected $elementGroups = [
        'analytics' => 'Analytics', // @translate
    ];

    public function init(): void
    {
        $this
            ->setAttribute('id', 'analytics-snippet-matomo')
            ->setOption('element_groups', $this->elementGroups)
            ->add([
                'name' => 'analyticssnippetpiwik_tracker_url',
                'type' => Element\Text::class,
                'options' => [
                    'element_group' => 'analytics',
                    'label' => 'Matomo tracker api url', // @translate
                ],
                'attributes' => [
                    'placeholder' => 'https://stats.example.com/matomo.php',
                ],
            ])
            ->add([
                'name' => 'analyticssnippetpiwik_site_id',
                'type' => Element\Text::class,
                'options' => [
                    'element_group' => 'analytics',
                    'label' => 'Matomo site id', // @translate
                ],
                'attributes' => [
                    'placeholder' => '1',
                ],
            ])
            ->add([
                'name' => 'analyticssnippetpiwik_token_auth',
                'type' => Element\Text::class,
                'options' => [
                    'element_group' => 'analytics',
                    'label' => 'Matomo token authentication', // @translate
                    'info' => 'API token with at least Admin permission in order to save visitor ip. See https://matomo.org/faq/general/faq_114/', // @translate
                ],
                'attributes' => [
                    'placeholder' => '4fbb1496d7b563acbfe08a6f07a061c5',
                ],
            ])
        ;
    }
}
