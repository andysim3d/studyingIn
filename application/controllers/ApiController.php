<?php

	require_once APPLICATION_PATH.'/models/Dao/User_Blog_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Album_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/Up_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Info_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Photo_Dao.php';
	require_once APPLICATION_PATH.'/models/Dao/User_Relation_Dao.php';


	class ApiController extends BaseController{

		public function indexAction(){
			$strr = json_encode($_GET);
			echo($strr);
			exit(0);
		}

		public function getuinfoAction(){
			$user_id = $this->getRequest()->getParam('user_id',-1);
			// $user_id = $_GET['user_id'];
			$user_info_dao = new studyingIn_Model_User_Info_Dao();
			$res = $user_info_dao->get_user_info($user_id);
			if (count($res) == 0) {
				echo "[]";
				exit(0);
			}
			$json_res = array();

			foreach ($res as $key => $value) {
				$json_res[$key] = $value;
			}
			$strr = json_encode($json_res);
			echo ($strr);
			exit(0);
		}

		public function poststatusAction(){
			$user_id = $this->getRequest() -> getParam('user_id', -1);
			



		}



	}






?>
