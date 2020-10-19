<?php declare(strict_types=1);
namespace AnalyticsSnippetPiwik;

return [
    'form_elements' => [
        'invokables' => [
            Form\SettingsFieldset::class => Form\SettingsFieldset::class,
        ],
    ],
    'analyticssnippet' => [
        'trackers' => [
            'default' => Tracker\Matomo::class,
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
