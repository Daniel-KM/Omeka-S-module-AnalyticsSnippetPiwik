<?php declare(strict_types=1);

namespace AnalyticsSnippetPiwik;

// Load the module dependencies when installed as a zip.
// With composer, libraries are stored in omeka vendor/ and the module has none.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Common may be installed but not registered in autoloader, in particular
// during upgrade. So dynamically register all classes of the module.
if (!defined('COMMON_PSR4_FALLBACK')) {
    foreach ([
        OMEKA_PATH . '/modules/Common/src',
        OMEKA_PATH . '/composer-addons/modules/Common/src',
        dirname(__DIR__) . '/Common/src',
    ] as $commonSrc) {
        if (file_exists($commonSrc . '/TraitModule.php')) {
            define('COMMON_PSR4_FALLBACK', $commonSrc);
            spl_autoload_register(static function ($class): void {
                if (str_starts_with($class, 'Common\\')) {
                    $file = COMMON_PSR4_FALLBACK . '/' . strtr(substr($class, 7), '\\', '/') . '.php';
                    if (file_exists($file)) {
                        require_once $file;
                    }
                }
            });
            break;
        }
    }
}

use Common\Stdlib\PsrMessage;
use Common\TraitModule;
use Laminas\View\Renderer\PhpRenderer;
use Omeka\Module\AbstractModule;

/**
 * AnalyticsSnippetPiwik
 *
 * Submodule for Analytics Snippet to track json (in particular Omeka S API) and
 * xml (like with OAI-PMH Repository) calls with Piwik.
 *
 * @copyright Daniel Berthereau, 2017-2023
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2.1-en.txt
 */
class Module extends AbstractModule
{
    use TraitModule;

    const NAMESPACE = __NAMESPACE__;

    public function getConfigForm(PhpRenderer $renderer)
    {
        $services = $this->getServiceLocator();
        $settings = $services->get('Omeka\Settings');
        // Without token, Matomo ignores the ip sent by the server and records
        // the ip of the server for all the visits.
        if (!$settings->get('analyticssnippetpiwik_token_auth')) {
            $services->get('ControllerPluginManager')->get('messenger')->addWarning(new PsrMessage(
                'No token is set: Matomo ignores the ip of the visitors sent by the server and records the ip of the server for all the visits tracked server side (api, xml, etc.). Set a token with at least the permission "Admin" on the site in Matomo.' // @translate
            ));
        }
        return $this->getConfigFormAuto($renderer);
    }

    protected function preInstall(): void
    {
        $services = $this->getServiceLocator();
        $plugins = $services->get('ControllerPluginManager');
        $translator = $services->get('MvcTranslator');

        if (!method_exists($this, 'checkModuleActiveVersion') || !$this->checkModuleActiveVersion('Common', '3.4.94')) {
            $message = new \Omeka\Stdlib\Message(
                $translator->translate('The module %1$s should be upgraded to version %2$s or later.'), // @translate
                'Common', '3.4.94'
            );
            throw new \Omeka\Module\Exception\ModuleCannotInstallException((string) $message);
        }
    }
}
