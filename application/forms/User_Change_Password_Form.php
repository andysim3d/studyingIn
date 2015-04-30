<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Change_Password_Form extends Zend_Form {

	public function init() {

		//$this->setMethod('post');

		//old_password
		$old_password = $this->createElement('password', 'old_password');
		$old_password->addFilter('StringTrim')
		             ->setRequired(true)
		             ->addValidator('stringLength', false, array(6));

		//user_password
		$user_password = $this->createElement('password', 'user_password');
		$user_password->addFilter('StringTrim')
		              ->setRequired(true)
		              ->addValidator('stringLength', false, array(6));

		//confirm_password
		$confirm_password = $this->createElement('password', 'confirm_password');
		$confirm_password->setRequired(true)
		                 ->addValidator('identical', false, array('token' => 'user_password'));

		//user_remember
		//$user_remember = $this->createElement('checkbox', 'user_remember');

		// //captcha
		// $captcha = $this->createElement('text', 'captcha');
		// $captcha->setRequired(true);

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$old_password,
			$user_password,
			$confirm_password,
			//$captcha,
			$submit,
		));

	}

}
