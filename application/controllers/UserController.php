<?php

header("Content-type: text/html;charset=utf-8");
require_once APPLICATION_PATH . '/controllers/BaseController.php';
require_once APPLICATION_PATH . '/utils/UUID.php';
require_once APPLICATION_PATH . '/utils/Email_Sender.php';
require_once APPLICATION_PATH . '/utils/Tools.php';
require_once APPLICATION_PATH . '/models/Dao/User_Dao.php';
require_once APPLICATION_PATH . '/models/Dao/User_Info_Dao.php';
require_once APPLICATION_PATH . '/forms/User_Register_Form.php';
require_once APPLICATION_PATH . '/forms/User_Login_Form.php';
require_once APPLICATION_PATH . '/forms/User_Find_Password_Form.php';
require_once APPLICATION_PATH . '/forms/User_Reset_Password_Form.php';
require_once APPLICATION_PATH . '/forms/User_Change_Password_Form.php';

class UserController extends Zend_Controller_Action {

	public function init() {
		/* Initialize action controller here */
	}

	public function indexAction() {
		// action body

	}

	/**
	 * register
	 *
	 */
	public function registerAction() {

		$register_form = new StudyingIn_User_Register_Form();

		if ($this->getRequest()->isPost()) {

			if ($register_form->isValid($_POST)) {
				$user_data = $register_form->getValues();
			} else {
				$this->view->info = 1;
				$this->_forward('err', 'global');
			}

			$user_dao = new StudyingIn_Model_User_Dao();
			// $user_email_exist = $user_dao->check_user_existence_by_user_email($user_data['user_email']);
			// $user_name_exist = $user_dao->check_user_existence_by_user_name($user_data['user_name']);

			if (!$user_name_exist && !$user_email_exist) {
				$new_user = $user_dao->create_new_user($user_data);

				//create the user_info, and save to studyingIn_user_info
				foreach ($new_user as $key => $value) {
					$user_info[$key] = $value;
				}

				$user_info_dao = new StudyingIn_Model_User_Info_Dao();
				$new_user_info = $user_info_dao->create_new_user_info($user_info);

				if (count($new_user) != 0 && $new_user_info) {

					$send_active_email = Email_Sender::sendActivationEmail($new_user['user_name'], $new_user['user_email'], $new_user['salt']);
					$this->view->info = 1;
					$this->_forward('ok', 'global');
				}
			} else {
				$this->view->info = 10;
				$this->_forward('err', 'global');
			}
		}

	}

	/**
	 *
	 * active
	 *
	 */

	public function activeAction() {

		$rcode = base64_decode($this->getRequest()->getParam('l', ''));
		list($email, $code, $time) = explode('#', $rcode);

		$user_dao = new StudyingIn_Model_User_Dao();
		$user = $user_dao->get_user_by_user_email($email);

		if (count($user) != 0) {
			if ($user[0]['user_actived'] == 0) {
				if ($code != hash('sha1', $user[0]['user_email'] . $user[0]['salt'])) {
					//throw new Exception("Incorrect validation code!");
					$this->view->info = 8;
					$this->_forward("err", "global");
				} else {
					if (time() > ((int) $time + 60 * 60 * 24)) {
						$this->view->info = 6;
						$this->view->id = $user[0]['user_id'];
						$this->view->uuid = $user[0]['user_uuid'];
						$this->_forward("err", "global");
					} else {
						$ok = $user_dao->active_user_by_user_id($user[0]['user_id']);
						if ($ok) {
							$sess = new Zend_Session_Namespace();
							$sess->user_id = $user[0]['user_id'];
							$this->_redirect('/index/index');
						}
					}
				}
			} else {
				$this->view->info = 7;
				$this->_forward("err", "global");
			}
		} else {
			$this->view->info = 8;
			$this->_forward("err", "global");
		}
	}

	/**
	 *
	 * login
	 *
	 */

	public function loginAction() {

		$login_form = new StudyingIn_User_Login_Form();

		if ($this->getRequest()->isPost()) {

			if ($login_form->isValid($_POST)) {
				$user_data = $login_form->getValues();

				// if ($user_data['user_remember'] == 0) {
				// 	if (isset($_COOKIE['email'])) {
				// 		setcookie('email', $user_email, time() - 100, '/', 'studyingin.com', false, true);
				// 	}
				// } else {
				// 	setcookie('email', $user_email, time() + 2 * 7 * 24 * 3600, '/', 'studyingin.com', false, true);
				// }

				$user_dao = new StudyingIn_Model_User_Dao();
				$user = $user_dao->get_user_by_user_email($user_data['user_email']);

				if (count($user) != 0) {
					$salted_password = hash('sha256', $user_data['user_password'] . $user[0]['salt']);
					if ($salted_password != $user[0]['user_password']) {
						//密码错误
						$this->view->info = 4;
						$this->_forward('err', 'global');
					} else if ($user[0]['user_actived'] == 0) {
						//尚未激活
						$this->view->info = 5;
						$this->view->id = $user[0]['user_id'];
						$this->view->uuid = $user[0]['user_uuid'];
						$this->_forward('err', 'global');
					} else {
						//登陆成功
						$sess = new Zend_Session_Namespace();
						$sess->user_id = $user[0]['user_id'];
						$this->view->info = 2;
						$this->_forward('ok', 'global');
					}
				} else {
					//账号错误或尚未注册
					$this->view->info = 3;
					$this->_forward('err', 'global');
				}
			} else {
				//输入格式错误
				$this->view->info = 2;
				$this->_forward('err', 'global');
			}
		}

	}

