-- Generation Time: Jan 22, 2014 at 04:23 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.5

-- 
-- Table structure for table `allowedaccess`
-- 

DROP TABLE IF EXISTS `allowedaccess`;
CREATE TABLE IF NOT EXISTS `allowedaccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `hvzid` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;


-- 
-- Table structure for table `attendance`
-- 

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hvzid` varchar(7) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `m_day` tinyint(4) NOT NULL DEFAULT '0',
  `m_night` tinyint(1) NOT NULL DEFAULT '0',
  `t_day` tinyint(1) NOT NULL DEFAULT '0',
  `t_night` tinyint(1) NOT NULL DEFAULT '0',
  `w_day` tinyint(1) NOT NULL DEFAULT '0',
  `w_night` tinyint(1) NOT NULL DEFAULT '0',
  `th_day` tinyint(1) NOT NULL DEFAULT '0',
  `th_night` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `banned`
-- 

DROP TABLE IF EXISTS `banned`;
CREATE TABLE IF NOT EXISTS `banned` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `card` char(9) NOT NULL,
  `hvzid` varchar(7) NOT NULL,
  `firstname` char(35) NOT NULL,
  `lastname` char(30) NOT NULL,
  `username` char(25) NOT NULL,
  `reason` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `blog_comments`
-- 

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blogid` int(11) NOT NULL,
  `bloggerhvzid` varchar(7) NOT NULL,
  `postername` char(50) NOT NULL,
  `posterhvzid` varchar(7) NOT NULL,
  `posttime` int(11) NOT NULL,
  `posterip` int(11) NOT NULL,
  `postcontent` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


-- 
-- Table structure for table `blog_posts`
-- 

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `hvzid` varchar(7) NOT NULL,
  `title` char(50) NOT NULL,
  `blogcontent` text NOT NULL,
  `date` int(11) NOT NULL,
  `postip` int(11) NOT NULL,
  `commentlocked` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1172 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1172 ;

-- 
-- Table structure for table `boards`
-- 

DROP TABLE IF EXISTS `boards`;
CREATE TABLE IF NOT EXISTS `boards` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `description` text CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `numtopics` mediumint(8) unsigned NOT NULL,
  `numposts` mediumint(8) unsigned NOT NULL,
  `lastpost` int(11) NOT NULL,
  `permission` tinyint(1) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `content`
-- 

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `pagefor` char(10) NOT NULL,
  `context` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pagefor` (`pagefor`),
  FULLTEXT KEY `context` (`context`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `feedback`
-- 

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromwho` char(255) NOT NULL,
  `feedtext` text NOT NULL,
  `datestamp` int(11) NOT NULL,
  `ipaddr` int(11) NOT NULL,
  `hvzid` varchar(7) NOT NULL,
  `sid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `feedtext` (`feedtext`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Table structure for table `forums_categories`
-- 

DROP TABLE IF EXISTS `forums_categories`;
CREATE TABLE IF NOT EXISTS `forums_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `description` char(255) NOT NULL,
  `permission` char(7) NOT NULL DEFAULT 'general',
  `isreal` tinyint(1) DEFAULT '1',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `forums_categories`
-- 

INSERT DELAYED IGNORE INTO `forums_categories` (`id`, `name`, `description`, `permission`, `isreal`, `locked`) VALUES (1, 'Administrators', 'Administrator Talk!', 'admin', 1, 0),
(2, 'Humans', 'Discuss all forms of humanity here.', 'human', 1, 0),
(3, 'Zombies', 'Discuss all the undead stuff here.', 'zombie', 1, 0),
(4, 'General', 'Anything random and general', 'general', 1, 0),
(5, 'Forum Rules', 'Any Forum Rules. Read these.', 'general', 1, 0),
(6, 'Website Problems', 'Any problems with the website, post here.', 'general', 1, 0);

--
-- Table structure for table `forums_posts`
-- 

DROP TABLE IF EXISTS `forums_posts`;
CREATE TABLE IF NOT EXISTS `forums_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postername` char(255) NOT NULL,
  `posterhvzid` varchar(7) NOT NULL,
  `posttime` int(11) NOT NULL,
  `posterip` int(11) NOT NULL,
  `threadid` int(11) NOT NULL,
  `postcontent` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2576 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2576 ;

-- 
-- Table structure for table `forums_reported`
-- 

DROP TABLE IF EXISTS `forums_reported`;
CREATE TABLE IF NOT EXISTS `forums_reported` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `hvzid` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Table structure for table `forums_threads`
-- 

DROP TABLE IF EXISTS `forums_threads`;
CREATE TABLE IF NOT EXISTS `forums_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `category` int(11) NOT NULL,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) DEFAULT '0',
  `lastposttime` int(11) NOT NULL,
  `lastposter` char(255) NOT NULL,
  `startbyname` char(50) NOT NULL,
  `starttime` int(11) NOT NULL,
  `viewnum` int(11) NOT NULL DEFAULT '1',
  `replynum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=592 DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=592 ;

-- 
-- Table structure for table `friends`
-- 

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hvzid1` varchar(7) NOT NULL,
  `hvzid2` varchar(7) NOT NULL,
  `datestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Table structure for table `homecomments`
-- 

DROP TABLE IF EXISTS `homecomments`;
CREATE TABLE IF NOT EXISTS `homecomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hvzid` varchar(7) NOT NULL,
  `poster` char(50) NOT NULL,
  `datestamp` int(11) NOT NULL,
  `commenttext` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

-- 
-- Table structure for table `hvzids`
-- 

DROP TABLE IF EXISTS `hvzids`;
CREATE TABLE IF NOT EXISTS `hvzids` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `hvzid` char(7) NOT NULL,
  `username` char(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `imagecomments`
-- 

DROP TABLE IF EXISTS `imagecomments`;
CREATE TABLE IF NOT EXISTS `imagecomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgname` char(255) NOT NULL,
  `posterhvzid` varchar(7) NOT NULL,
  `postername` char(255) NOT NULL,
  `postcontent` text NOT NULL,
  `posterip` int(11) NOT NULL,
  `posttime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Table structure for table `kills`
-- 

DROP TABLE IF EXISTS `kills`;
CREATE TABLE IF NOT EXISTS `kills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `z_hvzid` varchar(7) NOT NULL,
  `h_hvzid` varchar(7) NOT NULL,
  `time` int(11) NOT NULL,
  `killplace` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=738 DEFAULT CHARSET=latin1 AUTO_INCREMENT=738 ;

-- 
-- Table structure for table `kills2`
-- 

DROP TABLE IF EXISTS `kills2`;
CREATE TABLE IF NOT EXISTS `kills2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `z_hvzid` varchar(7) NOT NULL,
  `totalkills` mediumint(9) NOT NULL,
  `firstname` char(30) NOT NULL,
  `lastname` char(30) NOT NULL,
  `lastkilltime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=199 DEFAULT CHARSET=latin1 AUTO_INCREMENT=199 ;

-- 
-- Table structure for table `logins`
-- 

DROP TABLE IF EXISTS `logins`;
CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hvzid` varchar(7) NOT NULL,
  `ipaddr` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `useragent` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11212 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11212 ;

-- 
-- Table structure for table `map_human`
-- 

DROP TABLE IF EXISTS `map_human`;
CREATE TABLE IF NOT EXISTS `map_human` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `details` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 
-- Table structure for table `map_zombie`
-- 

DROP TABLE IF EXISTS `map_zombie`;
CREATE TABLE IF NOT EXISTS `map_zombie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `details` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `marketplace`
-- 

DROP TABLE IF EXISTS `marketplace`;
CREATE TABLE IF NOT EXISTS `marketplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hvzid` varchar(7) NOT NULL,
  `name` char(50) NOT NULL,
  `title` char(25) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `timepost` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `isforsale` tinyint(1) DEFAULT '1',
  `ipaddr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `descr` (`descr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `marketplace_cat`
-- 

DROP TABLE IF EXISTS `marketplace_cat`;
CREATE TABLE IF NOT EXISTS `marketplace_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(25) NOT NULL,
  `descr` text NOT NULL,
  `createby` varchar(7) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `descr` (`descr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `members`
-- 

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `betatest` tinyint(1) DEFAULT '0',
  `proimg` char(255) DEFAULT 'default.jpg',
  `aboutme` text NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notifications` tinyint(4) DEFAULT '0',
  `personalkey` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL DEFAULT 'X',
  `birthday` int(20) NOT NULL,
  `hvzid` varchar(8) NOT NULL,
  `hvzidext` mediumint(3) NOT NULL,
  `permissions` char(8) NOT NULL DEFAULT '1,0,0,1',
  `isplaying` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) DEFAULT '0',
  `human` tinyint(1) NOT NULL DEFAULT '1',
  `human_squad` mediumint(9) NOT NULL DEFAULT '1',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `superadmin` smallint(1) NOT NULL DEFAULT '0',
  `oz` tinyint(1) NOT NULL DEFAULT '0',
  `ozchoice` tinyint(1) NOT NULL DEFAULT '0',
  `gamekillnum` tinyint(4) NOT NULL DEFAULT '0',
  `totkillnum` smallint(6) NOT NULL DEFAULT '0',
  `datereg` bigint(20) NOT NULL,
  `email` tinytext NOT NULL,
  `phone` bigint(10) NOT NULL,
  `lastonline` bigint(20) unsigned NOT NULL,
  `gamesplayed` int(2) NOT NULL DEFAULT '0',
  `hideemail` tinyint(1) NOT NULL DEFAULT '0',
  `hidephone` tinyint(1) NOT NULL DEFAULT '1',
  `aim` tinytext,
  `yahoo` tinytext,
  `msn` char(20) DEFAULT NULL,
  `skype` char(20) DEFAULT NULL,
  `showyimsn` tinyint(1) DEFAULT '0',
  `showaim` tinyint(1) DEFAULT '0',
  `showmsn` tinyint(1) DEFAULT '0',
  `showskype` tinyint(1) DEFAULT '0',
  `paydues` tinyint(1) NOT NULL DEFAULT '0',
  `secretq` tinytext NOT NULL,
  `secreta` varchar(64) NOT NULL,
  `signature` text,
  `messages` int(4) NOT NULL DEFAULT '0',
  `postcount` int(7) NOT NULL DEFAULT '0',
  `useragent` char(255) NOT NULL,
  `ipaddress` varchar(15) NOT NULL,
  `ipaddress2` varchar(15) DEFAULT NULL,
  `ipaddress3` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`hvzid`),
  KEY `id` (`id`,`firstname`,`lastname`,`human`),
  FULLTEXT KEY `aboutme` (`aboutme`)
) ENGINE=MyISAM AUTO_INCREMENT=958 DEFAULT CHARSET=latin1 AUTO_INCREMENT=958 ;

