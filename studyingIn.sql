CREATE DATABASE studyingIn;

USE studyingIn;

CREATE TABLE users(
	user_id int primary key auto_increment,
	user_uuid varchar(64) not null,
	user_name nvarchar(32) not null default '',
	user_email varchar(32) not null default '',
	salt char(16) not null default '',
	user_saltedPassword varchar(64) not null default '',
	user_gender tinyint(1) not null default 1,/*1 for male,0 for female*/
	user_avatar nvarchar(128) not null default 'default_male.jpg',
	user_school varchar(256) not null default '',
	user_short_school varchar(32) not null default '',
	user_birth_year nvarchar(32) not null default '',
	user_birth_month nvarchar(32) not null default '',
	user_birth_day nvarchar(32) not null default '',  
	user_qq varchar(15) not null default '',
	user_wechat varchar(32) not null default '',
	user_weibo varchar(128) not null default '',
	user_facebook varchar(128) not null default '',
	user_twitter varchar(128) not null default '',
	user_country nvarchar(16) not null default '',
	user_province nvarchar(32) not null default '',
	user_city nvarchar(32) not null default '',
	user_introduction text,
	user_status tinyint(1) not null default 0,
	user_createTime int not null default 0,
	user_lastLoginTime int not null default 0,
	user_grade tinyint(1) not null default 1,/*permission grade*/
	user_level tinyint(8) not null default 1
)charset=utf8;
