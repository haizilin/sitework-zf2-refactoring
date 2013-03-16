<?php
/**
 * class reader provides functions to connect to Twitter using ZendService\Twitter
 * and provide requested timeline data as Collection
 */
namespace Application\Model\Twitter;

use Zend\Session\Container;
use ZendOAuth\Consumer;
use ZendService\Twitter;

class Connection {

    private $_requiredConnectionOptions = array('callbackUrl', 'siteUrl', 'consumerKey', 'consumerSecret');
    private $_options = null;
    private $_consumer = null;
    private $_connection = null;

    public function __construct($options = array()) {

        if ($this->_options !== $options) {
            $this->_connection = null;
        }

        if (empty($this->_connection)) {
            try {
                $this->_connection = $this->_connect($options);
            } catch (\Exception $e) {
                return null;
            }
        }
    }

    public function statusUserTimeline($options = array()) {
        if (!empty($this->_connection)) {
            return $this->_connection->statusUserTimeline($options);
        }
        return '';
    }

    /**
     * connect to Twitter,
     * this requires to create a consumer and the connection to the twitter api
     * @throws \Exception
     */
    private function _connect($options) {

        // normalize options
        if (!$this->_normalizeOptions($options)) {
            throw new \Exception(
                'Required options not found. Please provide "' . implode(', ', $this->_requiredConnectionOptions) . '"'
            );
        }

        // create oAuth consumer
        $this->_consumer = new Consumer($this->_options);
        if (is_null($this->_consumer)) {
            throw new \Exception(
                'Could not create twitter consumer. Please check provided options'
            );
        }

        if (array_key_exists('sslcapath', (array) $this->_options)) {
            $this->_consumer->getHttpClient()->setOptions($this->_options);
        }

        // connect to twitter
        $options = $this->_options;

        $options['accessToken'] = $this->_getAccessToken(true);
        try {
            $connection = new Twitter\Twitter($options, $this->_consumer);
        } catch (\Exception $e) {
            \Zend\Debug\Debug::dump($e->getMessage());
            \Zend\Debug\Debug::dump($this->_consumer);
        }


        if (!empty($connection)) {
            return $connection;
        }

        // on fail try to connect with a new requested AccessToken
        $options['accessToken'] = $this->_getAccessToken(false);
        $connection = new Twitter\Twitter($options, $this->_consumer);

        return $connection;
    }

    // create accessToken
    private function _getAccessToken($useCache = true) {

        $session = new Container('twitter');

        if ($session->offsetExists('token') && $useCache == true) {
            $token = unserialize($session->offsetGet('token'));
        } else {
            $token = $this->_consumer->getRequestToken();
        }

        if ($token instanceof \ZendOAuth\Token\Access) {
            $session->offsetSet('token', serialize($token));
            return $token;
        }

        return null;
    }

    // normalize user provided options
    private function _normalizeOptions($options = array()) {

        // reset options
        $this->_options = null;

        // check requirements and set options to request data
        $tmpOptions = array();

        foreach ($this->_requiredConnectionOptions as $requiredOptionKey) {
            if (!empty($options[$requiredOptionKey])) {
                $tmpOptions[$requiredOptionKey] = $options[$requiredOptionKey];
            } else {
                return false;
            }
        }

        // add additional options
        foreach ($options as $k => $option) {
            if (!array_key_exists($k, $tmpOptions)) {
                $tmpOptions[$k] = $option;
            }
        }

        $this->_options = $tmpOptions;

        return true;
    }
}
