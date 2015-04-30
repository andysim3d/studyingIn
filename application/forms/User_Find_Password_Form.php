<?php

/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Find_Password_Form extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//user_email
		$user_email = $this->createElement('text', 'user_email');
		$user_email->addFilter('StringTrim')
		           ->setRequired(true)
		           ->addFilter('StripTags')
		           ->addFilter('StringtoLower')
		           ->addValidator('EmailAddress');

		//captcha
		// $captcha = $this->createElement('text', 'captcha');
		// $captcha->setRequired(true);

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$user_email,
			//$captcha,
			$submit,
		));

	}

}
