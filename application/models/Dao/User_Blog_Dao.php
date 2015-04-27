<?php

/**
*CREATE TABLE `studyingIn_user_blog` (
*  `user_id` int(11) NOT NULL,
*  `blog_uuid` varchar(64) NOT NULL DEFAULT '',
*  `blog_id` int(22) NOT NULL AUTO_INCREMENT,
*  `blog_title` text NOT NULL,
*  `blog_post_date` date NOT NULL,
*  `blog_privilege` tinyint(2) NOT NULL DEFAULT '1',
*  `blog_content` text,
*  PRIMARY KEY (`blog_id`),
*  KEY `user_id` (`user_id`),
*  CONSTRAINT `studyingIn_user_blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `studyingIn_user` (`user_id`) ON DELETE CASCADE
*) ENGINE=InnoDB AUTO_INCREMENT=1000000 DEFAULT CHARSET=utf8;
*
*	This file is a Dao for table 'studyingIn_user_blog'.
*	By Pengfei Zhang
*	Date: Apr. 25. 2015
*/

	require_once APPLICATION_PATH.'/utils/isvalidate.php';
	require_once APPLICATION_PATH.'/utils/UUID.php';



class StudyingIn_Model_Blog_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_blog";


	/**
	*	@param user: user object, who post it.
	*	@param blog: blog object, with title.
	*
	*
	*
	*	@return bool, true on success, false on failed.
	*	pass test
	*/

	public function post_blog($user, $blog){
		if (!Validator::user_validate($user)) {
			return false;# code...
		}
		if (!Validator::blog_validate($blog)) {
			return false;
		}
		$row = $this->createRow();
		$row['user_id'] = $user['user_id'];
		foreach ($blog as $key => $value) {
			$row->$key = $value;
		}
		$row['blog_uuid'] = "blog-".UUID::v4();
		$row['blog_post_date'] = date("Y-m-d H:i:s",time());
		if(!isset($row['blog_privilege'])){
			//1 as public, 
			//2 as only follower could read
			//3 as double follow could read
			//4 as only author couod read.
			$row['blog_privilege'] = 1;

		}
		// print_r($row);
		$res =  $row->save();
		return $res;
	}

	/**
	*
	*
	*
	*
	*/

	private function get_blogs($data , $limit = -1){
		$query = $this->select();
		foreach ($$data as $key => $value) {
			$query = $query->where('$key = ? ', $value);
		}
		if ($limit != -1) {
			$query = $query->limit($limit);
		}
		$res = $this->fetchAll($query);

		return $res;
	}

	/**
	*	Get blog from db with UUID
	*	@param uuid.
	*
	*	@return array, contains everythins about blog
	*	
	*/

	public function get_blog_by_uuid($uuid){

		$query_data['blog_uuid'] = $uuid;
		$res ;
		// $query = $this->select()->where('blog_uuid = ? ', $uuid);
		try{
			// $res = $this->fetchAll($query);

			$res = $this->get_blogs($query_data);
		}
		catch(Exception $e){
			echo "error on db.<br/>";
		}
		if (count($res) == 0) {
			return array();
		}
		return $res;
	}


	/**
	*	Get blog from db with Blog ID.
	*	@param $blog object.
	*
	*	@return array, contains everythins about blog
	*	;
	*/

	public function get_blog_by_blog_id($blog){
		$query_data['blog_id'] = 0;

		if (isset($blog['blog_id'])){
			$query_data['blog_id'] = $blog['blog_id'];
		
		}
		else{
			$query_data['blog_id'] = $blog;
		}
		//$query = $this->select()->where('blog_id = ? ', $blog_id);
		try{
			$res = $this->get_blogs($query_data);//= $this->fetchAll($query);
		}
		catch(Exception $e){
			echo "error on db.<br/>";
		}
		if (count($res) == 0) {
			return array();
		}
		return $res;
	}

	/**
	*	Get All blogs from db with user ID.
	*	@param user object.
	*	@param Max numbers of results, -1 is unlimited.
	*
	*	@return array, contains everythins about blog
	*	;
	*/

	public function get_blogs_by_user_id($user, $num){
		$query_data['user_id'] = 0;
		if (isset($user['user_id'])){
			$query_data['user_id'] = $user['user_id'];
		}
		else{
			$query_data['user_id'] = $blog;
		}

		try{
			$res = $this->get_blogs($query_data, $limit);// = $this->fetchAll($query);
		}
		catch(Exception $e){
			echo "error on db.<br/>";
		}
		if (count($res) == 0) {
			return array();
		}
		return $res;
	}

	//private function
	/**
	*	@param: $uuid: uuid used to identify it.
	*	@param: $new data
	*
	*	@return bool: True on success otherwise failed.
	*/
	private function update_row($uuid, $new_data){

		$where_cluster = $this->getAdapter()->quoteInto('blog_uuid =?', $uuid);

 		$row = $this->update($new_data, $where_cluster);

 		//return 
 		if ($row) {
 			return true;
 		}
 		else{
 			return false;
 		}
 		return false;
	}
	
	/**
	*	@param: $uuid: uuid used to identify it.
	*	@param: $new data.
	*
	*	@return bool: True on success otherwise failed.
	*
	*/

	public function update_Blog($uuid, $new_data){
		$this->update_row($uuid, $new_data);
	}


	/**
	*	Delete an article by it's uuid.	
	*	@param: article's uuid
	*
	*	@return bool: True on success otherwise failed.
	*/
	public function delete_by_uuid($uuid){

		$where_cluster = $this->getAdapter()->quoteInto('user_uuid =?', $uuid);
		$row = $this->delete($where_cluster);
		if ($row) {
			return true;
		} else {
			return false;
		}
	}

	private function delete_row($query_data){

		$row = $this->delete($query_data);

		return ;
	}

	































}

?>