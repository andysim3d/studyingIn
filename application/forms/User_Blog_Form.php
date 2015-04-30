<?php
/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Blog_Form extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//blog_title
		$blog_title = $this->createElement('text', 'blog_title');
		$blog_title->setRequired(true)
		           ->addFilter('StringTrim')
		           ->addFilter('StripTags');

		//blog_privilege
		$blog_privilege = $this->createElement('select', 'blog_privilege');
		$blog_privilege->setRequired(true);

		//blog_content
		$blog_content = $this->createElement('textarea', 'blog_content');
		$blog_content->addFilter('StringTrim')
		             ->addFilter('StripTags')
		             ->setRequired(true);

		//captcha
		$captcha = $this->createElement('text', 'captcha');
		$captcha->setRequired(true);

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$blog_title,
			$blog_privilege,
			$blog_content,
			$captcha,
			$submit,
		));
	}
}