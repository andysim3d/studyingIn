<?php


	require_once APPLICATION_PATH.'/models/Dao/Up_Dao.php';



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


class TestController extends Zend_Controller_Action {

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
		$up_dao = new studyingIn_Model_Up_Dao();
		$user['user_id'] = 1;
		$uuid = 1000;
		echo "<pre>";
		$res = ( ($up_dao->get_all_vote_user_by_uuid($uuid)) );
		 foreach ($res as $key) {
		 	echo $key['user_id']."\n";
		 }
		echo "</pre>";
		// $up_dao->test();
		// phpinfo();
		 // print_r( PDO::getAvailableDrivers()) ;
	}

}


?>
