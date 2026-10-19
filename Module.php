<?php declare(strict_types=1);

namespace AnalyticsSnippetPiwik;

// Load the module dependencies when installed as a zip.
// With composer, libraries are stored in omeka vendor/ and the module has none.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if (!trait_exists(\Common\TraitModule::class, false)) {
    if (file_exists(OMEKA_PATH . '/modules/Common/src/TraitModule.php')) {
        require_once OMEKA_PATH . '/modules/Common/src/TraitModule.php';
    } elseif (file_exists(OMEKA_PATH . '/composer-addons/modules/Common/src/TraitModule.php')) {
        require_once OMEKA_PATH . '/composer-addons/modules/Common/src/TraitModule.php';
    } elseif (file_exists(dirname(__DIR__) . '/Common/src/TraitModule.php')) {
        require_once dirname(__DIR__) . '/Common/src/TraitModule.php';
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

        if (!method_exists($this, 'checkModuleActiveVersion') || !$this->checkModuleActiveVersion('Common', '3.4.88')) {
            $message = new \Omeka\Stdlib\Message(
                $translator->translate('The module %1$s should be upgraded to version %2$s or later.'), // @translate
                'Common', '3.4.88'
            );
            throw new \Omeka\Module\Exception\ModuleCannotInstallException((string) $message);
        }
    }
}
