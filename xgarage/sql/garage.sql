#
# Table structure for table `garage`
#

CREATE TABLE `garage` (
  `id` int(11) NOT NULL auto_increment,
  `approved` tinyint(4) NOT NULL default '0',
  `viewable` tinyint(4) NOT NULL default '1',
  `disabled` tinyint(4) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `cid` int(11) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `uploadimage` varchar(255) NOT NULL default '',
  `imagechoice` tinyint(4) NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `location` varchar(75) NOT NULL default '',
  `make` varchar(75) NOT NULL default '',
  `model` varchar(75) NOT NULL default '',
  `year` varchar(75) NOT NULL default '',
  `engine` varchar(75) NOT NULL default '',
  `color` varchar(75) NOT NULL default '',
  `rt` varchar(75) NOT NULL default '',
  `sixty` varchar(75) NOT NULL default '',
  `three` varchar(75) NOT NULL default '',
  `eigth` varchar(75) NOT NULL default '',
  `eigthm` varchar(75) NOT NULL default '',
  `thou` varchar(75) NOT NULL default '',
  `quart` varchar(75) NOT NULL default '',
  `quartm` varchar(75) NOT NULL default '',
  `mengine` text NOT NULL,
  `mexterior` text NOT NULL,
  `minterior` text NOT NULL,
  `mrims` text NOT NULL,
  `mfuture` text NOT NULL,
  `maudio` text NOT NULL,
  `list` varchar(255) NOT NULL default '',
  `descript2` text,
  `linkgarage` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='xoops garage module';

# 
# Table structure for table `xoops_garage_cats`
# 

CREATE TABLE `garage_cats` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(75) NOT NULL default '',
  `gid` int(11) NOT NULL default '0',
  UNIQUE KEY `ID` (`cid`)
) TYPE=MyISAM COMMENT='garage categories';
