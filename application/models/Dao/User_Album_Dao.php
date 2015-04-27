<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_Model_User_Album_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_album";

	/**
	 * create a new user album
	 *
	 * @param array
	 * @return bool
	 */
	public function create_user_album($user_album) {

		$row = $this->createRow();

		if (count($userData) > 0) {

			foreach ($userData as $key => $value) {
				$row->$key = $value;
			}

			$row->save();
			return true;

		} else {
			return false;
		}
	}

	/**
	 * get user album
	 *
	 * @param album_id/array
	 * @return $album/null
	 */
	public function get_user_album($where) {

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
	 * update user's album information
	 *
	 * @param 1: array new data
	 * @param 2: array where(album_id/album_uuid)
	 * @return bool
	 */
	public function update_user_album($new_data, $where) {

		$where_cluster;
		if (is_numeric($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('album_id =?', $where);
			//print("11");
		}
		if (is_string($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('album_uuid =?', $where);
		}

		$row = $this->update($new_data, $where_cluster);
	}

	/**
	 * delete user's album
	 *
	 * @param int/string/array
	 * @return bool
	 */
	public function delete_user($where) {

		$where_cluster;
		if (is_numeric($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('album_id =?', $where);
		}
		if (is_string($where)) {
			$where_cluster = $this->getAdapter()->quoteInto('album_uuid =?', $where);
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