-- 
-- Table structure for table `messages`
-- 

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `tohvzid` varchar(7) NOT NULL,
  `fromhvzid` varchar(7) NOT NULL,
  `msgtext` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `viewed` tinyint(1) DEFAULT '0',
  `receiveshow` tinyint(1) DEFAULT '1',
  `sendshow` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1011 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1011 ;

-- 
-- Table structure for table `missions`
-- 

DROP TABLE IF EXISTS `missions`;
CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` tinyint(1) NOT NULL,
  `missiondetails` text NOT NULL,
  `human` tinyint(1) NOT NULL,
  `posterhvzid` varchar(7) NOT NULL,
  `currentgame` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Table structure for table `notifications`
-- 

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hvzid` varchar(7) NOT NULL,
  `notiftime` int(11) NOT NULL,
  `bywhohvzid` varchar(7) NOT NULL,
  `bywhoname` char(60) NOT NULL,
  `notifwhere` varchar(255) NOT NULL,
  `notiftext` text NOT NULL,
  `notiflink` varchar(255) NOT NULL,
  `viewed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1050 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1050 ;

-- 
-- Table structure for table `outsidelinks`
-- 

DROP TABLE IF EXISTS `outsidelinks`;
CREATE TABLE IF NOT EXISTS `outsidelinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hvzid` varchar(7) NOT NULL,
  `sid` char(255) NOT NULL,
  `referrer` tinytext NOT NULL,
  `outto` tinytext NOT NULL,
  `datetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=447 DEFAULT CHARSET=latin1 AUTO_INCREMENT=447 ;

