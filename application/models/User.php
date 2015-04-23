<?php

class studyingIn_Model_User {

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @var string
	 */
	protected $user_uuid;

	/**
	 * @var string
	 */
	protected $user_name;

	/**
	 * @var string
	 */
	protected $user_email;

	/**
	 * @var string
	 */
	protected $salt;

	/**
	 * @var string
	 */
	protected $user_saltedPassword;

	/**
	 * @var int
	 */
	protected $user_gender;

	/**
	 * @var string
	 */
	protected $user_avatar;

	/**
	 * @var string
	 */
	protected $user_school;

	/**
	 * @var string
	 */
	protected $user_short_school;

	/**
	 * @var string
	 */
	protected $user_birth_year;

	/**
	 * @var string
	 */
	protected $user_birth_month;

	/**
	 * @var string
	 */
	protected $user_birth_day;

	/**
	 * @var string
	 */
	protected $user_qq;

	/**
	 * @var string
	 */
	protected $user_wechat;

	/**
	 * @var string
	 */
	protected $user_weibo;

	/**
	 * @var string
	 */
	protected $user_facebook;

	/**
	 * @var string
	 */
	protected $user_twitter;

	/**
	 * @var string
	 */
	protected $user_country;

	/**
	 * @var string
	 */
	protected $user_province;

	/**
	 * @var string
	 */
	protected $user_city;

	/**
	 * @var string
	 */
	protected $user_introduction;

	/**
	 * @var int
	 */
	protected $user_status;

	/**
	 * @var int
	 */
	protected $user_createTime;

	/**
	 * @var int
	 */
	protected $user_lastLoginTime;

	/**
	 * @var int
	 */
	protected $user_grade;

	/**
	 * @var int
	 */
	protected $user_level;

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserId() {
		return $this->user_id;
	}

	/**
	 *
	 * @param int $user_id
	 */
	public function setUserId(int $user_id) {
		$this->user_id = $user_id;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserUuid() {
		return $this->user_uuid;
	}

	/**
	 *
	 * @param string $user_uuid
	 */
	public function setUserUuid(string $user_uuid) {
		$this->user_uuid = $user_uuid;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserName() {
		return $this->user_name;
	}

	/**
	 *
	 * @param string $user_name
	 */
	public function setUserName(string $user_name) {
		$this->user_name = $user_name;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserEmail() {
		return $this->user_email;
	}

	/**
	 *
	 * @param string $user_email
	 */
	public function setUserEmail(string $user_email) {
		$this->user_email = $user_email;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getSalt() {
		return $this->salt;
	}

	/**
	 *
	 * @param string $salt
	 */
	public function setSalt(string $salt) {
		$this->salt = $salt;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserSaltedpassword() {
		return $this->user_saltedPassword;
	}

	/**
	 *
	 * @param string $user_saltedPassword
	 */
	public function setUserSaltedpassword(string $user_saltedPassword) {
		$this->user_saltedPassword = $user_saltedPassword;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}*/
	public function getUserGender() {
		return $this->user_gender;
	}

	/**
	 *
	 * @param int $user_gender
	 */
	public function setUserGender(int $user_gender) {
		$this->user_gender = $user_gender;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserAvatar() {
		return $this->user_avatar;
	}

	/**
	 *
	 * @param string $user_avatar
	 */
	public function setUserAvatar(string $user_avatar) {
		$this->user_avatar = $user_avatar;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserSchool() {
		return $this->user_school;
	}

	/**
	 *
	 * @param string $user_school
	 */
	public function setUserSchool(string $user_school) {
		$this->user_school = $user_school;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserShortSchool() {
		return $this->user_short_school;
	}

	/**
	 *
	 * @param string $user_short_school
	 */
	public function setUserShortSchool(string $user_short_school) {
		$this->user_short_school = $user_short_school;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserBirthYear() {
		return $this->user_birth_year;
	}

	/**
	 *
	 * @param string $user_birth_year
	 */
	public function setUserBirthYear(string $user_birth_year) {
		$this->user_birth_year = $user_birth_year;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserBirthMonth() {
		return $this->user_birth_month;
	}

	/**
	 *
	 * @param string $user_birth_month
	 */
	public function setUserBirthMonth(string $user_birth_month) {
		$this->user_birth_month = $user_birth_month;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserBirthDay() {
		return $this->user_birth_day;
	}

	/**
	 *
	 * @param string $user_birth_day
	 */
	public function setUserBirthDay(string $user_birth_day) {
		$this->user_birth_day = $user_birth_day;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserQq() {
		return $this->user_qq;
	}

	/**
	 *
	 * @param string $user_qq
	 */
	public function setUserQq(string $user_qq) {
		$this->user_qq = $user_qq;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserWechat() {
		return $this->user_wechat;
	}

	/**
	 *
	 * @param string $user_wechat
	 */
	public function setUserWechat(string $user_wechat) {
		$this->user_wechat = $user_wechat;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserWeibo() {
		return $this->user_weibo;
	}

	/**
	 *
	 * @param string $user_weibo
	 */
	public function setUserWeibo(string $user_weibo) {
		$this->user_weibo = $user_weibo;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserFacebook() {
		return $this->user_facebook;
	}

	/**
	 *
	 * @param string $user_facebook
	 */
	public function setUserFacebook(string $user_facebook) {
		$this->user_facebook = $user_facebook;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserTwitter() {
		return $this->user_twitter;
	}

	/**
	 *
	 * @param string $user_twitter
	 */
	public function setUserTwitter(string $user_twitter) {
		$this->user_twitter = $user_twitter;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserCountry() {
		return $this->user_country;
	}

	/**
	 *
	 * @param string $user_country
	 */
	public function setUserCountry(string $user_country) {
		$this->user_country = $user_country;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserProvince() {
		return $this->user_province;
	}

	/**
	 *
	 * @param string $user_province
	 */
	public function setUserProvince(string $user_province) {
		$this->user_province = $user_province;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserCity() {
		return $this->user_city;
	}

	/**
	 *
	 * @param string $user_city
	 */
	public function setUserCity(string $user_city) {
		$this->user_city = $user_city;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}
	 */
	public function getUserIntroduction() {
		return $this->user_introduction;
	}

	/**
	 *
	 * @param string $user_introduction
	 */
	public function setUserIntroduction(string $user_introduction) {
		$this->user_introduction = $user_introduction;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}*/
	public function getUserStatus() {
		return $this->user_status;
	}

	/**
	 *
	 * @param int $user_status
	 */
	public function setUserStatus(int $user_status) {
		$this->user_status = $user_status;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}*/
	public function getUserCreatetime() {
		return $this->user_createTime;
	}

	/**
	 *
	 * @param int $user_createTime
	 */
	public function setUserCreatetime(int $user_createTime) {
		$this->user_createTime = $user_createTime;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}*/
	public function getUserLastlogintime() {
		return $this->user_lastLoginTime;
	}

	/**
	 *
	 * @param int $user_lastLoginTime
	 */
	public function setUserLastlogintime(int $user_lastLoginTime) {
		$this->user_lastLoginTime = $user_lastLoginTime;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}*/
	public function getUserGrade() {
		return $this->user_grade;
	}

	/**
	 *
	 * @param int $user_grade
	 */
	public function setUserGrade(int $user_grade) {
		$this->user_grade = $user_grade;
		return $this;
	}

	/**
	 *
	 * {@inheritDoc}*/
	public function getUserLevel() {
		return $this->user_level;
	}

	/**
	 *
	 * @param int $user_level
	 */
	public function setUserLevel(int $user_level) {
		$this->user_level = $user_level;
		return $this;
	}

}