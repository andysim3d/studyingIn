<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Login_Form extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//user_email
		$user_email = $this->createElement('text', 'user_email');
		$user_email->addFilter('StringTrim')
		           ->setRequired(true)
		           ->addFilter('StripTags')
		           ->addFilter('StringtoLower')
		           ->addValidator('EmailAddress');

		//user_password
		$user_password = $this->createElement('password', 'user_password');
		$user_password->addFilter('StringTrim')
		              ->setRequired(true)
		              ->addValidator('stringLength', false, array(6));

		//user_remember
		$user_remember = $this->createElement('checkbox', 'user_remember');

		//captcha
		$captcha = $this->createElement('text', 'captcha');
		$captcha->setRequired(true);

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$user_email,
			$user_password,
			$user_remember,
			$captcha,
			$submit,
		));

	}

}
