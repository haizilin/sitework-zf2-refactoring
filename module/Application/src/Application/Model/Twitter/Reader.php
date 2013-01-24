<?php
/**
 * class reader provides funktions
 * to request data from twitter
 */
namespace Application\Twitter;
use ZendOAuth\Consumer;
use ZendService\Twitter\Twitter;
use Zend\Session\Container;

class Reader {

    // container to store token for re-using
    private $_session = null;

    // vars to configure limits
    private static $_MAX_CONNECT_FAIL = 3;
    private static $_MAX_REQUEST_FAIL = 3;

    private static $_DEFAULT_REQUEST_OPTION_PAGE = 1;
    private static $_DEFAULT_REQUEST_OPTION_COUNT = 10;

    private $_connectFailCounter = 0;
    private $_requestFailCounter = 0;

    // vars that are required  for request/connect actions
    private $_connectOptions = null;
    private $_reqConnectOptions = array('callbackUrl', 'siteUrl', 'consumerKey', 'consumerSecret', 'sslcapath');

    private $_requestOptions = null;
    private $_reqRequestOptions = array('screen_name');

    private $_connection = null;
    private $_consumer = null;
    private $_token = null;

    // container to store requested data
    private $_response = null;

    public function __construct($connectOptions = array(), $requestOptions = array(), $run = false) {

        $this->_setupToken();
        $this->_setupOptions($connectOptions, $requestOptions);

        // run on construction was requested
        if ($run === true) {
            try {
                return $this->run();
            } catch (\Exception $e) {
                return false;
            }
        }

        return $this;
    }

    /**
     * start connecting to twitter and to request data
     * Keep attention on limits!
     * @return bool
     */
    public function run() {

        if (!$this->isConnectable()) {
            return false;
        }

        // try to connect for max. number of fails
        while (!$this->isConnected() && $this->_connectFailCounter <= self::$_MAX_CONNECT_FAIL) {
            try {
                $this->connect();
            } catch (\Exception $e) {
                $this->_connectFailCounter++;
            }
        }

        // connection couldn't be established
        if (!$this->isConnected()) {
            return false;
        }

        // try to request data for max. number of fails
        while (empty($this->_response) && $this->_requestFailCounter <= self::$_MAX_REQUEST_FAIL) {
            try {
                $this->_requestData();
            } catch (\Exception $e) {
                $this->_requestFailCounter++;
            }
        }

        // return success indicator
        return !empty($this->_response);
    }

    /**
     * connect to Twitter,
     * this requires to create a consumer and the connection to the twitter api
     * @throws \Exception
     */
    public function connect() {

        // create a valid consumer
        $this->_consumer = new Consumer($this->_connectOptions);
        if (!empty($this->_consumer)) {
            $this->_consumer->getHttpClient()->setOptions($this->_connectOptions['sslcapath']);
        }

        // guarantee a valid token
        if (empty($this->_token)) {
            $this->_token = $this->_consumer->getRequestToken();
        }

        if (!empty($this->_token)) {
            $this->_session->offsetSet('token', serialize($this->_token));
            $this->_connectOptions['accessToken'] = $this->_token;
            $this->_connection = new Twitter($this->_connectOptions, $this->_consumer);
        }

        if (!$this->isConnected()) {
            throw new \Exception('Connection to Twitter failed for ' . $this->_connectFailCounter . ' times.');
        }
    }

    /**
     * check if all requirements ok to connect Twitter
     * @return bool
     */
    public function isConnectable() {
        return ( !empty($this->_connectOptions) && $this->_connectFailCounter <= self::$_MAX_CONNECT_FAIL );
    }

    /**
     * check if connection to Twitter is already established
     * @return bool
     */
    public function isConnected() {
        return ( !empty($this->_connection) && !empty($this->_requestOptions) );
    }


    /**
     * select API method depending on available options and request data from Twitter API
     */
    private function _requestData() {
        if (!empty($this->_requestOptions['screen_name'])) {
            $this->_response = $this->_connection->statusUserTimeline($this->_requestOptions);
        } else {
            $this->_response = $this->_connection->statusPublicTimeline($this->_requestOptions);
        }
    }

    /**
     * setup token
     * get cached token from session, if available
     */
    private function _setupToken() {
        $this->_session = new Container('twitter');
        if ($this->_session->offsetExists('token')) {
            $this->_token = unserialize($this->_session->offsetGet('token'));
        }
    }

    /**
     * check options and set defaults, if required     *
     * @param $connectOptions
     * @param $requestOptions
     */
    private function _setupOptions($connectOptions = array(), $requestOptions = array()) {

        // reset options
        $this->_connectOptions = null;
        $this->_requestOptions = null;

        // check requirements and set options to connect
        if (array_intersect(array_keys($connectOptions), $this->_reqConnectOptions) == count($this->_reqConnectOptions)) {
            $this->_connectOptions = $connectOptions;
        }

        // check requirements and set options to request data
        if (array_intersect(array_keys($requestOptions), $this->_reqRequestOptions) < count($this->_reqRequestOptions)) {
            $this->_requestOptions = $requestOptions;
        }

        // set defaults for optional parameters to request data
        if (is_array($this->_requestOptions) && !array_key_exists('page', (array) $this->_requestOptions)) {
            $this->_requestOptions['page'] = self::$_DEFAULT_REQUEST_OPTION_PAGE;
        }

        if (is_array($this->_requestOptions) && !array_key_exists('count', (array) $this->_requestOptions)) {
            $this->_requestOptions['count'] = self::$_DEFAULT_REQUEST_OPTION_COUNT;
        }
    }
}
