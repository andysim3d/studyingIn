<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_Model_User_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user";

	/**
	 * create a new user into database
	 *
	 * @param array
	 * @return user_id/false
	 */
	public function create_user($userData) {

		$row = $this->createRow();

		if (count($userData) > 0) {

			foreach ($userData as $key => $value) {
				$row->$key = $value;
			}

			$row->save();
			//print_r($row);
			return $row->user_id;

		} else {
			return false;
		}
	}

	/**
	 * get user from database
	 *
	 * @param int/array
	 * @return array/null
	 */
	public function get_user($where) {

		if (is_numeric($where)) {
			$row = $this->find($where)->current();
		}

		if (is_array($where)) {
			$select = $this->select();
			if (count($where) > 0) {
				foreach ($where as $key => $value) {
					$select->where($key . '=?', $value);
				}
			}
			$row = $this->fetchAll($select);
		}

		if ($row) {
			return $row;
		} else {
			return null;
		}

	}

	/**
	 * update user information
	 *
	 * @param 1: array new data
	 * @param 2: array where(id/uuid)
	 * @return bool
	 */
	public function update_user($newdata, $where) {

		$where_cluster;
		if (is_numeric($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('user_id =?', $where);
			//print("11");
		}
		if (is_string($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('user_uuid =?', $where);
		}
		print $where_cluster;

		$row = $this->update($newdata, $where_cluster);
	}

	/**
	 * active user by user_id
	 *
	 * @param int user_id
	 * @return bool
	 */
	public function active_user($user_id) {

		$newdata = array(
			'user_actived' => 1,
		);

		return $this->update_user($newdata, $user_id);
	}

	/**
	 * deactive user by user_id
	 *
	 * @param int user_id
	 * @return bool
	 */
	public function deactive_user($user_id) {

		$newdata = array(
			'user_actived' => 0,
		);

		return $this->update_user($newdata, $user_id);
	}

	/**
	 * delete user
	 *
	 * @param int/string/array
	 * @return bool
	 */
	public function delete_user($where) {

		$where_cluster;
		if (is_numeric($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('user_id =?', $where);
		}
		if (is_string($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('user_uuid =?', $where);
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
?>