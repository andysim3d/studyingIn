<?php

/**
* Up_Dao.php:	Dao for table 'up_vote'.
* Could access table, create tuple, delete tuple, query all tuples 
* by user or uuid.
*
* By Pengfei Zhang.
* Apr. 25. 2015
*/

class StudyingIn_Model_Up_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "up_vote";

	//insert vode record, 
	/*
		|  user_id   |  $uuid  |   time (now) |  vote_id(auto)
	
	*/

		/**
		*	create a vote record
		*	@param user: user information
		*	@param uuid:	object's uuid	
		*
		*	@return true on success insert, false on fail
		*	test: pass
		*/
	public function create_vote($user, $uuid) {

		$row = $this->createRow();
		//if user_id not exist, return false
		if (!isset($user['user_id'])) {
			return false;# code...
		}
		//set $user_id
		$user_id = $user['user_id'];


		$row['user_id'] = $user_id;
		$row['uuid'] = $uuid;
		$row['up_vote_date'] = date("Y-m-d H:i:s",time());

			//print_r($row);
		$row->save();
		return true;

		// } else {
		// 	return false;
		// }
	}

	/**
	*	delete vote record
	*	@param user: user's information
	*	@param uuid: object's uuid
	*
	* 	@return true on success or record never exist, false on fail.
	*	test: pass
	*/
	public function delete_vote($user, $uuid){
		if (!isset($user['user_id'])) {
			return false;
		}

		$where = $this->getAdapter()->quoteInto("`user_id`=?",$user['user_id']).
				$this->getAdapter()->quoteInto(" And `uuid` = ?", $uuid);
		// $row = $this->fetchall($where);
		// //print($row);
		// if (is_null($row)) {
		// 	return true;
		// }
		
		// else{
		$this->delete($where);
			
		// }
		return true;

	}

	/**
	*	delete vote record
	*	@param vote object
	*
	* 	@return true on success or record never exist, false on fail.
	*	test: pass
	*/
	public function delete_vote_by_id($vote){

		if (!isset($vote['up_vote_id'])) {
			return false;
		}
		$where = $this->getAdapter()->quoteInto("`up_vote_id`=?",$vote['up_vote_id']);

		// $row = $this->fetch($where);
		
		// if (is_null($row)) {
		// 	return true;
		// }
		
		// else{
			$this->delete($where);
		// }
		return true;
	}

	/**
	*  	get all voted record for specific user
	*	@param user : user's object
	*
	*	@return array of all uuids.
	*	test: 
	*/
	public function get_all_vote_uuid_by_user($user){
		if(!isset($user['user_id'])){
			return array();
		}
		$where = $this->select()->distinct()->from('up_vote','(uuid)')->where('`user_id` =?', $user['user_id'])->order('up_vote_date ASC');//;->quoteInto("`uuid` = ? ", $uuid);
		$res = $this->fetchall($where);

		return $res;
	}


	/**
	*  	get all voted record for specific uuid
	*	@param user : uuid object
	*
	*	@return array of all user.
	*	test: 
	*/

	public function get_all_vote_user_by_uuid($uuid){

		$where = $this->select()->distinct()->from('up_vote','(user_id)')->where('`uuid` =?', $uuid)->order('up_vote_date ASC');//;->quoteInto("`uuid` = ? ", $uuid);
		$res = $this->fetchall($where);

		return $res;
	}

	/**
	*  	get total vote numbers for specific object by UUID
	*	@param uuid : specific object's uuid
	*
	*	@return int total vote number.
	*	test: pass
	*/
	public function get_total_vote_num($uuid){

		$where = $this->getAdapter()->quoteInto("`uuid` = ? ", $uuid);
		$res = $this->fetchall($where);
		$num = count($res);

		return $num;
	}



	public function test(){

		$query['user_id'] = 1;
		$query['uuid'] = 2;
		
		$where = array();
		 $sele = $this->select();//->query();//->quoteInto();
		foreach ($query as $key => $value) {
			# code...
			$where[$key."= ? "] = $value;
			$sele = $sele->where("$key = ? ", $value);
		}
		print_r($where);
		// $sele  = $this->select()->where("user_id = ? " , "1") -> where(" uuid = ? ", "2");
		print $sele;
		$user['user_id'] = 1;
		$uuid = 1000;
		$vote['up_vote_id'] = 1000005;
		print_r($this->create_vote($user, $uuid));
		//$this->delete_vote_by_id($vote);
	}

}
