-- 
-- Table `tl_user`
-- 

CREATE TABLE `tl_user` (
  `tstamp` int(10) unsigned NOT NULL default '0',
  `pwChangeTstamp` int(10) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_pw_history`
-- 

CREATE TABLE `tl_pw_history` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `password` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------