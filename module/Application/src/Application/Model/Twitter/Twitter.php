<?php
/**
 * class reader provides functions to connect to Twitter using ZendService\Twitter
 * and provide requested timeline data as Collection
 */
namespace Application\Model\Twitter;

use Zend\Cache;
use Zend\Http\Request;
use Zend\Stdlib\Parameters;
use Zend\Http\Client;

class Twitter
{
    private $_statusUserTimelineUrl = 'http://api.twitter.com/1/statuses/user_timeline.json';
    private $_statusUserTimelineFallback = null;
    private $_cache = null;

    public function __construct($config = array()) {
        if (array_key_exists('cache', $config)) {
            $this->_cache = $config['cache'];
        }
    }

    public function statusUserTimeline($screenName, $page = 1, $count = 10) {
        $cached = false;
        if (!is_null($this->_cache)) {
            $response = $this->_cache->getItem('statusUserTimeline', $cached);
        }

        if (empty($cached) && !empty($this->_statusUserTimelineUrl) && !empty($screenName)) {
            $request = new Request();
            $request->setUri($this->_statusUserTimelineUrl);
            $request->setQuery(new Parameters(array(
                'screen_name' => $screenName,
                'page' => $page,
                'count' => $count
            )));
            $client = new Client();
            $client->setAdapter('Zend\Http\Client\Adapter\Curl');
            $response = $client->send($request)->getBody();
            $this->_cache->setItem('statusUserTimeline', $response);
        }

        if (empty($response) && !empty($this->_statusUserTimelineFallback) && is_file($this->_statusUserTimelineFallback)) {
            $response = @file_get_contents($this->_statusUserTimelineFallback);
        }

        return $response;
    }
}
