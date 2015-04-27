<?php

/**
 *
 * @author Zhengwei
 *
 */

class studyingIn_Model_User_Info_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_info";

	/**
	 * create a new user_info into database
	 *
	 * @param array
	 * @return bool
	 */
	public function create_user_info($userInfo) {

		$row = $this->createRow();

		if (count($userInfo) > 0) {

			foreach ($userInfo as $key => $value) {
				$row->$key = $value;
			}

			$row->save();
			return true;

		} else {
			return false;
		}
	}

	/**
	 * get user's info from database
	 *
	 * @param int/array
	 * @return array/null
	 */
	public function get_user_info($where) {

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
	 * update user's info
	 *
	 * @param 1: array new data
	 * @param 2: array where(id/uuid)
	 * @return bool
	 */
	public function update_user_info($new_data, $where) {

		$where_cluster;
		if (is_numeric($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('user_id =?', $where);
			//print("11");
		}
		if (is_string($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('user_uuid =?', $where);
		}

		$row = $this->update($new_data, $where_cluster);
	}

	/**
	 * delete user
	 *
	 * @param int/string/array
	 * @return bool
	 */
	public function delete_user_info($where) {

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