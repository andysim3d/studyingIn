<?php
/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Status_Form extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//status_privilege
		$status_privilege = $this->createElement('select', 'status_privilege');
		$status_privilege->setRequired(true);

		//status_content
		$status_content = $this->createElement('textarea', 'status_content');
		$status_content->addFilter('StringTrim')
		               ->addFilter('StripTags')
		               ->setRequired(true);

		//captcha
		$captcha = $this->createElement('text', 'captcha');
		$captcha->setRequired(true);

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$status_privilege,
			$status_content,
			$captcha,
			$submit,
		));
	}
}