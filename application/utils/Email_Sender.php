<?php

/**
 *
 * @author Zhengwei
 *
 */

class Email_Sender {

	public function sendActivationEmail($name, $email, $code) {

		$publicPath = PUBLIC_PATH;
		$pathArray = explode("/", $publicPath);

		$pathArrSize = count($pathArray);
		$pathArray[$pathArrSize - 1] = 'active';
		$newPath = implode("/", $pathArray);

		$validationcode = 'l=' . base64_encode($email . '#' . hash('sha1', $email . $code) . '#' . time());

		$mail = new Zend_mail('utf-8');
		$mail->addTo($email, $name);
		$mail->setSubject("StudyingIn注册验证");
		$mail->setFrom('info.studyingin@gmail.com', 'StudyingIn');
		$mail->setBodyHtml("亲爱的 <b>$name</b>,<br /><br />" .
			"非常感谢您注册StudyingIn.<br /><br />" .
			"请点击激活您的帐号:<br />" .
			"<a href='http://$newPath?$validationcode'><button style='width:200px;height:40px;background-color:#dc6dd;text-align:center;border:0;border-radius:3px;font-size:25px;'>激活</button></a>" .
			"<br /><br />如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br />如果此次激活请求非你本人所发，请忽略本邮件。<br /><br />再次感谢您注册StudyingIn。<br />StudyingIn 团队<br />", $charset = "utf-8");
		return $mail->send();
	}

	public function sendResetPasswordEmail($name, $email, $password) {

		$publicPath = PUBLIC_PATH;
		$pathArray = explode("/", $publicPath);
		$pathArrSize = count($pathArray);
		$pathArray[$pathArrSize - 1] = 'resetpasswordui';
		$newPath = implode("/", $pathArray);

		$validationcode = 'r=' . base64_encode($email . '#' . $password . '#' . time());

		$mail = new Zend_mail('utf-8');
		$mail->addTo($email);
		$mail->setSubject("StudyingIn找回密码");
		$mail->setBodyHtml("亲爱的 <b>$name</b>,<br /><br />" .
			"非常感谢您使用StudyingIn.<br /><br />" .
			"请点击链接重置您的密码:<br />" .
			"http://$newPath?$validationcode" .
			"<br /><br />如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br />如果此次激活请求非你本人所发，请忽略本邮件。<br /><br /> 再次感谢您使用StudyingIn。<br />StudyingIn 团队<br />", $charset = "utf-8");

		return $mail->send();
	}

	public function sendChangePasswordConfirmEmail($name, $email) {

		$mail = new Zend_mail('utf-8');
		$mail->addTo($email);
		$mail->setSubject("StudyingIn更改密码确认");
		$mail->setBodyHtml("亲爱的 <b>$name</b>,<br /><br />" .
			"您的StudyingIn账号 <em>$email</em> 的密码最近发生了修改。<br /><br />" .
			"如果更改是您自己所为，则无需执行进一步操作。<br /><br />" .
			"如果您并未更改自己的密码，则可能是有人入侵了您的帐户。要重新访问自己的帐户，您需要重新设置您的密码。<br /><br />" .
			"此致<br />StudyingIn 团队敬上<br />", $charset = "utf-8");

		return $mail->send();
	}

	public function sendErrorMessage($host_email, $user_info, $error_message) {

		$mail = new Zend_mail('utf-8');
		$mail->addTo($host_email);
		$mail->setSubject("Error Message");
		$mail->setBodyHtml("账号为$user_info 的用户在访问StudyingIn时，遇到了<br/><br/>" .
			"<b>$error_message</b><br/><br/>" .
			"请尽快解决", $charset = "utf-8");
		return $mail->send();
	}

}