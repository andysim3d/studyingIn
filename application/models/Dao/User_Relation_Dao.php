<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_Model_User_Relation_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_relation";

	/**
	 * create a relation
	 *
	 * @param array
	 * @return bool
	 */
	public function create_user_relation($user_relation) {

		$row = $this->createRow();

		if (count($user_relation) > 0) {

			foreach ($user_relation as $key => $value) {
				$row->$key = $value;
			}

			$row->save();
			return true;

		} else {
			return false;
		}
	}

	/**
	 * get user's relation
	 *
	 * @param array
	 * @return $row/null
	 */
	private function get_user_relation($where) {
		//echo "string";
		//print_r($where);
		$select = $this->select();
		if (count($where) > 0) {
			foreach ($where as $key => $value) {
				$select->where($key . '=?', $value);
			}
		}
		$row = $this->fetchAll($select);

		if ($row) {
			return $row;
		} else {
			return null;
		}
	}

	/**
	 * get user's following
	 *
	 * @param follower's id
	 * @return $row/null
	 */
	public function get_user_following($follower_id) {

		$where = array('follower_id' => $follower_id);

		return $this->get_user_relation($where);
	}

	/**
	 * get user's follower
	 *
	 * @param follower's id
	 * @return $row/null
	 */
	public function get_user_follower($following_id) {

		$where = array('following_id' => $following_id);

		return $this->get_user_relation($where);
	}

	/**
	 * delete user's album
	 *
	 * @param relation_id/array('following_id'=>1,'folower_id'=>2);
	 * @return bool
	 */
	public function delete_relation($where) {

		$where_cluster;
		if (is_numeric($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('relation_id =?', $where);
		}

		if (is_array($where)) {
			if (count($where) > 0) {
				foreach ($where as $key => $value) {
					$where_cluster[$key . '=?'] = $value;
				}
			}
		}

		$row = $this->delete($where_cluster);
		if ($row) {
			return true;
		} else {
			return false;
		}

	}

}