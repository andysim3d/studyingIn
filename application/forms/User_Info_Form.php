<?php
/**
 *
 * @author Zhengwei
 *
 */

class StudyingIn_User_Info_Form extends Zend_Form {

	public function init() {

		$this->setMethod('post');

		//user_gender
		$user_gender = $this->createElement('radio', 'user_gender');
		$user_gender->setRequired(false)
		            ->addMultiOptions(array(
			            '1' => "男",
			            '0' => "女"));

		//user_avatar
		$user_avatar = $this->createElement('file', 'user_avatar');
		$user_avatar->setRequired(false);

		//user_birthday
		$user_birthday = $this->createElement('date', 'user_birthday');
		$user_birthday->setRequired(false);

		//user_qq
		$user_qq = $this->createElement('text', 'user_qq');
		$user_qq->setRequired(false)
		        ->addFilter('StringTrim')
		        ->addFilter('StripTags')
		        ->addFilter('int');

		//user_wechat
		$user_wechat = $this->createElement('text', 'user_wechat');
		$user_wechat->setRequired(false)
		            ->addFilter('StringTrim')
		            ->addFilter('StripTags');

		//user_weibo
		$user_weibo = $this->createElement('text', 'user_weibo');
		$user_weibo->setRequired(false)
		           ->addFilter('StringTrim')
		           ->addFilter('StripTags');

		//user_facebook
		$user_facebook = $this->createElement('text', 'user_facebook');
		$user_facebook->setRequired(false)
		              ->addFilter('StringTrim')
		              ->addFilter('StripTags');

		//user_twitter
		$user_twitter = $this->createElement('text', 'user_twitter');
		$user_twitter->setRequired(false)
		             ->addFilter('StringTrim')
		             ->addFilter('StripTags');

		//user_coountry
		$user_country = $this->createElement('select', 'user_country');
		$user_country->setRequired(false);

		//user_province
		$user_province = $this->createElement('select', 'user_province');
		$user_province->setRequired(false);

		//user_city
		$user_city = $this->createElement('select', 'user_city');
		$user_city->setRequired(false);

		//user_introduction
		$user_introduction = $this->createElement('textarea', 'user_introduction');
		$user_introduction->setRequired(false);

		$captcha = $this->createElement('text', 'captcha');
		$captcha->setRequired(true);

		//submit
		$submit = $this->createElement('submit', 'submit');

		// add all these elements to the form
		$this->addElements(array(
			$user_gender,
			$user_avatar,
			$user_birthday,
			$user_qq,
			$user_wechat,
			$user_weibo,
			$user_facebook,
			$user_twitter,
			$user_country,
			$user_province,
			$user_city,
			$user_introduction,
			$captcha,
			$submit,
		));
	}
}