<?php

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
}