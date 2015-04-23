<?php

class studyingIn_Model_UserDao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user";

	/**
	 * create a new user into database
	 *
	 * @param array
	 * @return bool
	 */
	public function createUser($userData) {

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
			return true;

		} else {
			return false;
		}
	}

	/**
	 * make the salt
	 *
	 * @return string
	 */
	public function _generateSalt16() {

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
	public function _encryptPassword($password, $salt) {

		$user_salted_password = hash('sha256', $password . $salt);
		//echo $user_salted_password
		return $user_salted_password;

	}

}
