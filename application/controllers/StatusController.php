<?php


	require_once APPLICATION_PATH.'/models/Dao/User_Blog_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Album_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/Up_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Info_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Photo_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Relation_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Status_Dao.php';
	require_once APPLICATION_PATH.'/utils/UUID.php';
	require_once APPLICATION_PATH.'/controllers/BaseController.php';


	class StatusController extends BaseController{
		public function init(){
			;
		}

		public function postAction(){
			$user = ['user_id' => 1];

			$status = array();
			//should get from $_POST
			$status['status_privilege'] = $this->getRequest()->getParam('status_privilege', 1);
			$status['status_content'] = $this->getRequest()->getParam('status_content', "");

			//should get from session
			$status['user_id'] = $user['user_id'];

			$status_dao = new StudyingIn_Model_User_Status_Dao();
			
			if($status_dao->create_new_status($status) == true){
				echo "ok";
			}
			else {
				echo "no";
			}
			exit(0);

		}

		public function deleteAction(){
			$status = $this->getRequest()->getParam('status_id', -1);

			//delete_status_by_status_id
			$status_dao = new StudyingIn_Model_User_Status_Dao();
			
			if($status_dao->delete_status_by_status_id($status, ['user_id' => 1]) == true){
				echo "ok";
			}
			else
			{
				echo "No";
			}
			exit(0);


		}
	}



?>