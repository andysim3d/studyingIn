<?php

/**
 *
 * @author Zhengwei
 *
 */

require_once APPLICATION_PATH . '/utils/UUID.php';

class StudyingIn_Model_User_Album_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_album";

	//C
	private function create_album($user_album) {

		$row = $this->createRow();

		foreach ($user_album as $key => $value) {
			$row[$key] = $value;
		}
		$row['album_uuid'] = 'album-' . UUID::v4();
		$row['album_create_date'] = date("Y-m-d H:i:s", time());
		try {
			$row->save();
		} catch (Exception $e) {
			return true;
		}

	}

	//U
	private function update_album($new_data, $where) {

		try {
			$row = $this->update($new_data, $where);
		} catch (Exception $e) {
			return false;
		}

		return true;

	}

	//R
	private function get_album($where) {

		try {
			$row = $this->fetchAll($where);
		} catch (Exception $e) {
			return false;
		}

		return $row;

	}

	//D
	private function delete_album($where) {

		try {
			$row = $this->delete($where);
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * create a new user album
	 *
	 * @param array
	 * @return bool
	 */
	public function create_new_album($user_album) {

		if (count($user_album) > 0) {
			return $this->create_album($user_album);
		} else {
			return false;
		}
	}

	/**
	 * get user album by album_id
	 *
	 * @param int:album_id
	 * @return $album/null
	 */
	public function get_album_by_album_id($album_id) {

		$where = $this->getAdapter()->quoteInto('album_id =?', $album_id);
		$user_album = $this->get_album($where);
		return $user_album;
	}

	/**
	 * get user album by album_uuid
	 *
	 * @param string:album_uuid
	 * @return $album/null
	 */
	public function get_album_by_album_uuid($album_uuid) {

		$where = $this->getAdapter()->quoteInto('album_uuid =?', $album_uuid);
		$user_album = $this->get_album($where);
		return $user_album;
	}

	/**
	 * get user album by user_id
	 *
	 * @param int:user_id
	 * @return $album/null
	 */
	public function get_albums_by_user_id($user_id) {

		$where = $this->getAdapter()->quoteInto('user_id =?', $user_id);
		$user_album = $this->get_album($where);
		return $user_album;
	}

	/**
	 * update album_name by album_id
	 *
	 * @param string 1: new album name
	 * @param int 2: album_id
	 * @return bool
	 */
	public function update_album_name_by_album_id($new_name, $album_id) {

		$new_data = array('album_name' => $new_name);
		$where = $this->getAdapter()->quoteInto('user_id =?', $user_id);
		return $this->update_album($new_data, $where);
	}

	/**
	 * update album_name by album_uuid
	 *
	 * @param string 1: new album name
	 * @param string 2: album_uuid
	 * @return bool
	 */
	public function update_album_name_by_album_uuid($new_name, $album_uuid) {

		$new_data = array('album_name' => $new_name);
		$where = $this->getAdapter()->quoteInto('album_uuid =?', $album_uuid);
		return $this->update_album($new_data, $where);
	}

	/**
	 * update album_privilege by album_id
	 *
	 * @param int 1: new album_privilege
	 * @param int 2: album_id
	 * @return bool
	 */
	public function update_album_privilege_by_album_id($album_privilege, $album_id) {

		$new_data = array('album_privilege' => $album_privilege);
		$where = $this->getAdapter()->quoteInto('user_id =?', $user_id);
		return $this->update_album($new_data, $where);
	}

	/**
	 * update album_privilege by album_uuid
	 *
	 * @param int 1: new album_privilege
	 * @param string 2: album_uuid
	 * @return bool
	 */
	public function update_album_privilege_by_album_uuid($album_privilege, $album_uuid) {

		$new_data = array('album_privilege' => $album_privilege);
		$where = $this->getAdapter()->quoteInto('album_uuid =?', $album_uuid);
		return $this->update_album($new_data, $where);
	}

	/**
	 * update album_info by album_id
	 *
	 * @param string 1: new album_info
	 * @param int 2: album_id
	 * @return bool
	 */
	public function update_album_info_by_album_id($album_info, $album_id) {

		$new_data = array('album_info' => $album_info);
		$where = $this->getAdapter()->quoteInto('user_id =?', $user_id);
		return $this->update_album($new_data, $where);
	}

	/**
	 * update album_info by album_uuid
	 *
	 * @param string 1: new album_info
	 * @param string 2: album_uuid
	 * @return bool
	 */
	public function update_album_info_by_album_uuid($album_info, $album_uuid) {

		$new_data = array('album_info' => $album_info);
		$where = $this->getAdapter()->quoteInto('album_uuid =?', $album_uuid);
		return $this->update_album($new_data, $where);
	}

	/**
	 * delete user's album by album_id
	 *
	 * @param int: user_id
	 * @return bool
	 */
	public function delete_album_by_album_id($album_id) {

		$where = $this->getAdapter()->quoteInto('album_id =?', $album_id);
		return $this->delete_user_info($where);

	}

	/**
	 * delete user's album by album_uuid
	 *
	 * @param string: user_uuid
	 * @return bool
	 */
	public function delete_album_by_album_uuid($album_uuid) {

		$where = $this->getAdapter()->quoteInto('album_uuid =?', $album_uuid);
		return $this->delete_user_info($where);

	}

}