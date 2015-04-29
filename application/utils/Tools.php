<?php

class Tools {

	/**
	 * make the salt
	 *
	 * @return string
	 */
	public static function generate_salt_16() {

		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$str = "";

		for ($i = 0; $i < 16; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}

		return $str;
	}

	//auto generate generate filename
	private static function generate_file_name(){
		try{
			return UUID::v4();
		}
		catch(Exception $e){

			throw $e;
			return false;
		}
	}
	/**
	*	@return false on transfer failed, otherwise filename.
	*
	*/
	private static function save_file($file_ext, $upload){
		try{
		// foreach ($$file_info as $file => $info) {
			$file_name = UUID::v4();
			$upload->addFilter('Rename', array('target'=> $file_name.$file_ext, 'override' => false));
			$res = $upload->reveive();
			// }
			return $res;
		}
		catch(Exception $e){
			return false;
		}
	}

	/**
	*	Get file extension name
	*	@param: file name
	*	@return extension name, or false on failed.
	*/
	public static function get_extension ($name){
		  
		if($name){

	        $exts = explode(".", $name) ;
	        $n = count($exts)-1;
	        $exts = $exts[$n];
	        return $exts;
	    }
	    return false;
	}



	private static function upload_file($upload= null){
		if (!isset($upload)) {
			$upload = new Zend_File_Transfer();
		}
		$file_info = $upload->getFileInfo();


	}

	/**
	*	Upload image
	*	@return false on failed, otherwise failed.
	*/
	public static function upload_img(){
		$upload = new Zend_File_Transfer();
		$upload->addValidator('Size', false, 5 * 1024 * 1024);
		$upload->addValidator('Extension', false, 'jpg,gif,png');
		if (!$upload->isValid()) {
			return false;
		}
		$file_info = $upload->getFileInfo();

		$upload->setDestination(UPLOAD_PATH);
		$file_name = $file_info['file']['name'];
		$ext = self::get_extension($file_name);
		return self::save_file($ext, $upload);

	}
}