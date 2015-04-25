<?php

class Validator {



	static function user_validate($user){
		if (!isset($user['user_id'])) {
			return false;
			# code...
		}
		return true;
	}

	static function blog_validate($blog){
		if (!isset($blog['blog_title'])) {
			return false;
		}
		return true;
	}

}









?>