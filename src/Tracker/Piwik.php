<?php
namespace AnalyticsSnippetPiwik\Tracker;

use AnalyticsSnippet\Tracker\AbstractTracker;
use PiwikTracker;
use Zend\EventManager\Event;

class Piwik extends AbstractTracker
{
    /**
     * @link https://piwik.org/docs/tracking-api
     */
    protected function trackNotInlineScript($url, $type, Event $event)
    {
        $settings = $this->services->get('Omeka\Settings');
        $siteId = $settings->get('analyticssnippetpiwik_site_id');
        $trackerUrl = $settings->get('analyticssnippetpiwik_tracker_url');
        if (empty($siteId) || empty($trackerUrl)) {
            return;
        }

        $piwikTracker = new PiwikTracker($siteId, $trackerUrl);

        $piwikTracker->setUrl($url);
        $piwikTracker->setUrlReferrer($this->getUrlReferrer());
        $piwikTracker->setIp($this->getClientIp());
        $piwikTracker->setUserAgent($this->getUserAgent());
        $piwikTracker->setCustomTrackingParameter('user_id', $this->getUserId());

        // Specify an API token with at least Admin permission, so the Visitor
        // IP address can be recorded
        // Learn more about token_auth: https://piwik.org/faq/general/faq_114/
        $tokenAuth = $settings->get('analyticssnippetpiwik_token_auth');
        if ($tokenAuth) {
            $piwikTracker->setTokenAuth($tokenAuth);
        }

        // You can manually set the visitor details (resolution, time, plugins,
        // etc.)
        // See all other ->set* functions available in the PiwikTracker.php file
        // $piwikTracker->setResolution(1600, 1400);

        // Sends Tracker request via http
        $piwikTracker->doTrackPageView($type);

        // Tracks an event
        // $piwikTracker->doTrackEvent($category, $action, $name, $value);

        // Tracks an internal Site Search query, and optionally tracks the
        // Search Category, and Search results Count.
        // $piwikTracker->doTrackSiteSearch($keyword, $category, $countResults);

        // Tracks a download or outlink
        // $piwikTracker->doTrackAction($actionUrl, $actionType);

        // You can also track Goal conversions
        // $piwikTracker->doTrackGoal($idGoal = 1, $revenue = 42);
    }

    protected function trackError($url, $type, Event $event)
    {
        $this->trackNotInlineScript($url, 'error', $event);
    }
}
