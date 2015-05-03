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


	class BlogController extends BaseController{

		/**
		*	init 
		*/
		public function init(){
			
		}

		/**
		*	index, display all blogs write by user himself
		*	pass test	
		*/

		public function indexAction(){
			// $user_id = parent::$sess->user_id;
			$user_id = 1;
			$blog_dao = new StudyingIn_Model_User_Blog_Dao();
			$user = ['user_id' => $user_id];
			$articles = $blog_dao->get_blogs_by_user_id($user);
			$i = 0;
			// for ($i=0; $i < count($articles); $i++) { 
			// 	foreach ($articles[i] as $key => $value) {
			// 		echo "$key => $value <br/>";
			// 	}
			// }
			 print_r($articles);
			exit(0);
		}


		//pass

		public function newAction(){
			//should get from session.
			$user = ['user_id' => 1];

			$blog = array();
			//should get from $_POST
			$blog['blog_title'] = $this->getRequest()->getParam('blog_title', "nameless");
			$blog['blog_privilege'] = $this->getRequest()->getParam('blog_privilege', 1);
			$blog['blog_content'] = $this->getRequest()->getParam('blog_content', "");



			$blog_dao = new StudyingIn_Model_User_Blog_Dao();
			$blog_dao->post_blog($user, $blog);

			exit(0);

		}

		//pass
		public function articleAction(){
			$blog = array();
			$blog['blog_id'] = $this->getRequest()->getParam('blog_id', -1);
			print $blog['blog_id'];
			
			$blog_dao = new StudyingIn_Model_User_Blog_Dao();

			$res = $blog_dao->get_blog_by_blog_id($blog);
			
			print_r($res);
			exit(0);


		}

		public function editorAction(){
			//if blog_id == -1, new action
			$blog_id = $this->getRequest()->getParam('blog_id', -1);
			//else, edit action
		}

		public function editAction(){

			$blog_id = $this->getRequest()->getParam('blog_id', -1);
			$blog = array();
			//should get from $_POST
			$blog['blog_title'] = $this->getRequest()->getParam('blog_title', "nameless");
			$blog['blog_privilege'] = $this->getRequest()->getParam('blog_privilege', 1);
			$blog['blog_content'] = $this->getRequest()->getParam('blog_content', "");

			$blog_dao = new StudyingIn_Model_User_Blog_Dao();

			$res = $blog_dao->update_Blog_by_id($blog_id, $blog);
			
			print_r($res);
			exit(0);


		}

		//pass
		public function deleteAction(){

			$blog = array();
			$blog['blog_id'] = $this->getRequest()->getParam('blog_id', -1);
			print $blog['blog_id'];
			
			$blog_dao = new StudyingIn_Model_User_Blog_Dao();

			$res = $blog_dao->delete_by_blog_id($blog);
			
			print_r($res);
			exit(0);
		}



	}







?>