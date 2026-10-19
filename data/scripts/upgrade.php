<?php declare(strict_types=1);

namespace AnalyticsSnippetPiwik;

use Common\Stdlib\PsrMessage;

/**
 * @var Module $this
 * @var \Laminas\ServiceManager\ServiceLocatorInterface $services
 * @var string $newVersion
 * @var string $oldVersion
 *
 * @var \Omeka\Settings\Settings $settings
 * @var \Laminas\I18n\View\Helper\Translate $translate
 * @var \Omeka\Mvc\Controller\Plugin\Messenger $messenger
 */
$plugins = $services->get('ControllerPluginManager');
$settings = $services->get('Omeka\Settings');
$translate = $plugins->get('translate');
$messenger = $plugins->get('messenger');

if (!method_exists($this, 'checkModuleActiveVersion') || !$this->checkModuleActiveVersion('Common', '3.4.94')) {
    $message = new \Omeka\Stdlib\Message(
        $translate('The module %1$s should be upgraded to version %2$s or later.'), // @translate
        'Common', '3.4.94'
    );
    $messenger->addError($message);
    throw new \Omeka\Module\Exception\ModuleCannotInstallException((string) $translate('Missing requirement. Unable to upgrade.')); // @translate
}

if (!$this->checkModuleActiveVersion('AnalyticsSnippet', '3.4.7')) {
    $message = new \Omeka\Stdlib\Message(
        $translate('The module %1$s should be upgraded to version %2$s or later.'), // @translate
        'Analytics Snippet', '3.4.7'
    );
    $messenger->addError($message);
    throw new \Omeka\Module\Exception\ModuleCannotInstallException((string) $translate('Missing requirement. Unable to upgrade.')); // @translate
}

if (version_compare($oldVersion, '3.4.9', '<')) {
    $message = new PsrMessage(
        'The params of Matomo (tracker url, site id and token) were moved from the main settings to the config of the module.' // @translate
    );
    $messenger->addNotice($message);
}

if (version_compare($oldVersion, '3.4.10', '<')) {
    $message = new PsrMessage(
        'The ip of the visitors sent to Matomo is now resolved behind the trusted reverse proxies set in the main settings (module Analytics Snippet), else Matomo receives the ip of the proxy for all visitors. A level of privacy can be applied too. The ip is recorded by Matomo only with a token.' // @translate
    );
    $messenger->addWarning($message);
}

if (!$settings->get('analyticssnippetpiwik_token_auth')) {
    $message = new PsrMessage(
        'No token is set: Matomo ignores the ip of the visitors sent by the server and records the ip of the server for all the visits tracked server side (api, xml, etc.). Set a token with at least the permission "Admin" on the site in Matomo.' // @translate
    );
    $messenger->addWarning($message);
}
