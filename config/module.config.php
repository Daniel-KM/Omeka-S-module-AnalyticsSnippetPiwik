<?php
namespace AnalyticsSnippetPiwik;

return [
    'form_elements' => [
        'invokables' => [
            Form\ConfigForm::class => Form\ConfigForm::class,
        ],
    ],
    'analyticssnippet' => [
        'trackers' => [
            'default' => Tracker\Piwik::class,
        ],
    ],
    'analyticssnippetpiwik' => [
        'config' => [
            'analyticssnippetpiwik_tracker_url' => '',
            'analyticssnippetpiwik_site_id' => '',
            'analyticssnippetpiwik_token_auth' => '',
        ],
    ],
];
