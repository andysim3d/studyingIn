<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initMail() {

		try {
			$config = array(
				'auth' => 'login',
				'username' => 'info.studyingin@gmail.com',
				'password' => 'wocao,nixiangganshenme',
				'ssl' => 'tls',
				'port' => 587,
			);

			$mailTransport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
			Zend_Mail::setDefaultTransport($mailTransport);
		} catch (Exception $exc) {
			echo $exc->getMessage();
			echo "error"; //Do something with exception
		}
	}

	protected function _initView() {

		$view = new Zend_View();
		$view->doctype("HTML5");
		$view->headTitle("StudyingIn");
		$view->headLink(array('rel' => 'shortcut icon', 'href' => '/image/logo.ico'), 'PREPEND');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');

		return $view;
	}

}
