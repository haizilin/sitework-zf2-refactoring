<?php
/**
 * class tweet provides a container
 * to handle tweet data from a twitter timeline
 */
namespace Application\Model\Twitter;

class Tweet {

    private $_id = null;
    private $_createdAt = null;
    private $_text = null;
    private $_source = null;
    private $_isTruncated = false;
    private $_inReplyToTweetId = null;
    private $_inReplyToUserId = null;
    private $_inReplyToScreenName = null;

    public function __construct($values = array()) {
        $this->setValues($values);
    }

    public function setValue($name, $value) {
        $this->setvalues(array($name => $value));
    }


    public function setValues($values = array()) {

        if (!is_array($values)) {
            return;
        }

        foreach ($values as $k => $v) {

            switch ($k) {
                case 'created_at' :
                case 'createdAt' :
                    $this->setCreatedAt($v); break;
                case 'text' :
                    $this->setText($v); break;
                case 'id' :
                    $this->setId($v); break;
                case 'source' :
                    $this->setSource($v); break;
                case 'truncated' :
                    $this->setIsTruncated($v); break;
                case 'in_reply_to_status_id' :
                case 'inReplyToTweetId' :
                    $this->setInReplyToTweetId($v); break;
                case 'in_reply_to_user_id' :
                case 'inReplyToUserId' :
                    $this->setInReplyToUserId($v); break;
                case 'in_reply_to_screen_name' :
                case 'inReplyToScreenName' :
                    $this->setInReplyToScreenName($v); break;
                default : continue;
            }
        }
        return;
    }

    public function setCreatedAt($createdAt) {
        $this->_createdAt = $createdAt;
    }

    public function getCreatedAt() {
        return $this->_createdAt;
    }

    public function setInReplyToScreenName($inReplyToScreenName) {
        $this->_inReplyToScreenName = $inReplyToScreenName;
    }

    public function getInReplyToScreenName() {
        return $this->_inReplyToScreenName;
    }

    public function setInReplyToTweetId($inReplyToTweetId) {
        $this->_inReplyToTweetId = $inReplyToTweetId;
    }

    public function getInReplyToTweetId() {
        return $this->_inReplyToTweetId;
    }

    public function setInReplyToUserId($inReplyToUserId) {
        $this->_inReplyToUserId = $inReplyToUserId;
    }

    public function getInReplyToUserId() {
        return $this->_inReplyToUserId;
    }

    public function setIsTruncated($isTruncated) {
        $this->_isTruncated = $isTruncated;
    }

    public function getIsTruncated() {
        return $this->_isTruncated;
    }

    public function setSource($source) {
        $this->_source = $source;
    }

    public function getSource() {
        return $this->_source;
    }

    public function setText($text) {
        $this->_text = $text;
    }

    public function getText() {
        return $this->_text;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getId() {
        return $this->_id;
    }
}
