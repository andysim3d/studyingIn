<?php

/**
*CREATE TABLE `studyingIn_user_blog` (
*  `user_id` int(11) NOT NULL,
*  `blog_uuid` varchar(64) NOT NULL DEFAULT '',
*  `blog_id` int(22) NOT NULL AUTO_INCREMENT,
*  `blog_title` text NOT NULL,
*  `blog_post_date` date NOT NULL,
*  `blog_privilege` tinyint(2) NOT NULL DEFAULT '1',
*  `blog_content` text,
*  PRIMARY KEY (`blog_id`),
*  KEY `user_id` (`user_id`),
*  CONSTRAINT `studyingIn_user_blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `studyingIn_user` (`user_id`) ON DELETE CASCADE
*) ENGINE=InnoDB AUTO_INCREMENT=1000000 DEFAULT CHARSET=utf8;
*
*	This file is a Dao for table 'studyingIn_user_blog'.
*/




class StudyingIn_Model_Blog_Dao extends Zend_Db_Table_Abstract {

	protected $_name = "studyingIn_user_blog";



}

?>