<?php

class Tools {

	/**
	 * make the salt
	 *
	 * @return string
	 */
	public function generateSalt16() {

		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$str = "";

		for ($i = 0; $i < 16; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}

		return $str;
	}
}