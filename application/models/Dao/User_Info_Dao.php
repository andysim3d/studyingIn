<?php

/**
 *
 * @author Zhengwei
 *
 */
require_once APPLICATION_PATH . '/utils/UUID.php';
require_once APPLICATION_PATH . '/utils/Tools.php';

class StudyingIn_Model_User_Info_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_info";

	//C
	private function create_user_info($user_info) {

		$row = $this->createRow();

		foreach ($user_info as $key => $value) {
			$row[$key] = $value;
		}
		$row['user_create_time'] = date("Y-m-d H:i:s", time());
		$row['user_introduction'] = "该用户很懒，暂时什么都没有留下。";
		try {
			$row->save();
		} catch (Exception $e) {
			return false;
		}
		return true;

	}

	//U
	private function update_user_info($new_data, $where) {

		try {
			$row = $this->update($new_data, $where);
		} catch (Exception $e) {
			return false;
		}

		if ($row) {
			return true;
		}
		return false;

	}

	//R
	private function get_user_info($where) {

		try {
			$row = $this->fetchAll($where);
		} catch (Exception $e) {
			return false;
		}

		return $row;

	}

	//D
	private function delete_user_info($where) {
		try {
			$row = $this->delete($where);
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * create a new user_info
	 *
	 * @param array
	 * @return bool
	 */
	public function create_new_user_info($user_info) {

		if (isset($user_info['confirm_password'])) {
			unset($user_info['confirm_password']);
		}
		if (isset($user_info['salt'])) {
			unset($user_info['salt']);
		}
		if (isset($user_info['user_password'])) {
			unset($user_info['user_password']);
		}
		if (isset($user_info['user_actived'])) {
			unset($user_info['user_actived']);
		}
		if (count($user_info) > 0) {
			return $this->create_user_info($user_info);
		} else {
			return false;
		}

	}

	/**
	 * get user's info by id
	 *
	 * @param int: user_id
	 * @return array/null
	 */
	public function get_user_info_by_id($user_id) {

		$where = $this->getAdapter()->quoteInto('user_id =?', $user_id);
		$user_info = $this->get_user_info($where);
		return $user_info;
	}

	/**
	 * get user's info by uuid
	 *
	 * @param string: user_uuid
	 * @return array/null
	 */
	public function get_user_info_by_uuid($user_uuid) {

		$where = $this->getAdapter()->quoteInto('user_uuid =?', $user_uuid);
		$user_info = $this->get_user_info($where);
		return $user_info;
	}

	/**
	 * get user's info by email
	 *
	 * @param string: user_email
	 * @return array/null
	 */
	public function get_user_info_by_email($user_email) {

		$where = $this->getAdapter()->quoteInto('user_email =?', $user_email);
		$user_info = $this->get_user_info($where);
		return $user_info;
	}

	/**
	 * get users from same school
	 *
	 * @param string: user_school
	 * @return array/null
	 */
	public function get_users_by_user_school($user_school) {

		$where = $this->getAdapter()->quoteInto('user_school =?', $user_school);
		$users = $this->get_user_info($where);
		return $users;
	}

	/**
	 * get users from same city
	 *
	 * @param string: user_city
	 * @return array/null
	 */
	public function get_users_by_user_city($user_city) {

		$where = $this->getAdapter()->quoteInto('user_city =?', $user_city);
		$users = $this->get_user_info($where);
		return $users;
	}

	/**
	 * get users from same province
	 *
	 * @param string: user_province
	 * @return arrays/null
	 */
	public function get_users_by_user_province($user_province) {

		$where = $this->getAdapter()->quoteInto('user_province =?', $user_province);
		$users = $this->get_user_info($where);
		return $users;
	}

	/**
	 * update user's info by id
	 *
	 * @param int: user_id
	 * @return bool
	 */
	public function update_user_info_by_id($new_data, $user_id) {

		$where = $this->getAdapter()->quoteInto('user_id =?', $user_id);
		return $this->update_user_info($new_data, $where);
	}

	/**
	 * update user's info by uuid
	 *
	 * @param string: user_uuid
	 * @return bool
	 */
	public function update_user_info_by_uuid($new_data, $user_uuid) {

		$where = $this->getAdapter()->quoteInto('user_uuid =?', $user_uuid);
		return $this->update_user_info($new_data, $where);
	}

	/**
	 * update user's info by email
	 *
	 * @param string: user_email
	 * @return bool
	 */
	public function update_user_info_by_email($new_data, $user_email) {

		$where = $this->getAdapter()->quoteInto('user_email =?', $user_email);
		return $this->update_user_info($new_data, $where);
	}

	/**
	 * delete user by user_id
	 *
	 * @param int:user_id
	 * @return bool
	 */
	public function delete_user_info_by_user_id($user_id) {

		$where = $this->getAdapter()->quoteInto('user_id =?', $user_id);
		return $this->delete_user_info($where);
	}

	/**
	 * delete user by user_uuid
	 *
	 * @param string:user_uuid
	 * @return bool
	 */
	public function delete_user_info_by_user_uuid($user_uuid) {

		$where = $this->getAdapter()->quoteInto('user_uuid =?', $user_uuid);
		return $this->delete_user_info($where);
	}

	/**
	 * delete user by user_email
	 *
	 * @param string:user_email
	 * @return bool
	 */
	public function delete_user_info_by_user_email($user_email) {

		$where = $this->getAdapter()->quoteInto('user_email =?', $user_email);
		return $this->delete_user_info($where);
	}

}