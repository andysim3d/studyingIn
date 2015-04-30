<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_Model_User_Relation_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_relation";

	//C
	private function create_relation($user_relation) {

		$row = $this->createRow();
		foreach ($user_relation as $key => $value) {
			$row[$key] = $value;
		}
		$row['follow_since'] = date("Y-m-d H:i:s", time());

		try {
			$row->save();
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	//R
	private function get_relation($where) {

		try {
			$row = $this->fetchAll($where);
		} catch (Exception $e) {
			return false;
		}
		return $row;
	}

	//D
	private function delete_relation($where) {

		try {
			$row = $this->delete($where);
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * create a new relation
	 *
	 * @param array
	 * @return bool
	 */
	public function create_new_relation($following_id, $follower_id) {

		if ($following_id != $follower_id) {
			$user_relation = array('following_id' => $following_id,
				'follower_id' => $follower_id);
			return $this->create_relation($user_relation);
		} else {
			return false;
		}

	}

	/**
	 * get count of the user's following
	 *
	 * @param int: follower's id
	 * @return int
	 */
	public function get_count_of_user_following($follower_id) {

		$where = $this->getAdapter()->quoteInto('follower_id =?', $follower_id);

		return count($this->get_relation($where));
	}

	/**
	 * get count of the user's follower
	 *
	 * @param int: following's id
	 * @return int
	 */
	public function get_count_of_user_follower($following_id) {

		$where = $this->getAdapter()->quoteInto('following_id =?', $following_id);

		return count($this->get_relation($where));
	}

	/**
	 * get user's following
	 *
	 * @param int:follower's id
	 * @return $row/null
	 */
	public function get_user_following($follower_id) {

		$where = $this->getAdapter()->quoteInto('follower_id =?', $follower_id);

		return $this->get_relation($where);
	}

	/**
	 * get user's follower
	 *
	 * @param int:follower's id
	 * @return $row/null
	 */
	public function get_user_follower($following_id) {

		$where = $this->getAdapter()->quoteInto('following_id =?', $following_id);

		return $this->get_relation($where);
	}

	/**
	 * check if following
	 *
	 * @param int 1: following_id
	 * @param int 2: follower_id
	 * @return bool
	 */
	public function check_if_following($following_id, $follower_id) {

		$where = $this->getAdapter()->quoteInto('following_id =?', $following_id) .
		$this->getAdapter()->quoteInto(' AND follower_id =?', $follower_id);
		$res = $this->get_relation($where);
		if (count($res) != 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * delete user's by relation_id
	 *
	 * @param relation_id
	 * @return bool
	 */
	public function delete_relation_by_id($relation_id) {

		$where = $this->getAdapter()->quoteInto('relation_id =?', $relation_id);
		return $this->delete_relation($where);

	}

	/**
	 * delete user's by following_id & follower_id
	 *
	 * @param int 1: following_id
	 * @param int 2: follower_id
	 * @return bool
	 */
	public function delete_relation_by_both_id($following_id, $follower_id) {

		$res = $this->check_if_following($following_id, $follower_id);
		if ($res) {
			$where = $this->getAdapter()->quoteInto('following_id =?', $following_id) .
			$this->getAdapter()->quoteInto(' AND follower_id =?', $follower_id);

			return $this->delete_relation($where);
		} else {
			return true;

		}
	}

}