-- 
-- Table structure for table `paydues`
-- 

DROP TABLE IF EXISTS `paydues`;
CREATE TABLE IF NOT EXISTS `paydues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` char(20) NOT NULL,
  `lastname` char(20) NOT NULL,
  `hvzid` varchar(7) NOT NULL,
  `receipt` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `profilecomments`
-- 

DROP TABLE IF EXISTS `profilecomments`;
CREATE TABLE IF NOT EXISTS `profilecomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profileid` varchar(7) NOT NULL,
  `postername` char(50) NOT NULL,
  `posterhvzid` varchar(7) NOT NULL,
  `commenttext` text NOT NULL,
  `posttime` int(11) NOT NULL,
  `ipaddr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

-- 
-- Table structure for table `uploadedimages`
-- 

DROP TABLE IF EXISTS `uploadedimages`;
CREATE TABLE IF NOT EXISTS `uploadedimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specid` varchar(10) NOT NULL,
  `hvzid` varchar(7) NOT NULL,
  `imagename` char(255) NOT NULL,
  `imgcaption` text,
  `uploadtime` int(11) NOT NULL,
  `album` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `imagename` (`imagename`)
) ENGINE=MyISAM AUTO_INCREMENT=486 DEFAULT CHARSET=latin1 AUTO_INCREMENT=486 ;
