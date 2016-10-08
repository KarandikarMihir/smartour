DROP TABLE IF EXISTS activitylog;

CREATE TABLE `activitylog` (
  `srno` int(11) NOT NULL,
  `activity` text,
  `timestamp` text,
  `username` text,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS application;

CREATE TABLE `application` (
  `srno` int(11) NOT NULL,
  `appdate` date DEFAULT NULL,
  `name` text,
  `address` text,
  `landline` text,
  `mobile` text,
  `hotelname` text,
  `roomtype` text,
  `paxnos` int(11) DEFAULT NULL,
  `roomnos` int(11) DEFAULT NULL,
  `chkin` date DEFAULT NULL,
  `chkout` date DEFAULT NULL,
  `nightsnos` int(11) DEFAULT NULL,
  `confirmedwith` text,
  `bookingamt` double DEFAULT NULL,
  `scharge` double DEFAULT NULL,
  `stax` double DEFAULT NULL,
  `ltax` double DEFAULT NULL,
  `totalamt` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `refundamt` double DEFAULT NULL,
  `cancelcharge` double DEFAULT NULL,
  `atndby` text,
  `enqsrno` int(11) DEFAULT NULL,
  `feedbackflag` int(11) DEFAULT NULL,
  `cancelflag` int(11) DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS bugs;

CREATE TABLE `bugs` (
  `srno` int(11) NOT NULL,
  `about` varchar(50) DEFAULT NULL,
  `description` text,
  `screenshot` text,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS citylist;

CREATE TABLE `citylist` (
  `cityname` text,
  `statename` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS countrylist;

CREATE TABLE `countrylist` (
  `countryname` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS dbactivity;

CREATE TABLE `dbactivity` (
  `srno` int(11) NOT NULL,
  `username` text,
  `timestamp` text,
  `description` text,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS enquiry;

CREATE TABLE `enquiry` (
  `srno` int(11) NOT NULL,
  `destination` text,
  `enqdate` date DEFAULT NULL,
  `enqfor` text,
  `enqmode` text,
  `name` text,
  `address` text,
  `landline` text,
  `mobile` text,
  `email` text,
  `paxnos` int(11) DEFAULT NULL,
  `fromdate` date DEFAULT NULL,
  `todate` date DEFAULT NULL,
  `applock` int(11) DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS feedback;

CREATE TABLE `feedback` (
  `q1` text,
  `q2` text,
  `q3` text,
  `q4` text,
  `remarks` text,
  `appno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS hotellist;

CREATE TABLE `hotellist` (
  `srno` int(11) NOT NULL,
  `name` text,
  `cperson` text,
  `address` text,
  `city` text,
  `pincode` text,
  `landline` text,
  `mobile` text,
  `email` text,
  `chkin` text,
  `chkout` text,
  `commission` double DEFAULT NULL,
  `website` text,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS imagelist;

CREATE TABLE `imagelist` (
  `imgpath` text,
  `caption` text,
  `description` text,
  `hotelid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS loginhistory;

CREATE TABLE `loginhistory` (
  `srno` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `name` text,
  `timestamp` text,
  `attempt` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO loginhistory VALUES("1","admin","Mihir Karandikar","Mon, 10-Feb-2014 18-47-10 IST","Acknowledged");



DROP TABLE IF EXISTS messenger;

CREATE TABLE `messenger` (
  `message` text,
  `sender` text,
  `recipient` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `readstatus` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS params;

CREATE TABLE `params` (
  `tcno` text,
  `cname` text,
  `address` text,
  `contact` text,
  `mobile` text,
  `email` text,
  `website` text,
  `fburl` text,
  `companylogo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO params VALUES("ABEPK3159MST001","Travel Agency","Shop No. 3, Commerce Avenue, Mahaganesh Colony, Paud Road, Pune 38","020 25423351/52/53/54","9922408539, 9922400439","hradmin@travelagency.net","http://www.travelagency.com","http://www.facebook.com/TravelAgency","images/ta_logo.jpg");



DROP TABLE IF EXISTS receipt;

CREATE TABLE `receipt` (
  `srno` int(11) NOT NULL,
  `name` text,
  `hotelname` text,
  `amount` double DEFAULT NULL,
  `paymode` text,
  `chqbank` text,
  `chqdate` date DEFAULT NULL,
  `chqnum` text,
  `cardtype` text,
  `appno` int(11) DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS roomdetails;

CREATE TABLE `roomdetails` (
  `roomtype` text,
  `paxnos` int(11) DEFAULT NULL,
  `extrapax` int(11) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `hotelid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS statelist;

CREATE TABLE `statelist` (
  `statename` text,
  `countryname` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS useraccounts;

CREATE TABLE `useraccounts` (
  `srno` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` text,
  `actype` text,
  `name` text,
  `address` text,
  `contact` text,
  `dob` date DEFAULT NULL,
  `blockstatus` int(11) DEFAULT '0',
  PRIMARY KEY (`srno`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO useraccounts VALUES("1","admin","admin","Administrator","Mihir Karandikar","12, Sukhada, Mahaganesh Colony, Paud Road, Pune 411 038","9970770066","1993-08-14","0");
INSERT INTO useraccounts VALUES("2","kaushik","kaushik","Administrator","Kaushik Shinde","Bhaktiyog, Near MIT College, Pune 411 038","25422012","1993-06-07","0");
INSERT INTO useraccounts VALUES("3","jitesh","jitesh","User","Jitesh Deshpande","Ganesh Kunj, Rambaug Colony, Paud Road, Pune 411 038","9823535046","1992-11-05","0");



