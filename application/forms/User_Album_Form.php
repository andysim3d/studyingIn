<?php
/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Album_Form extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//album_name
		$album_name = $this->createElement('text', 'album_name');
		$album_name->setRequired(true)
		           ->addFilter('StringTrim')
		           ->addFilter('StripTags');

		//album_privilege
		$album_privilege = $this->createElement('select', 'album_privilege');
		$album_privilege->setRequired(true);

		//album_info
		$album_info = $this->createElement('textarea', 'album_info');
		$album_info->setRequired(false);

		//captcha
		$captcha = $this->createElement('text', 'captcha');
		$captcha->setRequired(true);

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$album_name,
			$album_privilege,
			$album_info,
			$captcha,
			$submit,
		));
	}
}