	/**
	 * resend confirm email
	 *
	 */

	public function resendactiveemailAction() {

		$id = $this->getRequest()->getParam('uid', '');
		$uuid = $this->getRequest()->getParam('id', '');
		$user_dao = new StudyingIn_Model_User_Dao();
		$user = $user_dao->get_user_by_user_id($id);
		if (count($user) != 0) {
			if ($uuid != $user[0]['user_uuid']) {
				$this->view->info = 9;
				$this->_forward('err', 'global');
			} else {
				$send_active_email = Email_Sender::sendActivationEmail($user[0]['user_name'], $user[0]['user_email'], $user[0]['salt']);
				$this->view->info = 1;
				$this->_forward('ok', 'global');
			}
		} else {
			$this->view->info = 9;
			$this->_forward('err', 'global');
		}
	}

	/**
	 * logout
	 *
	 */
	public function logoutAction() {
		// action body
		Zend_Session::destroy();

	}

	/**
	 *
	 * find password
	 *
	 */
	public function findpasswordAction() {

		$find_password_form = new StudyingIn_User_Find_Password_Form();
		if ($this->getRequest()->isPost()) {
			if ($find_password_form->isValid($_POST)) {
				$user_data = $find_password_form->getValues();
				$user_dao = new StudyingIn_Model_User_Dao();
				$user = $user_dao->get_user_by_user_email($user_data['user_email']);
				if (count($user) != 0) {
					$send_reset_password_email = Email_Sender::sendResetPasswordEmail($user[0]['user_name'], $user_data['user_email'], $user[0]['user_password']);
					$this->view->info = 4;
					$this->_forward('ok', 'global');
				} else {
					echo "string";
				}
			} else {
				$this->view->info = 11;
				$this->_forward('err', 'global');
			}

		}
	}

	/**
	 *
	 * reset password ui
	 *
	 */
	public function resetpassworduiAction() {

		$rcode = base64_decode($this->getRequest()->getParam('r', ''));
		list($email, $password, $time) = explode('#', $rcode);
		// echo $email . '<br>' . $password . '<br>' . $time;
		// exit;

		if (time() > (int) $time + 24 * 60 * 60) {
			$this->view->info = 12;
			$this->_forward('err', 'global');
		}
		$user_dao = new StudyingIn_Model_User_Dao();
		$user = $user_dao->get_user_by_user_email($email);
		if (count($user) != 0) {
			if ($password != $user[0]['user_password']) {
				$this->view->info = 13;
				$this->_forward('err', 'global');
			}
			$this->view->id = $user[0]['user_uuid'];
			$this->view->email = $email;
		} else {
			$this->view->info = 9;
			$this->_forward('err', 'global');
		}

	}

	/**
	 *
	 * reset password
	 *
	 */
	public function resetpasswordAction() {

		$uuid = $this->getRequest()->getParam('r', '');

		$rest_password_form = new StudyingIn_User_Reset_Password_Form();
		if ($this->getRequest()->isPost()) {
			if ($rest_password_form->isValid($_POST)) {
				$user_data = $rest_password_form->getValues();
			} else {
				$this->view->info = 14;
				$this->_forward('err', 'global');
			}
			$user_dao = new StudyingIn_Model_User_Dao();
			$user = $user_dao->get_user_by_user_email($user_data['user_email']);

			if (count($user) != 0) {
				if ($user[0]['user_uuid'] == $uuid) {
					$ok = $user_dao->update_password_by_user_email($user_data['user_password'], $user[0]['salt'], $user_data['user_email']);
					if ($ok) {
						$this->view->info = 5;
						$this->_forward('ok', 'global');
					} else {
						$this->view->info = 15;
						$this->_forward('err', 'global');

					}
				} else {
					$this->view->info = 15;
					$this->_forward('err', 'global');
				}

			} else {
				$this->view->info = 15;
				$this->_forward('err', 'global');
			}
		}
	}

	/**
	 *
	 * change password ui
	 *
	 */
	public function changepassworduiAction() {

	}

	/**
	 *
	 * change password
	 *
	 */
	public function changepasswordAction() {

		$change_password_form = new StudyingIn_User_Change_Password_Form();

		if ($this->getRequest()->isPost()) {
			if ($change_password_form->isValid($_POST)) {
				$data = $change_password_form->getValues();
			} else {
				$this->view->info = 16;
				$this->_forward('err', 'global');
			}
		}
		$sess = new Zend_Session_Namespace();
		$user_id = $sess->user_id;

		$user_dao = new StudyingIn_Model_User_Dao();
		$user = $user_dao->get_user_by_user_id($user_id);

		if (count($user) != 0) {
			if ($user_dao->authenticate_user_by_password($data['old_password'], $user[0]['salt'], $user[0]['user_password'])) {
				$ok = $user_dao->update_password_by_user_email($data['user_password'], $user[0]['salt'], $user[0]['user_email']);
				if ($ok) {

					$this->view->info = 6;
					$this->_forward('ok', 'global');
				} else {
					$this->view->info = 17;
					$this->_forward('err', 'global');
				}
			} else {
				$this->view->info = 17;
				$this->_forward('err', 'global');
			}
		} else {
			$this->view->info = 17;
			$this->_forward('err', 'global');
		}
	}

}
?>
