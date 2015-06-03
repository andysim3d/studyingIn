<?php

/**
 *
 * @author Zhengwei
 *
 */

require_once APPLICATION_PATH . '/utils/UUID.php';

class StudyingIn_Model_User_Status_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_status";

	//C
	private function create_status($user_status) {

		$row = $this->createRow();
		foreach ($user_status as $key => $value) {
			$row[$key] = $value;
		}
		$row['status_uuid'] = 'status-' . UUID::v4();
		$row['post_date'] = date("Y-m-d H:i:s", time());
		try {
			$row->save();
		} catch (Exception $e) {
			return false;
		}
		return true;

	}

	//U
	private function update_status($new_data, $where) {

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
	private function get_status($where, $limit = -1) {

		$query = $this->select();
		foreach ($where as $key => $value) {
			$query->where($key . ' = ? ', $value);
		}

		if ($limit != -1) {
			$query->limit($limit);
		}
		try {
			$res = $this->fetchAll($query);
		} catch (Exception $e) {
			return false;
		}

		return $res;

	}

	//D
	private function delete_status($where) {

		try {
			$row = $this->delete($where);
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * create a new user status
	 *
	 * @param array
	 * @return bool
	 */
	public function create_new_status($user_status) {

		if (count($user_status) > 0) {

			return $this->create_status($user_status);

		} else {
			return false;
		}
	}

	/**
	 * get status by status_id
	 *
	 * @param int: status_id
	 * @return $row/null
	 */
	public function get_status_by_status_id($status_id) {

		$where = array('status_id' => $status_id);
		return $this->get_status($where);
	}

	/**
	 * get status by status_uuid
	 *
	 * @param string: status_uuid
	 * @return $row/null
	 */
	public function get_status_by_status_uuid($status_uuid) {

		$where = array('status_uuid' => $status_uuid);
		return $this->get_status($where);
	}

	/**
	 * get user's statuses by user_id
	 *
	 * @param int: user_id
	 * @return $rows/null
	 */
	public function get_statuses_by_user_id($user_id, $limit = 10) {

		$where = array('user_id' => $user_id);

		return $this->get_status($where, $limit);
	}

	/**
	 * update user status_privilege by status_id
	 *
	 * @param int 1: new status_privilege
	 * @param int 2: status_id
	 * @return bool
	 */
	public function update_status_privilege_by_status_id($status_privilege, $status_id) {

		$new_data = array('status_privilege' => $status_privilege);
		$where = $this->getAdapter()->quoteInto('status_id =?', $status_id);
		return $this->update_status($new_data, $where);
	}

	/**
	 * update user status_privilege by status_uuid
	 *
	 * @param int 1: new status_privilege
	 * @param string 2: status_uuid
	 * @return bool
	 */
	public function update_status_privilege_by_status_uuid($status_privilege, $status_uuid) {

		$new_data = array('status_privilege' => $status_privilege);
		$where = $this->getAdapter()->quoteInto('status_uuid =?', $status_uuid);
		return $this->update_status($new_data, $where);
	}

	/**
	 * update user status_content by status_id
	 *
	 * @param string 1: new status_content
	 * @param int 2: status_id
	 * @return bool
	 */
	public function update_status_content_by_status_id($status_content, $status_id) {

		$new_data = array('status_content' => $status_content);
		$where = $this->getAdapter()->quoteInto('status_id =?', $status_id);
		return $this->update_status($new_data, $where);
	}

	/**
	 * update user status_content by status_uuid
	 *
	 * @param string 1: new status_content
	 * @param string 2: status_uuid
	 * @return bool
	 */
	public function update_status_content_by_status_uuid($status_content, $status_uuid) {

		$new_data = array('status_content' => $status_content);
		$where = $this->getAdapter()->quoteInto('status_uuid =?', $status_uuid);
		return $this->update_status($new_data, $where);
	}

	/**
	 * delete status by status_id
	 * need to add verify here.
	 *
	 * @param int: status_id
	 * @return bool
	 */
	public function delete_status_by_status_id($status_id, $user) {
		$exist = $this->get_status_by_status_id($status_id)->to_array();
		if(count($exist) == 0){
			return false;
		}
		if($exist['user_id'] != $user['user_id']){
			return false;
		}

		print_r($exist);

		$where = $this->getAdapter()->quoteInto('status_id =?', $status_id);
		return true;
		//return $this->delete_status($where);

	}

	/**
	 * delete status by status_uuid
	 *
	 * @param string: status_uuid
	 * @return bool
	 */
	public function delete_status_by_status_uuid($status_uuid) {

		$where = $this->getAdapter()->quoteInto('status_uuid =?', $status_uuid);
		return $this->delete_status($where);

	}

}