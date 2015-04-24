<?php

header("Content-type: text/html;charset=utf-8");
require_once APPLICATION_PATH . '/utils/UUID.php';
require_once APPLICATION_PATH . '/utils/Email_Sender.php';
require_once APPLICATION_PATH . '/models/Dao/User_Dao.php';
require_once APPLICATION_PATH . '/models/Dao/User_Info_Dao.php';
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
		$formRegister = new studyingIn_Form_User();
		$formRegister->removeElement('salt');
		$formRegister->removeElement('user_uuid');
		$formRegister->removeElement('user_actived');
		//$formRegister->removeElement('user_remember');
		$this->view->formRegister = $formRegister;

		if ($this->getRequest()->isPost()) {

			if ($formRegister->isValid($_POST)) {
				$userData = $formRegister->getValues();
			} else {
				$this->view->info = 1;
				$this->_forward('err', 'global');
			}

			$userData['user_uuid'] = 'user-' . UUID::v4();
			$userDao = new studyingIn_Model_User_Dao();
			$newUser_id = $userDao->create_user($userData);

			$userInfo = $userData;
			unset($userInfo['salt']);
			unset($userInfo['user_password']);
			unset($userInfo['confirm_password']);
			unset($userInfo['user_actived']);
			$userInfo['user_id'] = $newUser_id;
			$userInfo['user_introduction'] = "该用户很懒，暂时什么都没有留下。";
			$userInfo['user_create_time'] = date("Y-m-d H:i:s", time());

			$userInfoDao = new studyingIn_Model_User_Info_Dao();
			$newUserInfo = $userInfoDao->create_user_info($userInfo);

			if ($newUser_id && $newUserInfo) {
				$sendActiveEmail = Email_Sender::sendActivationEmail($userData['user_name'], $userData['user_email'], $userData['salt']);
				if ($sendActiveEmail) {
					//TODO: jump to the index/index, and alert('we have send you a confirm email, please active your account with the url in the email ASAP.')
					$this->view->info = 1;
					$this->_forward('ok', 'global');
				}
			}

		}

	}

	public function activeAction() {
		// action body
		$rcode = base64_decode($this->getRequest()->getParam('l', ''));
		list($email, $code, $time) = explode('#', $rcode);

		$userDao = new studyingIn_Model_User_Dao();
		$where = array('user_email' => $email);
		$user = $userDao->get_user($where);

		if (!$user || $code != hash('sha1', $email . $user['salt'])) {
			throw new Exception("Incorrect validation code!");
		} else {
			if (time() > ($time + 60 * 60 * 24)) {
				//TODO:the email is over time...
			} else {
				$userDap->active_user_by_user_id($user['user_id']);
				session_start();
				$_SESSION['user_id'] = $user['user_id'];
				$this->_redirect('user/account/id/' . $id);
				//TODO:jump to the home page
			}
		}
	}

	public function loginAction() {

		$formRegister = new studyingIn_Form_User();
		$formRegister->removeElement('user_id');
		$formRegister->removeElement('user_name');
		$formRegister->removeElement('user_school');
		$formRegister->removeElement('salt');
		$formRegister->removeElement('user_uuid');
		$formRegister->removeElement('user_actived');
		$formRegister->removeElement('confirm_password');
		$this->view->formRegister = $formRegister;

		if ($this->getRequest()->isPost()) {

			if ($formRegister->isValid($_POST)) {
				$userData = $formRegister->getValues();
			}

			$userDao = new studyingIn_Model_User_Dao();
			$user = $userDao->get_user(array('user_email' => $userData['user_email']));
		}

	}

	public function logoutAction() {
		// action body
	}

}
