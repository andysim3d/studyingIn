<?php
	
/**
 *
 * @author Zhengwei
 *
 */
require_once APPLICATION_PATH.'/utils/UUID.php';

class StudyingIn_Model_User_Photo_Dao extends Zend_Db_Table_Abstract {
		protected $_name = "studyingIn_user_photo";

		//C
		/**
		*	General function for C action.
		*
		*/
		private function create_row($new_data){
			$row = $this->createRow();
			foreach ($new_data as $key => $value) {
				$row[$key] = $value;
			}
			//auto genreate uuid and upload date.
			$row['photo_uuid'] = "photo-".UUID::v4();
			$row['photo_upload_date'] = date("Y-m-d H:i:s",time());

			// print_r($row);
			try{
				$res =  $row->save();
			}
			catch(Exception $e){
				throw new Exception("Error in DB insert Request", 1);
				
				return false;
			}
			return $res;
		}





		//u

		private function update_row($photo_id, $update_data){

			$where_cluster = $this->getAdapter()->quoteInto('photo_id =?', $photo_id);

			try{
				$row = $this->update($update_data, $where_cluster);
			}
			catch(Exception $e){
				return false;
			}
			//return
			if ($row) {
				return true;
			}
			return false;
		}

		//R

		/**
		*	fetch row
		*	@param to specific row
		*	@param  
		*
		*/
		private function get_row($query_data, $limit=-1){

			$query = $this->select();
			foreach ($$data as $key => $value) {
				$query = $query->where('$key = ? ', $value);
			}
			if ($limit != -1) {
				$query = $query->limit($limit);
			}
			try {
				
				$res = $this->fetchAll($query);
			} catch (Exception $e) {
				return false;
			}

			return $res;
		}


		/**
		*	Delete row
		*	@param to specific deleted row
		*
		*	@return bool ,true on success else failed.
		*
		*/
		private function delete_row($query_data){
			try{
				$row = $this->delete($query_data);
			}
			catch(Exception $e){
				return false;
			}
			if($row){
				return true;
			}
			return false;
		}



		/**
		*	Upload photos
		*	@param: User object, must have id
		*	@param: photo info, must have photo name.
		*
		*	@return bool, true on success, otherwise failed
		*/
		public function upload_photo($album, $photo){
			if (!isset($album['album_id'])) {
				return false;
				# code...
			}
			if (!isset($photo['photo_name'])) {
				# code...
				return false;
			}
			$new_data = array();
			foreach ($photo as $key => $value) {
				$new_data[$key] = $value;
			}
			$new_data['album_id'] = $album['album_id'];
			//print_r($new_data);
			return $this->create_row($new_data);
			// return $this->create_row($new_data);
		}


		/**
		*	change photos info
		*	@param: photo info, must have id
		*	@param: changed info, must have photo name.
		*
		*	@return bool, true on success, otherwise failed
		*/
		public function change_photo_info($photo, $new_data){
			if(!isset($photo['photo_id']))
			{
				return false;
			}

			$photo_id = $photo['photo_id'];
			return $this->update_row($photo_id, $new_data);

		}

		/**
		*	Get photos by album
		*	@param album object
		*	
		*	@return photo row.
		*/
		public function get_photos_by_album($album, $limit = 30){
			if (!isset($album['album_id'])) {
				return 0;
			}

			$rows = $this->get_row(array('album_id' => $album['album_id']), 30);

		}

		/**
		*	Get photos by album
		*	@param User object
		*	
		*	@return photo rows.
		*/
		public function get_photo_by_id($photo_id){
			$rows = $this->get_row(array('photo_id' => $photo_id), 30);
			return $rows;
		}

		/**
		*	delete photo
		*	@param photo id.
		*
		*	@return bool, true on success otherwise failed.	
		*
		*/
		public function delete_photo_by_id($photo_id){
			return $this->delete_row(array('photo_id' => $photos_id));
		}




	}


?>