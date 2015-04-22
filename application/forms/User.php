<?php

class studyingIn_Form_User extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		$user_uuid = $this->createElement('text', 'user_uuid');

	}

}
