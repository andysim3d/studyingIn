<?php
/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Photo_Form extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//photo_info
		$photo_info = $this->createElement('textarea', 'photo_info');
		$photo_info->addFilter('StringTrim')
		           ->addFilter('StripTags')
		           ->setRequired(false);

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