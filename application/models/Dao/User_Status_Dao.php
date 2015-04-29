<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_Model_Status_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_status";

	/**
	 * create a new user status
	 *
	 * @param array
	 * @return user_id/false
	 */
	public function create_user_status($user_status) {

		$row = $this->createRow();

		if (count($user_status) > 0) {

			foreach ($user_status as $key => $value) {
				$row->$key = $value;
			}

			try{
				$row->save();
			}
			catch (Exception $e){
				return false;
			}

			return $row->user_id;

		} else {
			return false;
		}
	}

	/**
	 * get user's status
	 *
	 * @param array
	 * @return $row/null
	 */
	public function get_user_status($where) {

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
	 * update user status
	 *
	 * @param 1: array new data
	 * @param 2: array where
	 * @return bool
	 */
	public function update_user_status($new_data, $where) {

		if (is_array($where)) {
			if (count($where) > 0) {
				foreach ($where as $key => $value) {
					$where_cluster[$key . '=?'] = $value;
				}
			}
		}

		$row = $this->update($new_data, $where_cluster);

		if ($row) {
			return true;
		}
		return false;
	}

	/**
	 * delete user's
	 *
	 * @param status_id/status_uuid/array
	 * @return bool
	 */
	public function delete_user_status($where) {

		$where_cluster;
		if (is_numeric($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('status_id =?', $where);
		}
		if (is_string($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('status_uuid =?', $where);
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