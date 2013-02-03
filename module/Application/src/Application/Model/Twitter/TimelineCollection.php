<?php
/**
 * class tweet provides a container
 * to handle a collections of tweets and users
 * fetched from a twitter timeline
 */
namespace Application\Model\Twitter;

use Zend\Config\Reader\Xml;
use Zend\Json as Json;

class TimelineCollection {

    private $_data = null;
    private $_tweetIndex = array();
    private $_userIndex = array();
    private $_errors = array();
    private $_availableParser = array('array', 'json', 'xml');

    public function __construct($response = null, $format = null) {

        $this->_data = new \stdClass();
        $this->_data->tweets = array();
        $this->_data->users = array();

        if (empty($response) || !in_array($format, $this->_availableParser) ) {
            return false;
        }

        $parsedResponse = $this->_parseResponse($response, $format);
        if (empty($parsedResponse)) {
            return false;
        }

        return $this->_buldCollection($parsedResponse);
    }

    /**
     * get all collected data
     * @return mixed
     */
    public function getCollection() {
        return $this->_data;
    }

    /**
     * get all collected tweets
     * @param int $a
     * @param int $b
     * @return mixed
     */
    public function getTweets($a = 0, $b = 8) {
        if ($b > 0 && $a < count($this->_data->tweets)) {
            $res = array_slice($this->_data->tweets, $a, $b);
        } else {
            $res =  $this->_data->tweets;
        }
        return$res;
    }

    /**
     * get all collected users
     * @return mixed
     */
    public function getUsers() {
        return $this->_data->users;
    }

    /**
     * get all tweetIds by a given userId
     * @param $userId
     * @return array or null
     */
    public function getUserTweetIds($userId = null) {
        if (empty($userId)) {
            return null;
        }
        return $this->_userIndex[$userId];
    }

    /**
     * get userId of a given tweetId
     * @param $tweetId
     * @return int or null
     */
    public function getTweetUserId($tweetId = null) {
        if (empty($tweetId)) {
            return null;
        }
        return $this->_tweetIndex[$tweetId];
    }

    /**
     * parse response to extract data from different formats
     * @param $response
     * @param $format
     * @return bool
     */
    private function _parseResponse($response = null, $format = null) {

        $parsedResponse = array();

        // prevent interrupt parsing, caused by format vaults
        try {
            switch ($format) {
                case 'xml' :
                    $obj = new Xml();
                    $parsedResponse = (Array) $obj->fromString($response);
                    break;
                case 'json' :
                    $parsedResponse = (Array) Json\Decoder::decode($response, Json\Json::TYPE_ARRAY);
                    break;
                case 'array' :
                    $parsedResponse = $response;
                    break;
            }
        } catch (\Exception $e) {
            array_push($this->_errors, $e->getMessage());
            return false;
        }
        if (is_array($parsedResponse) && array_key_exists('status', $parsedResponse)) {
            $parsedResponse = $parsedResponse['status'];
        }
        return $parsedResponse;
    }

    /**
     * create assoc. arrays for tweetIndex and userIndex
     * and put user and tweet objects to collection data
     *
     * @param $parsedResponse
     * @return bool
     */
    private function _buldCollection($parsedResponse = null) {

        // check requirements
        if (!is_array($parsedResponse)) {
            return false;
        }

        // run operation for each row
        foreach ($parsedResponse as $row) {

            // reset tmp vars
            $user = null;
            $userId = null;
            $tweet = null;
            $tweetId = null;

            // don't get data from incomplete rows
            if (!array_key_exists('user', $row)) {
                continue;
            }

            // create user and check success
            $user = new User($row['user']);
            $userId = $user->getId();
            if (empty($userId)) {
                continue;
            }

            // create tweet and check success
            $tweet = new Tweet($row);
            $tweetId = $tweet->getId();
            if (empty($tweetId)) {
                continue;
            }

            // write data to collection
            $this->_data->tweets[$tweetId] = $tweet;
            $this->_data->users[$userId] = $user;

            // prepare index of tweetIds on userId
            if (!array_key_exists($userId, $this->_userIndex)) {
                $this->_userIndex[$userId] = array();
            }

            // add entry to index of tweetIds on userId and userId on tweetId
            array_push($this->_userIndex[$userId], $tweetId);
            $this->_tweetIndex[$tweetId] = $userId;
        }

        // return success of operation
        return (count($this->_tweetIndex) > 0 && count($this->_userIndex) > 0);
    }
}
