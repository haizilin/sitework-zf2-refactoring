<?php
/**
 * class reader provides functions to connect to Twitter using ZendService\Twitter
 * and provide requested timeline data as Collection
 */
namespace Application\Model\Twitter;

use Zend\Cache;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Http\Client\Exception;

class Twitter {

    private $_options = null;

    private $_statusUserTimelineFallback = null;
    private $_statusUserTimelineUrl = 'https://api.twitter.com/1/statuses/user_timeline.json';

    private $_cache = null;

    const CACHE_TTL = 100;

    public function __construct($options = array()) {
        $this->_options = $options;
        $this->_cache = Cache\StorageFactory::factory(array(
            'adapter' => array(
                'name' => 'filesystem',
                'namespaceIsPrefix' => true,
            ),
            'plugins' => array(
                // Don't throw exceptions on cache errors
                'exception_handler' => array(
                    'throw_exceptions' => false
                ),
            )
        ));
    }

    public function statusUserTimeline($screenName, $page = 1, $count = 10) {
        $response = $this->_cache->getItem('statusUserTimeline', $cached);
        if (!$cached && !empty($this->_statusUserTimelineUrl) && !empty($screenName)) {
            $url = $this->_statusUserTimelineUrl
                . '?screen_name=' . $screenName
                . '&page=' . $page
                . '&count=' . $count;
            $response = @file_get_contents($url);
            $this->_cache->setItem('statusUserTimeline', $response);
        }

        if (!$response && !empty($this->_statusUserTimelineFallback) && is_file($this->_statusUserTimelineFallback)) {
            $response = @file_get_contents($this->_statusUserTimelineFallback);
        }

        return $response;
    }
}
