<?php

use TYPO3\CMS\Core\Utility\GeneralUtility;

class tx_mmforum_topic extends tx_mmforum_data {

	protected $table = 'tx_mmforum_topics';

	public function getTitle() {
		return $this->gD('topic_title');
	}

	public function getTime() {
		return $this->gD('topic_time');
	}

	public function getViews() {
		return $this->gD('topic_views');
	}

	public function getReplies() {
		return $this->gD('topic_replies');
	}

	public function getPrefix() {
		return $this->gD('topic_is');
	}

	public function getAuthor() {
		return $this->obj_user_author ? $this->obj_user_author : $this->obj_user_author = tx_mmforum_user::getUserByID($this->gD('topic_poster'));
	}

	public function getForum() {
		return $this->obj_forum_parent ? $this->obj_forum_parent : $this->obj_forum_parent = tx_mmforum_forum::getForumByID($this->gD('forum_id'));
	}

	public function isClosed() {
		return $this->gD('closed_flag') ? true : false;
	}

	public function isSolved() {
		return $this->gD('solved') ? true : false;
	}

	protected function setSolveStatus($status = 1) {
	}

	static function getTopicByID($uid) {
		if (intval($uid) === 0) {
			return null;
		}

		$topic = GeneralUtility::makeInstance('tx_mmforum_topic'); /* @var $topic tx_mmforum_topic */
		$topic->initFromDB($uid);

		return $topic;
	}
}
