<?php

class studyingIn_Model_User_Dao extends Zend_Db_Table_Abstract {

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
			$salt = $this->_generateSalt16();
			$saltedPassword = $this->_encryptPassword($userData['user_password'], $salt);

			foreach ($userData as $key => $value) {
				switch ($key) {
					case 'user_password':
						$row->$key = $saltedPassword;
						break;
					case 'confirm_password':
						break;
					default:
						$row->$key = $value;
				}
			}
			$row->salt = $salt;
			//print_r($row);
			$row->save();
			return $row->user_id;

		} else {
			return false;
		}
	}

	/**
	 * make the salt
	 *
	 * @return string
	 */
	private function _generateSalt16() {

		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$str = "";

		for ($i = 0; $i < 16; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}

		return $str;
	}

	/**
	 *encrypt the password using sha256
	 *
	 * @param 1: string $password
	 * @param 2: string $salt
	 * @return string $user_salted_password after encryption
	 */
	private function _encryptPassword($password, $salt) {

		$user_salted_password = hash('sha256', $password . $salt);
		//echo $user_salted_password
		return $user_salted_password;

	}

	/**
	 * get user from database
	 *
	 * @param int/array
	 * @return array/null
	 */
	private function get_user($where) {

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
	 * active user by user_id
	 *
	 * @param int user_id
	 * @return bool
	 */
	public function active_user_by_user_id($user_id) {

		$select = $this->select();
		$select->where('user_id =?', $user_id);
		$data = array('user_actived' => 1);

		$this->update($data, $select);

	}

}
