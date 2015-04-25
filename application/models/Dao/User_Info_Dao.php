<?php

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

}