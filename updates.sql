create database testproject;
use testproject;
 CREATE TABLE `user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL,  
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`userid`),
  UNIQUE (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

insert into user set email='testid40@gmail.com', password=UNHEX(MD5('qwedsa123');