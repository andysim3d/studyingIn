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


	class ApiController extends BaseController{

		public function indexAction(){
			$strr = json_encode($_GET);
			echo($strr);
			exit(0);
		}

		public function getuinfoAction(){
			$user_id = $this->getRequest()->getParam('user_id',-1);

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
			$status['user_id'] = $this->getRequest()->getParam('user_id', -1);
			$status['status_uuid'] = 'status_'.UUID::v4();
			$status['status_post_date'] = date("Y-m-d H:i:s",time());
			$status['status_privilege'] = $this->getRequest()->getParam('status_privilege', 1);
			$status['status_content'] = $this->getRequest()->getParam('status_content', null);

			if (!isset($status['status_content'])) {
				$this->generate_error("empty status!");

			}else{
				$status_dao = new StudyingIn_Model_Status_Dao();
				$res = $status_dao->create_user_status($status);
				if($res == false){
					$this->generate_error("upload status failed!");
					//echo "{false}";
				}
				else{
					$resu['user_id'] = $res;
					$strr = json_encode($resu);

					echo $strr;
				}
			}
			exit(0);

		}

		/**
		*	generate universal error message using json
		*	@param: error message
		*	@return void
		*/
		private function generate_error($info){
			$res['Error'] = $info;
			$strr = json_encode($res);
			echo $strr;
			return ;
		}


	}






?>
