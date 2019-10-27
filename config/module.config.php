<?php
namespace AnalyticsSnippetPiwik;

return [
    'form_elements' => [
        'invokables' => [
            Form\SettingsFieldset::class => Form\SettingsFieldset::class,
        ],
    ],
    'analyticssnippet' => [
        'trackers' => [
            'default' => Tracker\Piwik::class,
        ],
    ],
    'analyticssnippetpiwik' => [
        'settings' => [
            'analyticssnippetpiwik_tracker_url' => '',
            'analyticssnippetpiwik_site_id' => '',
            'analyticssnippetpiwik_token_auth' => '',
        ],
    ],
];
