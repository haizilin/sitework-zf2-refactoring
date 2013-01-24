<?php
/**
 * class user provides a container
 * to handle user data from a twitter timeline
 */
namespace Application\Model\Twitter;

class User
{
    private $_id = null;
    private $_realName = null;
    private $_screenName = null;
    private $_description = null;
    private $_location = null;
    private $_createdAt = null;

    private $_friendsCount = null;
    private $_followersCount = null;
    private $_tweetCount = null;

    private $_pictureHttp = null;
    private $_pictureHttps = null;
    private $_url = null;
    private $_lang = null;

    /**
     * create and setup user objects
     * @param array $values
     */
    public function __construct($values = array()) {
        $this->setValues($values);
    }

    /**
     * set a single value
     * @param $name
     * @param $value
     */
    public function setValue($name, $value) {
        $this->setvalues(array($name => $value));
    }

    /**
     * set provided values
     * @param array $values
     */
    public function setValues($values = array()) {

        if (!is_array($values)) {
            return;
        }

        foreach ($values as $k => $v) {
            switch ($k) {
                case 'id' :
                    $this->setId($v); break;
                case 'name' :
                    $this->setRealName($v); break;
                case 'screen_name' :
                    $this->setScreenName($v); break;
                case 'description' :
                    $this->setDescription($v); break;
                case 'location' :
                    $this->setLocation($v); break;
                case 'friends_count' :
                    $this->setFriendsCount($v); break;
                case 'followers_count' :
                    $this->setFollowersCount($v);  break;
                case 'statuses_count' :
                    $this->setTweetCount($v); break;
                case 'profile_image_url' :
                    $this->setPictureHttp($v); break;
                case 'profile_image_url_https' :
                    $this->setPictureHttps($v);  break;
                case 'url' :
                    $this->setUrl($v); break;
                case 'lang' :
                    $this->setLang($v); break;
                case 'created_at' :
                    $this->setCreatedAt($v); break;
            }
        }
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getId() {
        return $this->_id;
    }

    public function setDescription($description) {
        $this->_description = $description;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function setFollowersCount($followersCount) {
        $this->_followersCount = $followersCount;
    }

    public function getFollowersCount() {
        return $this->_followersCount;
    }

    public function setFriendsCount($friendsCount) {
        $this->_friendsCount = $friendsCount;
    }

    public function getFriendsCount() {
        return $this->_friendsCount;
    }

    public function setPictureHttp($pictureHttp) {
        $this->_pictureHttp = $pictureHttp;
    }

    public function getPictureHttp() {
        return $this->_pictureHttp;
    }

    public function setPictureHttps($pictureHttps) {
        $this->_pictureHttps = $pictureHttps;
    }

    public function getPictureHttps() {
        return $this->_pictureHttps;
    }

    public function setRealName($realName) {
        $this->_realName = $realName;
    }

    public function getRealName() {
        return $this->_realName;
    }

    public function setScreenName($screenName) {
        $this->_screenName = $screenName;
    }

    public function getScreenName() {
        return $this->_screenName;
    }

    public function setTweetCount($tweetCount) {
        $this->_tweetCount = $tweetCount;
    }

    public function setUrl($url) {
        $this->_url = $url;
    }

    public function getUrl() {
        return $this->_url;
    }

    public function setLocation($userLocation) {
        $this->_location = $userLocation;
    }

    public function getLocation() {
        return $this->_location;
    }

    public function setCreatedAt($createdAt) {
        $this->_createdAt = $createdAt;
    }

    public function getCreatedAt() {
        return $this->_createdAt;
    }

    public function setLang($lang) {
        $this->_lang = $lang;
    }

    public function getLang() {
        return $this->_lang;
    }
}
