<?php

class studyingIn_Form_User extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//user_uuid
		$user_name = $this->createElement('text', 'user_uuid');

		//user_name
		$user_name = $this->createElement('text', 'user_name');
		$user_name->setLabel('用户名: ')
		          ->setRequired(true)
		          ->addFilter('StringTrim')
		          ->addFilter('StripTags');

		//user_email
		$user_email = $this->createElement('text', 'user_email');
		$user_email->setLabel('电子邮件: ')
		           ->setRequired(true)
		           ->addFilter('StringTrim')
		           ->addFilter('StripTags')
		           ->addFilter('StringtoLower')
		           ->addValidator('EmailAddress')

		//salt
		$salt = $this->createElement('text', 'salt');

		//user_password
		$user_password = $this->createElement('password', 'user_password');
		$user_password->setLabel('密码: ')
		              ->setRequired(true)
		              ->addFilter('StringTrim')
		              ->addValidator('stringLength', false, array(6))

		//confirm_password
		$confirm_password = $this->createElement('password', 'confirm_password');
		$confirm_password->setLabel('确认密码: ')
		                 ->setRequired(true)
		                 ->addValidator('identical', false, array('token' => 'user_password'))

		//user_school
		$user_school = $this->createElement('select', 'user_school');
		$user_school->setLabel('学校: ')
		            ->setRequired(true)
		            ->addMultiOptions(array(
			            ' ' => '----',
			            'Stevens Institute of Technology' => 'Stevens Institute of Technology',
			            'other' => 'other',
		            ));

		//user_actived
		$user_actived = $this->createElement('radio', 'user_actived');
		$user_actived->addMultiOptions(array(
			0 => '未激活',
			1 => '已激活',
		));

		//$user_remember = $this->createElement('checkbox','user_remember');

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$user_uuid,
			$user_name,
			$user_email,
			$salt,
			$user_password,
			$confirm_password,
			$user_school,
			$user_actived,
			//$user_remember,
			$submit,
		));

	}

}
