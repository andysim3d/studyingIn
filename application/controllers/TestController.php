<?php


	 require_once APPLICATION_PATH.'/models/Dao/User_Photo_Dao.php';



	class testSingle{

		private function __construct(){
			print "cons;";
		}

		private static $_instance;
		private static $counter;

		public function getInstance(){
			if (!isset(self::$counter)) {
				self::$counter = 0;
			}


			if (!isset(self::$_instance)) {
				$c = __CLASS__;
				self::$_instance = new $c;
				# code...
			}
			return self::$_instance;
		}

		public function print__(){
			print ("".strval(self::$counter));
			self::$counter ++;
		}
	}


class TestController extends BaseController {

	public function init() {
		/* Initialize action controller here */
	}

	public function indexAction() {
		// action body
		//  $up_dao = new studyingIn_Model_Up_Dao();
		// $up_dao->test();
		// // phpinfo();
		 // print_r( PDO::getAvailableDrivers()) ;

		$a = testSingle::getInstance();
		$b = testSingle::getInstance();
		for ($i=0; $i < 100 ; $i++) { 
			# code...
			$a->print__();
			echo "\t";
			$b->print__();
			echo "<br/>";
		}
		echo "It's for test.";
	}
	public function upAction() {
		// action body
		$up_dao = new StudyingIn_Model_User_Photo_Dao();
		$user['album_id'] = 2;
		$uuid['photo_name'] = "blog-be3549a0-62a7-4b22-ac1d-a311f9847342";
		echo "<pre>";
		($up_dao->upload_photo($user)) ;
		echo "</pre>";
		// $up_dao->test();
		// phpinfo();
		 // print_r( PDO::getAvailableDrivers()) ;
	}

}


?>
