<?php

header("Content-type: text/html;charset=utf-8");
require_once APPLICATION_PATH . '/utils/UUID.php';
require_once APPLICATION_PATH . '/medels/Dao/UserDao.php';
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
		$this->view->formRegister = $formRegister;

		if ($this->getRequest()->isPost()) {

			if ($formRegister->isValid($_POST)) {
				$userData = $formRegister->getValues();
			}

			$userData['user_uuid'] = UUID::v4();

			$userInfo = $userData;
			$userInfo[]
			$userDao = new studyingIn_Model_UserDao();
			$newUser = $user->createUser($userData);
			if ($newUser) {
				$this->_sendActivationEmail($userData['user_name'], $userData['user_email'], $userData['salt']);
			}
		}

	}

	protected function _sendActivationEmail($name, $email, $code) {

		$publicPath = PUBLIC_PATH;
		$pathArray = explode("/", $publicPath);

		$pathArrSize = count($pathArray);
		$pathArray[$pathArrSize - 1] = 'active';
		$newPath = implode("/", $pathArray);

		$userDao = new UserDao();
		$user = new User();
		$user_activeTime = $userDao->updateActiveTimeByEmail($email);
		$validationcode = 'l=' . base64_encode($email . '#' . hash('sha1', $email . $code) . '#' . $user_activeTime);

		$mail = new Zend_mail('utf-8');
		$mail->addTo($email, $name);
		$mail->setSubject("StudyingIn注册验证");
		$mail->setFrom('info.studyingin@gmail.com', 'StudyingIn');
		$mail->setBodyHtml("亲爱的 <b>$name</b>,<br />" .
			"非常感谢您注册StudyingIn.<br /><br />" .
			"请点击链接激活您的帐号:<br />" .
			"http://$newPath?$validationcode<br />" .
			"如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br />如果此次激活请求非你本人所发，请忽略本邮件。<br /><br />再次感谢您注册StudyingIn。<br />StudyingIn 团队<br />", $charset = "utf-8");
		return $mail->send();
	}

	public function activeAction() {
		// action body
		$userdao = new UserDao();
		$rcode = base64_decode($this->getRequest()->getParam('l', ''));
		list($email, $code, $user_activeTime) = explode('#', $rcode);

		$user = new User();
		$ok = $userdao->findUserByUser_email($email, $user);
		$userInfo = array('user_id' => $user->getUser_id(),
			'user_name' => $user->getUser_name(),
			'user_email' => $user->getUser_email(),
			'user_school' => $user->getUser_school(),
			'user_grade' => $user->getUser_grade(),
			'user_status' => $user->getUser_status(),
			'whatever' => $user->getsalt());
		if (!$ok || $code != hash('sha1', $email . $user->getSalt())) {
			throw new Exception("Incorrect validation code!");
		} else {
			if (time() > ($user_activeTime + 60 * 60 * 24)) {
				$this->view->info = 7;
				$this->_forward('err', 'global');
			} else {
				$user->isActive();
				$userdao->updateUser_statusByUser_id($user->getUser_id(), $user->getUser_status());
				session_start();
				$_SESSION['user'] = $userInfo;
				$this->view->info = 6;
				$this->_forward('ok', 'global');
			}
		}
	}

	public function loginAction() {
		// action body
	}

	public function logoutAction() {
		// action body
	}

	public function refreshcaptchaAction() {
		// action body
	}

}
