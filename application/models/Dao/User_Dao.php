<?php

/**
 *
 * @author Zhengwei
 *
 */
require_once APPLICATION_PATH . '/utils/UUID.php';
require_once APPLICATION_PATH . '/utils/Tools.php';

class StudyingIn_Model_User_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user";

	//C
	private function create_user($user) {

		$row = $this->createRow();

		foreach ($user as $key => $value) {
			$row->$key = $value;
		}
		$row['salt'] = Tools::generateSalt16();
		$row['user_password'] = hash('sha256', $user['user_password'] . $row['salt']);
		$row['user_uuid'] = 'user-' . UUID::v4();
		try {
			$row->save();
		} catch (Exception $e) {
			return false;
		}
		return $row->user_id;

	}

	//U
	private function update_user($new_data, $where) {

		try {
			$row = $this->update($new_data, $where);
		} catch (Exception $e) {
			return false;
		}

		return true;

	}

	//R
	private function get_user($where) {

		try {
			$row = $this->fetchAll($where);
		} catch (Exception $e) {
			return false;
		}

		return $row;

	}

	//D
	private function delete_user($where) {
		try {
			$row = $this->delete($where);
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * create a new user into database
	 *
	 * @param array
	 * @return user_id/false
	 */
	public function create_new_user($user) {

		if (count($user) > 0) {
			return $this->create_user($user);
		} else {
			return false;
		}
	}

	/**
	 * get user by id
	 *
	 * @param user_id
	 * @return array/false
	 */
	public function get_user_by_user_id($user_id) {

		$user = $this->get_user(array('user_id = ?' => $user_id));
		return $user;
	}

	/**
	 * get user by uuid
	 *
	 * @param user_id
	 * @return array/false
	 */
	public function get_user_by_user_uuid($user_uuid) {

		$user = $this->get_user(array('user_uuid =?' => $user_uuid));
		return $user;
	}

	/**
	 * get user by email
	 *
	 * @param user_id
	 * @return array/false
	 */
	public function get_user_by_user_email($user_email) {

		$user = $this->get_user(array('user_email =?' => $user_email));
		return $user;
	}

	/**
	 * update password by email
	 *
	 * @param 1:password
	 * @param 2:salt
	 * @param 3:email
	 * @return bool
	 */
	public function update_password_by_user_email($password, $salt, $user_email) {
		$new_password = hash('sha256', $password . $salt);
		$where = array('user_email =?' => $user_email);
		return $this->update_user(array('user_password' => $new_password), $where);
	}

	/**
	 * update password by uuid
	 *
	 * @param 1:password
	 * @param 2:salt
	 * @param 3:uuid
	 * @return bool
	 */
	public function update_password_by_user_uuid($password, $salt, $user_uuid) {
		$new_password = hash('sha256', $password . $salt);
		$where = array('user_uuid =?' => $user_uuid);
		return $this->update_user(array('user_password' => $new_password), $where);
	}

	/**
	 * active user by user_id
	 *
	 * @param int user_id
	 * @return bool
	 */
	public function active_user($user_id) {
		//var_dump($user_id);
		$new_data = array(
			'user_actived' => 1,
		);
		$where = array('user_id =?' => $user_id);

		return $this->update_user($new_data, $where);
	}

	/**
	 * deactive user by user_id
	 *
	 * @param int user_id
	 * @return bool
	 */
	public function deactive_user($user_id) {

		$new_data = array(
			'user_actived' => 0,
		);
		$where = array('user_id =?' => $user_id);

		return $this->update_user($new_data, $where);
	}

	/**
	 * delete user by id
	 *
	 * @param int
	 * @return bool
	 */
	public function delete_user_by_user_id($user_id) {

		$where = array('user_id =?' => $user_id);
		return $this->delete_user($where);
	}

	/**
	 * delete user by email
	 *
	 * @param string
	 * @return bool
	 */
	public function delete_user_by_user_email($user_email) {

		$where = array('user_email =?' => $user_email);
		return $this->delete_user($where);
	}

	/**
	 * delete user by uuid
	 *
	 * @param string
	 * @return bool
	 */
	public function delete_user_by_user_uuid($user_uuid) {

		$where = array('user_uuid =?' => $user_uuid);
		return $this->delete_user($where);
	}

	/**
	 * check user by email
	 *
	 * @param string: email
	 * @return bool: true for exist; flase for not.
	 */
	public function check_user_existence_by_user_email($user_email) {

		$where = array('user_email =?' => $user_email);
		$row = $this->get_user($where);

		if (count($row) == 0) {
			return false;
		}
		return true;

	}

	/**
	 * check user by uuid
	 *
	 * @param string:user_uuid
	 * @return bool: true for exist; flase for not.
	 */
	public function check_user_existence_by_user_uuid($user_uuid) {

		$where = array('user_uuid =?' => $user_uuid);
		$row = $this->get_user($where);

		if (count($row) == 0) {
			return false;
		}
		return true;

	}

	/**
	 * check user by id
	 *
	 * @param int:user_id
	 * @return bool: true for exist; flase for not.
	 */
	public function check_user_existence_by_user_id($user_id) {

		$where = array('user_id =?' => $user_id);
		$row = $this->get_user($where);

		if (count($row) == 0) {
			return false;
		}
		return true;

	}

}
?>