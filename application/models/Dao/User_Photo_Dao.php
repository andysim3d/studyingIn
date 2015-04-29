<?php
	
/**
 *
 * @author Zhengwei
 *
 */

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
				$row->$key = $value;
			}
			$row['photo_uuid'] = "blog-".UUID::v4();
			$row['photo_upload_date'] = date("Y-m-d H:i:s",time());

			// print_r($row);
			$res =  $row->save();
			return $res;
		}

		//u

		private function update_row($photo_id, $update_data){

			$where_cluster = $this->getAdapter()->quoteInto('photo_id =?', $photo_id);

			$row = $this->update($update_data, $where_cluster);
			//return
			if ($row) {
				return true;
			}
			return false;
		}

		//R

		private function get_row($query_data, $limit=-1){

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



		//D

		/**
		*	Delete row
		*	@param to specific deleted row
		*
		*	@return bool ,true on success else failed.
		*
		*/
		private function delete_row($query_data){
			$row = $this->delete($query_data);
			if($row){
				return true;
			}
			return false;
		}









	}


?>