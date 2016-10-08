DROP TABLE IF EXISTS activitylog;

CREATE TABLE `activitylog` (
  `srno` int(11) NOT NULL,
  `activity` text,
  `timestamp` text,
  `username` text,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO activitylog VALUES("1","Activity Log Cleared: 76 Record(s) Deleted","Mon, 27-Jan-2014 18-29-11 IST","admin");
INSERT INTO activitylog VALUES("2","Feedback submitted for Application No. 5","Wed, 29-Jan-2014 16-38-31 IST","admin");
INSERT INTO activitylog VALUES("3","User kaushik blocked by admin","Fri, 31-Jan-2014 12-24-44 IST","admin");
INSERT INTO activitylog VALUES("4","User kaushik unblocked by admin","Fri, 31-Jan-2014 12-24-57 IST","admin");
INSERT INTO activitylog VALUES("5","Enquiry No. 9 Updated","Fri, 07-Feb-2014 13-42-30 IST","admin");
INSERT INTO activitylog VALUES("6","Bug submitted","Fri, 07-Feb-2014 18-41-53 IST","admin");
INSERT INTO activitylog VALUES("7","Enquiry No. 9 Updated","Sat, 08-Feb-2014 19-54-24 IST","admin");
INSERT INTO activitylog VALUES("8","Enquiry No. 9 Deleted","Sat, 08-Feb-2014 19-56-08 IST","admin");
INSERT INTO activitylog VALUES("9","Enquiry No. 9 Created","Sun, 09-Feb-2014 13-01-34 IST","admin");
INSERT INTO activitylog VALUES("10","Application No. 9 Created","Sun, 09-Feb-2014 13-04-11 IST","admin");
INSERT INTO activitylog VALUES("11","Receipt No.  created","Sun, 09-Feb-2014 13-09-18 IST","admin");
INSERT INTO activitylog VALUES("12","Receipt No.  created","Sun, 09-Feb-2014 13-09-59 IST","admin");
INSERT INTO activitylog VALUES("13","Feedback submitted for Application No. 9","Sun, 09-Feb-2014 13-11-27 IST","admin");
INSERT INTO activitylog VALUES("14","Enquiry No. 10 Created","Sun, 09-Feb-2014 13-59-56 IST","admin");
INSERT INTO activitylog VALUES("15","Enquiry No. 10 Updated","Sun, 09-Feb-2014 14-02-52 IST","admin");
INSERT INTO activitylog VALUES("16","Application No. 10 Created","Sun, 09-Feb-2014 14-25-09 IST","admin");
INSERT INTO activitylog VALUES("17","Receipt No.  created","Sun, 09-Feb-2014 14-38-28 IST","admin");
INSERT INTO activitylog VALUES("18","Receipt No.  created","Sun, 09-Feb-2014 14-38-49 IST","admin");
INSERT INTO activitylog VALUES("19","Receipt No.  created","Sun, 09-Feb-2014 14-41-22 IST","admin");
INSERT INTO activitylog VALUES("20","Receipt No.  created","Sun, 09-Feb-2014 15-05-17 IST","admin");



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

INSERT INTO application VALUES("1","2013-12-14","Mihir Karandikar","12, Sukhada, Mahaganesh Colony, Paud Road, Pune 411 038","25432088","9970770066","Grand Hyatt Dubai","Grand Club King","5","2","2013-12-24","2013-12-31","7","Mr. D\'Silva","150000","1500","12544","2000","166044","0","0","0","admin","1","0","0");
INSERT INTO application VALUES("2","2013-12-14","Atharva Dandekar","D3, Shubhanagari, Dahanukar Colony, Karve Road, Pune 411 038","25381432","9011786367","Ducs de Bourgogne","Superior Room","2","1","2014-01-06","2014-01-12","6","Clare","100000","1500","1200","0","102700","0","0","0","admin","2","0","0");
INSERT INTO application VALUES("3","2013-12-14","Chinmay Joshi","Sarvatra Society, Paud Road, Pune 411 038","25445983","8600983898","Hyatt Regency Mumbai","Standard Room","1","1","2014-01-26","2014-01-28","2","Mr. Ram","25000","1500","122.33","0","26622.33","0","-1500","26622.33","admin","3","0","1");
INSERT INTO application VALUES("4","2013-12-14","Kaushik Shinde","Bhaktiyog Society, Near MIT College, Rambag Colony, Paud Road, Pune 411038","25465788","9041925466","Casablanca Beach Resort","Terrace Rooms","5","1","2013-12-22","2013-12-28","6","Ms. Shibani","32000","1500","354.55","0","33854.55","33854.55","0","0","admin","4","0","0");
INSERT INTO application VALUES("5","2013-12-14","Jitesh Deshpande","Ganesh Kunj, Rambag Colony, Paud Road, Pune 411038","23245688","9823535046","Hyatt Regency Mumbai","Standard Room","1","1","2013-12-25","2013-12-27","2","Mr. Sadhu Vasvani","12500","1500","125.22","0","14125.22","14125.22","0","0","admin","5","1","0");
INSERT INTO application VALUES("6","2013-12-14","Aditya Chavrekar","Bibwewadi, Pune","25468899","8600547895","Grand Hyatt Dubai","Grand Suite","2","1","2013-12-16","2013-12-21","5","Mr. Abudhabi","150000","1500","12500.22","0","164000.22","164000.22","0","0","admin","6","0","0");
INSERT INTO application VALUES("7","2013-12-14","Karan Aklujkar","Woodland, D. P. Road, Pune 411 038","25416777","9970556842","Park Hyatt Goa","Deluxe","10","3","2014-01-14","2014-01-18","4","Mr. D\'Silva","17500","1500","147.04","0","19147.04","19147.04","0","0","admin","7","0","0");
INSERT INTO application VALUES("8","2013-12-14","Nikita Pethe","Navaketan Society, Mayur Colony, Karve Road, Pune 411 038","25416589","9823513715","Ducs de Bourgogne","Superior Room","2","1","2014-02-10","2014-02-17","7","Clare","150000","1500","1250.22","0","152750.22","0","0","0","admin","8","0","0");
INSERT INTO application VALUES("9","2014-02-09","Kaushik Shinde","Bhaktiyog, Near MIT College, Pune","02025434102","9049579143","Ducs de Bourgogne","Superior Room","2","1","2014-02-14","2014-02-17","3","Claire","150000","1500","1253.22","100","152853.22","0","0","0","admin","9","1","0");
INSERT INTO application VALUES("10","2014-02-09","Mihir karandikar","Sukhada Apartment, Mahaganesh Colony, Paud Road, Pune","25432088","9970770066","Hyatt Regency Mumbai","Regency Club","5","2","2014-02-18","2014-02-24","6","Mr. Mohammad Ali","125000","1500","1250.22","200","127950.22","2750","0","0","admin","10","0","0");



DROP TABLE IF EXISTS bugs;

CREATE TABLE `bugs` (
  `srno` int(11) NOT NULL,
  `about` varchar(50) DEFAULT NULL,
  `description` text,
  `screenshot` text,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO bugs VALUES("1","Voucher","sdfsd","bugs/Screenshot from 2013-11-18 20:27:28.png");



DROP TABLE IF EXISTS citylist;

CREATE TABLE `citylist` (
  `cityname` text,
  `statename` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO citylist VALUES("Dubai","Dubai");
INSERT INTO citylist VALUES("Paris","Île-de-France");
INSERT INTO citylist VALUES("Mumbai","Maharashtra");
INSERT INTO citylist VALUES("Pune","Maharashtra");
INSERT INTO citylist VALUES("Candolim","Goa");



DROP TABLE IF EXISTS countrylist;

CREATE TABLE `countrylist` (
  `countryname` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO countrylist VALUES("United Arab Emirates");
INSERT INTO countrylist VALUES("France");
INSERT INTO countrylist VALUES("India");



DROP TABLE IF EXISTS dbactivity;

CREATE TABLE `dbactivity` (
  `srno` int(11) NOT NULL,
  `username` text,
  `timestamp` text,
  `description` text,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO dbactivity VALUES("1","admin","Sat, 20-Jul-2013 14-42-31 IST","Backup");
INSERT INTO dbactivity VALUES("2","admin","Sun, 21-Jul-2013 12-34-37 IST","Backup");
INSERT INTO dbactivity VALUES("3","admin","Sun, 28-Jul-2013 11-53-23 IST","Backup");
INSERT INTO dbactivity VALUES("4","admin","Fri, 09-Aug-2013 12-53-56 IST","Backup");
INSERT INTO dbactivity VALUES("5","admin","Fri, 09-Aug-2013 13-13-54 IST","Backup");
INSERT INTO dbactivity VALUES("6","admin","Fri, 09-Aug-2013 19-46-05 IST","Backup");
INSERT INTO dbactivity VALUES("7","admin","Tue, 20-Aug-2013 14-39-57 IST","Backup");
INSERT INTO dbactivity VALUES("8","admin","Mon, 26-Aug-2013 20-39-53 IST","Backup");
INSERT INTO dbactivity VALUES("9","admin","Mon, 02-Sep-2013 15-00-36 IST","Backup");
INSERT INTO dbactivity VALUES("10","admin","Tue, 03-Sep-2013 14-37-43 IST","Backup");
INSERT INTO dbactivity VALUES("11","admin","Sat, 07-Sep-2013 11-19-52 IST","Backup");
INSERT INTO dbactivity VALUES("12","admin","Sun, 15-Sep-2013 16-34-27 IST","Backup");
INSERT INTO dbactivity VALUES("13","admin","Sun, 15-Sep-2013 18-32-12 IST","Backup");
INSERT INTO dbactivity VALUES("14","admin","Wed, 18-Sep-2013 11-30-16 IST","Data Wipe");
INSERT INTO dbactivity VALUES("15","admin","Wed, 18-Sep-2013 11-34-20 IST","Data Wipe");
INSERT INTO dbactivity VALUES("16","admin","Wed, 18-Sep-2013 11-34-43 IST","Data Wipe");
INSERT INTO dbactivity VALUES("17","admin","Wed, 18-Sep-2013 11-53-18 IST","Data Wipe");
INSERT INTO dbactivity VALUES("18","admin","Thu, 19-Sep-2013 17-54-12 IST","Data Wipe");
INSERT INTO dbactivity VALUES("19","admin","Thu, 07-Nov-2013 13-01-50 IST","Backup");
INSERT INTO dbactivity VALUES("20","admin","Thu, 07-Nov-2013 13-52-54 IST","Data Restore");
INSERT INTO dbactivity VALUES("21","admin","Sat, 09-Nov-2013 14-13-44 IST","Backup");
INSERT INTO dbactivity VALUES("22","admin","Sat, 09-Nov-2013 15-22-09 IST","Data Wipe");
INSERT INTO dbactivity VALUES("23","admin","Sun, 10-Nov-2013 12-50-12 IST","Backup");
INSERT INTO dbactivity VALUES("24","admin","Sun, 10-Nov-2013 12-53-06 IST","Backup");
INSERT INTO dbactivity VALUES("25","admin","Sun, 10-Nov-2013 13-42-06 IST","Backup");
INSERT INTO dbactivity VALUES("26","admin","Tue, 26-Nov-2013 19-52-17 IST","Data Wipe");
INSERT INTO dbactivity VALUES("27","admin","Tue, 26-Nov-2013 19-55-03 IST","Backup");
INSERT INTO dbactivity VALUES("28","admin","Fri, 13-Dec-2013 21-05-23 IST","Backup");
INSERT INTO dbactivity VALUES("29","admin","Sat, 14-Dec-2013 15-50-15 IST","Backup");
INSERT INTO dbactivity VALUES("30","admin","Sat, 14-Dec-2013 16-13-47 IST","Backup");
INSERT INTO dbactivity VALUES("31","admin","Sat, 14-Dec-2013 19-21-14 IST","Data Restore");
INSERT INTO dbactivity VALUES("32","admin","Fri, 20-Dec-2013 20-16-57 IST","Backup");
INSERT INTO dbactivity VALUES("33","admin","Sat, 21-Dec-2013 08-52-30 IST","Backup");
INSERT INTO dbactivity VALUES("34","admin","Sat, 21-Dec-2013 08-52-46 IST","Backup");
INSERT INTO dbactivity VALUES("35","admin","Mon, 06-Jan-2014 18-28-22 IST","Backup");
INSERT INTO dbactivity VALUES("36","admin","Tue, 14-Jan-2014 18-43-16 IST","Backup");
INSERT INTO dbactivity VALUES("37","admin","Sat, 18-Jan-2014 12-42-41 IST","Backup");
INSERT INTO dbactivity VALUES("38","admin","Sat, 18-Jan-2014 12-47-56 IST","Backup");
INSERT INTO dbactivity VALUES("39","admin","Sun, 19-Jan-2014 18-26-32 IST","Data Restore");
INSERT INTO dbactivity VALUES("40","admin","Wed, 29-Jan-2014 18-21-24 IST","Backup");
INSERT INTO dbactivity VALUES("41","admin","Fri, 07-Feb-2014 13-42-20 IST","Data Restore");



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

INSERT INTO enquiry VALUES("1","Dubai","2013-12-14","Hotel Booking","Advertisement","Mihir Karandikar","12, Sukhada, Mahaganesh Colony, Paud Road, Pune 411 038","25432088","9970770066","karandikar.mihir@outlook.com","5","2013-12-24","2013-12-31","1");
INSERT INTO enquiry VALUES("2","Paris","2013-12-14","Hotel Booking","Advertisement","Atharva Dandekar","D3, Shubhanagari, Dahanukar Colony, Karve Road, Pune 411 038","25381432","9011786367","dandekar.atharva@gmail.com","2","2014-01-06","2014-01-12","1");
INSERT INTO enquiry VALUES("3","Mumbai","2013-12-14","Hotel Booking","Advertisement","Chinmay Joshi","Sarvatra Society, Paud Road, Pune 411 038","25445983","8600983898","chinmayj93@gmail.com","1","2014-01-26","2014-01-28","1");
INSERT INTO enquiry VALUES("4","Candolim","2013-12-14","Hotel Booking","Advertisement","Kaushik Shinde","Bhaktiyog Society, Near MIT College, Rambag Colony, Paud Road, Pune 411038","25465788","9041925466","kaushik.shinde20@gmail.com","5","2013-12-22","2013-12-28","1");
INSERT INTO enquiry VALUES("5","Pune","2013-12-14","Hotel Booking","Advertisement","Jitesh Deshpande","Ganesh Kunj, Rambag Colony, Paud Road, Pune 411038","23245688","9823535046","jitu_deshpande@yahoo.com","1","2013-12-25","2013-12-27","1");
INSERT INTO enquiry VALUES("6","Dubai","2013-12-14","Hotel Booking","Advertisement","Aditya Chavrekar","Bibwewadi, Pune","25468899","8600547895","aditya.chavrekar@gmail.com","2","2013-12-16","2013-12-21","1");
INSERT INTO enquiry VALUES("7","Candolim","2013-12-14","Hotel Booking","Advertisement","Karan Aklujkar","Woodland, D. P. Road, Pune 411 038","25416777","9970556842","karan_akkaloos@yahoo.com","10","2014-01-14","2014-01-18","1");
INSERT INTO enquiry VALUES("8","Paris","2013-12-14","Hotel Booking","Advertisement","Nikita Pethe","Navaketan Society, Mayur Colony, Karve Road, Pune 411 038","25416589","9823513715","nikipethe@gmail.com","2","2014-02-10","2014-02-17","1");
INSERT INTO enquiry VALUES("9","Paris","2014-02-09","Hotel Booking","Advertisement","Kaushik Shinde","Bhaktiyog, Near MIT College, Pune","02025434102","9049579143","kaushikshinde20@gmail.com","2","2014-02-14","2014-02-17","1");
INSERT INTO enquiry VALUES("10","Dubai","2014-02-09","2014-02-09","Advertisement","Mihir karandikar","Sukhada Apartment, Mahaganesh Colony, Paud Road, Pune","25432088","9970770066","karandikar.mihir@outlook.com","5","2014-02-18","2014-02-24","1");



DROP TABLE IF EXISTS feedback;

CREATE TABLE `feedback` (
  `q1` text,
  `q2` text,
  `q3` text,
  `q4` text,
  `remarks` text,
  `appno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO feedback VALUES("Yes","Yes","Yes","Yes","Everything was fine","5");
INSERT INTO feedback VALUES("Yes","Yes","Yes","Yes","Everything was fine.","9");



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

INSERT INTO hotellist VALUES("1","Grand Hyatt Dubai","Hamdan bin Mohammed","P.O. Box 7978 Dubai,  United Arab Emirates","Dubai","None","+971 4 317 1234","+971 4 317 1235","dubai.grand@hyatt.com","12:00","09:00","30","http://dubai.grand.hyatt.com/");
INSERT INTO hotellist VALUES("2","Ducs de Bourgogne","Clare Devin","19 rue du Pont Neuf 75001 Paris - France","Paris","75001","+ 33 1 42 33 95 64","Nil","bourgogne@book-inn-france.com","12:00","09:00","30","http://www.bestwestern-bourgogne.com/");
INSERT INTO hotellist VALUES("3","Hyatt Regency Mumbai","Mr. D\'Silva","Sahar Airport Road Mumbai,  India, 400 099","Mumbai","400099","+91 22 6696 1234","+91 22 6696 1235","mumbai.regency@hyatt.com","12:00","12:00","25","http://mumbai.regency.hyatt.com/");
INSERT INTO hotellist VALUES("4","JW Marriott Hotel Pune","Mr. D\'Silva","Senapati Bapat Road  Pune  411053  India ","Pune","411 053","+91-20-6683-3333","9822054657","hradmin@marriott.com","12:00","12:00","30","http://www.marriott.com/hotels/fact-sheet/travel/pnqmc-jw-marriott-hotel-pune/");
INSERT INTO hotellist VALUES("5","Casablanca Beach Resort","Mr. Joseph","Wadi Candolim, Bardez, Goa(North).P.O. 403 515","Candolim","403015","(0832) 2479224 / 2479480","None","info@casablancagoa.com","12:00","09:00","30","http://www.casablancagoa.com/");
INSERT INTO hotellist VALUES("6","Park Hyatt Goa","Mr. Rameshwaran","Arossim Beach, Cansaulim South Goa,  India, 403 712","Candolim","403 712","+91 832 272 1234","+91 832 272 1235","parkhyattgoa@hyatt.com","12:00","12:00","30","http://www.goa.park.hyatt.com/");



DROP TABLE IF EXISTS imagelist;

CREATE TABLE `imagelist` (
  `imgpath` text,
  `caption` text,
  `description` text,
  `hotelid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO imagelist VALUES("hoteldata/1/cq5dam.thumbnail.744.415.png","Grand King Club","2 Adults Plus 1 Extra Pax","1");
INSERT INTO imagelist VALUES("hoteldata/1/cq5dam.thumbnail.744.415 (2).png","The Market Cafe","The Market Café, the international restaurant in Dubai, is located in a lush indoor atrium garden of Grand Hyatt.","1");
INSERT INTO imagelist VALUES("hoteldata/1/cq5dam.thumbnail.744.415 (3).png","Cooz","When the sun sets, Cooz Bar in Dubai, located on the lobby level, is a stylish and intimate bar offering premium beverages and cigars. ","1");
INSERT INTO imagelist VALUES("hoteldata/1/cq5dam.thumbnail.744.415 (4).png","Pool Bar","For relaxed, all-day alfresco dining in a lush, tropical garden environment, the Poolside Restaurant offers a light menu with refreshing, ","1");
INSERT INTO imagelist VALUES("hoteldata/1/cq5dam.thumbnail.744.415 (5).png","Living Room","The Living Room, a new stimulating, residential lounge and bar in Dubai with four thematic lounges.","1");
INSERT INTO imagelist VALUES("hoteldata/1/cq5dam.thumbnail.744.415 (6).png","Spa","Our wellness philosophy at Ahasees Spa & Club is inspired by the great evolution of our city out of the water, the conduit for our growth, the feelings and sensations, ahasees that only Dubai knows. ","1");
INSERT INTO imagelist VALUES("hoteldata/2/best-western-duc-de-bourgogne-classic-room-3.jpg","Classic Room","2 Adults Plus 0 Extra Pax","2");
INSERT INTO imagelist VALUES("hoteldata/2/best-western-duc-de-bourgogne-classic-room-3.jpg","Single Room","1 Adult Plus 1 Extra Pax","2");
INSERT INTO imagelist VALUES("hoteldata/2/best-western-ducs-de-bourgogne-superior-room-background.jpg","Superior Room","2 Adults Plus 0 Extra Pax","2");
INSERT INTO imagelist VALUES("hoteldata/2/best-western-ducs-de-bourgogne-superior-room-background.jpg","Executive Room","2 Adults Plus 0 Extra Pax","2");
INSERT INTO imagelist VALUES("hoteldata/2/best-western-ducs-de-bourgogne-2.jpg","Hotel Surroundings","","2");
INSERT INTO imagelist VALUES("hoteldata/2/best-western-ducs-de-bourgogne-4.jpg","Hotel View","","2");
INSERT INTO imagelist VALUES("hoteldata/3/cq5dam.thumbnail.744.415 (3).png","King Suite","2 Adults Plus 0 Extra Pax","3");
INSERT INTO imagelist VALUES("hoteldata/3/cq5dam.thumbnail.744.415.png","Standard Suite","2 Adults Plus 1 Extra Pax","3");
INSERT INTO imagelist VALUES("hoteldata/3/cq5dam.thumbnail.744.415 (2).png","Regency Club","2 Adults Plus 1 Extra Pax","3");
INSERT INTO imagelist VALUES("hoteldata/3/cq5dam.thumbnail.744.415 (3).png","King Suite","2 Adults Plus 0 Extra Pax","3");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour31.jpg","Hotel View","","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour33.jpg","Standard Suite","2 Adults Plus 0 Extra Pax","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour41.jpg","Bar 101","","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour48.jpg","Outer View","","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour49.jpg","Lobby","","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour50.jpg","Twin Double Bed","4 Adults Plus 1 Extra Pax","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour51.jpg","Soho Suite","2 Adults Plus 0 Extra Pax","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour52.jpg","Junior Suite","2 Adults Plus 0 Extra Pax","4");
INSERT INTO imagelist VALUES("hoteldata/4/pnqmc_phototour53.jpg","Dining Room","","4");
INSERT INTO imagelist VALUES("hoteldata/5/main_slide_1.jpg","Hotel View","","5");
INSERT INTO imagelist VALUES("hoteldata/5/main_slide_2.jpg","Relaxation Area","","5");
INSERT INTO imagelist VALUES("hoteldata/5/main_slide_3.jpg","Double Bed Room","2 Adults Plus 0 Extra Pax","5");
INSERT INTO imagelist VALUES("hoteldata/5/room_1.jpg","Terrace Room","","5");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415.png","Standard","2 Adults Plus 1 Extra","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (1).png","Washroom","","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (2).png","Double Bed","2 Adults Plus 1 Extra","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (3).png","Room View","","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (4).png","Room View","","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (5).png","Goan Food","","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (6).png","Goan Food","","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (7).png","Palm Tree Diner","","6");
INSERT INTO imagelist VALUES("hoteldata/6/cq5dam.thumbnail.744.415 (8).png","Cabana Diner","","6");



DROP TABLE IF EXISTS loginhistory;

CREATE TABLE `loginhistory` (
  `srno` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `name` text,
  `timestamp` text,
  `attempt` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO loginhistory VALUES("1","admin","Mihir Karandikar","Fri, 08-Nov-2013 15-14-01 IST","Acknowledged");
INSERT INTO loginhistory VALUES("2","user","Atharva Dandekar","Fri, 08-Nov-2013 15-14-52 IST","Acknowledged");
INSERT INTO loginhistory VALUES("3","user","Unknown","Fri, 08 Nov 2013 15:15:01 IST","Rejected");
INSERT INTO loginhistory VALUES("4","admin","Mihir Karandikar","Fri, 08-Nov-2013 15-15-04 IST","Acknowledged");
INSERT INTO loginhistory VALUES("5","admin","Mihir Karandikar","Fri, 08-Nov-2013 16-38-43 IST","Acknowledged");
INSERT INTO loginhistory VALUES("6","admin","Mihir Karandikar","Fri, 08-Nov-2013 16-43-04 IST","Acknowledged");
INSERT INTO loginhistory VALUES("7","admin","Mihir Karandikar","Fri, 08-Nov-2013 18-55-48 IST","Acknowledged");
INSERT INTO loginhistory VALUES("8","admin","Mihir Karandikar","Fri, 08-Nov-2013 20-56-02 IST","Acknowledged");
INSERT INTO loginhistory VALUES("9","user","Atharva Dandekar","Fri, 08-Nov-2013 21-09-44 IST","Acknowledged");
INSERT INTO loginhistory VALUES("10","admin","Mihir Karandikar","Fri, 08-Nov-2013 21-09-57 IST","Acknowledged");
INSERT INTO loginhistory VALUES("11","admin","Mihir Karandikar","Fri, 08-Nov-2013 21-19-03 IST","Acknowledged");
INSERT INTO loginhistory VALUES("12","admin","Mihir Karandikar","Fri, 08-Nov-2013 21-31-02 IST","Acknowledged");
INSERT INTO loginhistory VALUES("13","admin","Mihir Karandikar","Sat, 09-Nov-2013 14-02-26 IST","Acknowledged");
INSERT INTO loginhistory VALUES("14","admin","Mihir Karandikar","Sat, 09-Nov-2013 14-13-39 IST","Acknowledged");
INSERT INTO loginhistory VALUES("15","admin","Unknown","Sat, 09 Nov 2013 14:54:33 IST","Rejected");
INSERT INTO loginhistory VALUES("16","admin","Mihir Karandikar","Sat, 09-Nov-2013 14-54-37 IST","Acknowledged");
INSERT INTO loginhistory VALUES("17","user","Atharva Dandekar","Sat, 09-Nov-2013 15-14-00 IST","Acknowledged");
INSERT INTO loginhistory VALUES("18","admin","Mihir Karandikar","Sat, 09-Nov-2013 15-15-11 IST","Acknowledged");
INSERT INTO loginhistory VALUES("19","admin","Mihir Karandikar","Sat, 09-Nov-2013 15-17-46 IST","Acknowledged");
INSERT INTO loginhistory VALUES("20","admin","Mihir Karandikar","Sat, 09-Nov-2013 15-43-12 IST","Acknowledged");
INSERT INTO loginhistory VALUES("21","user","Atharva Dandekar","Sat, 09-Nov-2013 16-05-53 IST","Acknowledged");
INSERT INTO loginhistory VALUES("22","admin","Mihir Karandikar","Sat, 09-Nov-2013 16-06-06 IST","Acknowledged");
INSERT INTO loginhistory VALUES("23","admin","Mihir Karandikar","Sun, 10-Nov-2013 11-32-28 IST","Acknowledged");
INSERT INTO loginhistory VALUES("24","user","Atharva Dandekar","Sun, 10-Nov-2013 12-48-11 IST","Acknowledged");
INSERT INTO loginhistory VALUES("25","admin","Mihir Karandikar","Sun, 10-Nov-2013 12-50-03 IST","Acknowledged");
INSERT INTO loginhistory VALUES("26","admin","Mihir Karandikar","Sun, 10-Nov-2013 18-08-19 IST","Acknowledged");
INSERT INTO loginhistory VALUES("27","admin","Mihir Karandikar","Sun, 10-Nov-2013 19-55-12 IST","Acknowledged");
INSERT INTO loginhistory VALUES("28","admin","Mihir Karandikar","Mon, 11-Nov-2013 11-27-52 IST","Acknowledged");
INSERT INTO loginhistory VALUES("29","admin","Mihir Karandikar","Mon, 11-Nov-2013 11-29-21 IST","Acknowledged");
INSERT INTO loginhistory VALUES("30","admin","Mihir Karandikar","Tue, 12-Nov-2013 11-58-09 IST","Acknowledged");
INSERT INTO loginhistory VALUES("31","admin","Mihir Karandikar","Sat, 16-Nov-2013 20-19-21 IST","Acknowledged");
INSERT INTO loginhistory VALUES("32","admin","Mihir Karandikar","Sun, 24-Nov-2013 19-36-29 IST","Acknowledged");
INSERT INTO loginhistory VALUES("33","admin","Mihir Karandikar","Tue, 26-Nov-2013 19-49-14 IST","Acknowledged");
INSERT INTO loginhistory VALUES("34","admin","Mihir Karandikar","Thu, 28-Nov-2013 17-34-49 IST","Acknowledged");
INSERT INTO loginhistory VALUES("35","admin","Mihir Karandikar","Thu, 28-Nov-2013 17-39-48 IST","Acknowledged");
INSERT INTO loginhistory VALUES("36","admin","Mihir Karandikar","Thu, 28-Nov-2013 18-31-50 IST","Acknowledged");
INSERT INTO loginhistory VALUES("37","admin","Mihir Karandikar","Thu, 12-Dec-2013 17-56-51 IST","Acknowledged");
INSERT INTO loginhistory VALUES("38","admin","Mihir Karandikar","Thu, 12-Dec-2013 18-17-35 IST","Acknowledged");
INSERT INTO loginhistory VALUES("39","admin","Mihir Karandikar","Fri, 13-Dec-2013 11-08-31 IST","Acknowledged");
INSERT INTO loginhistory VALUES("40","admin","Mihir Karandikar","Fri, 13-Dec-2013 11-18-52 IST","Acknowledged");
INSERT INTO loginhistory VALUES("41","user","Atharva Dandekar","Fri, 13-Dec-2013 11-39-33 IST","Acknowledged");
INSERT INTO loginhistory VALUES("42","admin","Mihir Karandikar","Fri, 13-Dec-2013 21-05-15 IST","Acknowledged");
INSERT INTO loginhistory VALUES("43","admin","Mihir Karandikar","Sat, 14-Dec-2013 10-40-07 IST","Acknowledged");
INSERT INTO loginhistory VALUES("44","admin","Mihir Karandikar","Sat, 14-Dec-2013 10-52-23 IST","Acknowledged");
INSERT INTO loginhistory VALUES("45","kaushik","Kaushik Shinde","Sat, 14-Dec-2013 11-21-28 IST","Acknowledged");
INSERT INTO loginhistory VALUES("46","kaushik","Kaushik Shinde","Sat, 14-Dec-2013 11-22-25 IST","Acknowledged");
INSERT INTO loginhistory VALUES("47","kaushik","Unknown","Sat, 14 Dec 2013 11:23:49 IST","Rejected");
INSERT INTO loginhistory VALUES("48","jitesh","Jitesh Deshpande","Sat, 14-Dec-2013 11-24-04 IST","Acknowledged");
INSERT INTO loginhistory VALUES("49","kaushik","Kaushik Shinde","Sat, 14-Dec-2013 11-24-25 IST","Acknowledged");
INSERT INTO loginhistory VALUES("50","admin","Mihir Karandikar","Sat, 14-Dec-2013 11-24-56 IST","Acknowledged");
INSERT INTO loginhistory VALUES("51","jitesh","Jitesh Deshpande","Sat, 14-Dec-2013 11-30-36 IST","Acknowledged");
INSERT INTO loginhistory VALUES("52","admin","Mihir Karandikar","Sat, 14-Dec-2013 11-31-57 IST","Acknowledged");
INSERT INTO loginhistory VALUES("53","admin","Mihir Karandikar","Sat, 14-Dec-2013 15-51-43 IST","Acknowledged");
INSERT INTO loginhistory VALUES("54","admin","Mihir Karandikar","Sat, 14-Dec-2013 19-11-59 IST","Acknowledged");
INSERT INTO loginhistory VALUES("55","admin","Mihir Karandikar","Sat, 14-Dec-2013 19-17-29 IST","Acknowledged");
INSERT INTO loginhistory VALUES("56","jitesh","Jitesh Deshpande","Sat, 14-Dec-2013 19-20-07 IST","Acknowledged");
INSERT INTO loginhistory VALUES("57","admin","Mihir Karandikar","Sat, 14-Dec-2013 19-20-18 IST","Acknowledged");
INSERT INTO loginhistory VALUES("58","jitesh","Unknown","Sat, 14 Dec 2013 19:22:17 IST","Rejected");
INSERT INTO loginhistory VALUES("59","admin","Mihir Karandikar","Sat, 14-Dec-2013 19-22-22 IST","Acknowledged");
INSERT INTO loginhistory VALUES("60","admin","Mihir Karandikar","Sat, 14-Dec-2013 19-33-08 IST","Acknowledged");
INSERT INTO loginhistory VALUES("61","admin","Mihir Karandikar","Sun, 15-Dec-2013 15-35-14 IST","Acknowledged");
INSERT INTO loginhistory VALUES("62","admin","Mihir Karandikar","Sun, 15-Dec-2013 16-13-10 IST","Acknowledged");
INSERT INTO loginhistory VALUES("63","admin","Mihir Karandikar","Sun, 15-Dec-2013 18-12-33 IST","Acknowledged");
INSERT INTO loginhistory VALUES("64","admin","Mihir Karandikar","Fri, 20-Dec-2013 20-16-51 IST","Acknowledged");
INSERT INTO loginhistory VALUES("65","admin","Mihir Karandikar","Sat, 21-Dec-2013 08-35-02 IST","Acknowledged");
INSERT INTO loginhistory VALUES("66","admin","Mihir Karandikar","Sat, 21-Dec-2013 16-55-52 IST","Acknowledged");
INSERT INTO loginhistory VALUES("67","admin","Mihir Karandikar","Sat, 21-Dec-2013 18-08-53 IST","Acknowledged");
INSERT INTO loginhistory VALUES("68","admin","Mihir Karandikar","Fri, 27-Dec-2013 13-49-20 IST","Acknowledged");
INSERT INTO loginhistory VALUES("69","admin","Mihir Karandikar","Fri, 27-Dec-2013 14-38-35 IST","Acknowledged");
INSERT INTO loginhistory VALUES("70","admin","Mihir Karandikar","Tue, 31-Dec-2013 18-01-23 IST","Acknowledged");
INSERT INTO loginhistory VALUES("71","admin","Mihir Karandikar","Sat, 04-Jan-2014 20-13-14 IST","Acknowledged");
INSERT INTO loginhistory VALUES("72","admin","Mihir Karandikar","Mon, 06-Jan-2014 18-10-38 IST","Acknowledged");
INSERT INTO loginhistory VALUES("73","admin","Mihir Karandikar","Mon, 06-Jan-2014 18-28-18 IST","Acknowledged");
INSERT INTO loginhistory VALUES("74","admin","Mihir Karandikar","Wed, 08-Jan-2014 19-01-59 IST","Acknowledged");
INSERT INTO loginhistory VALUES("75","adhu","Unknown","Thu, 09 Jan 2014 19:02:23 IST","Rejected");
INSERT INTO loginhistory VALUES("76","admin","Mihir Karandikar","Thu, 09-Jan-2014 19-05-18 IST","Acknowledged");
INSERT INTO loginhistory VALUES("77","admin","Mihir Karandikar","Thu, 09-Jan-2014 19-07-27 IST","Acknowledged");
INSERT INTO loginhistory VALUES("78","admin","Mihir Karandikar","Thu, 09-Jan-2014 19-07-59 IST","Acknowledged");
INSERT INTO loginhistory VALUES("79","admin","Mihir Karandikar","Fri, 10-Jan-2014 14-30-32 IST","Acknowledged");
INSERT INTO loginhistory VALUES("80","admin","Unknown","Mon, 13 Jan 2014 11:53:14 IST","Rejected");
INSERT INTO loginhistory VALUES("81","admin","Mihir Karandikar","Tue, 14-Jan-2014 15-01-18 IST","Acknowledged");
INSERT INTO loginhistory VALUES("82","admin","Mihir Karandikar","Tue, 14-Jan-2014 18-43-11 IST","Acknowledged");
INSERT INTO loginhistory VALUES("83","admin","Mihir Karandikar","Wed, 15-Jan-2014 18-17-09 IST","Acknowledged");
INSERT INTO loginhistory VALUES("84","admin","Mihir Karandikar","Wed, 15-Jan-2014 19-02-37 IST","Acknowledged");
INSERT INTO loginhistory VALUES("85","admin","Mihir Karandikar","Wed, 15-Jan-2014 19-47-14 IST","Acknowledged");
INSERT INTO loginhistory VALUES("86","admin","Mihir Karandikar","Wed, 15-Jan-2014 20-04-41 IST","Acknowledged");
INSERT INTO loginhistory VALUES("87","admin","Mihir Karandikar","Wed, 15-Jan-2014 20-06-02 IST","Acknowledged");
INSERT INTO loginhistory VALUES("88","admin","Mihir Karandikar","Wed, 15-Jan-2014 20-25-21 IST","Acknowledged");
INSERT INTO loginhistory VALUES("89","admin","Mihir Karandikar","Sat, 18-Jan-2014 11-00-57 IST","Acknowledged");
INSERT INTO loginhistory VALUES("90","admin","Mihir Karandikar","Sat, 18-Jan-2014 11-53-12 IST","Acknowledged");
INSERT INTO loginhistory VALUES("91","admin","Mihir Karandikar","Sat, 18-Jan-2014 12-58-55 IST","Acknowledged");
INSERT INTO loginhistory VALUES("92","kaushik","Kaushik Shinde","Sat, 18-Jan-2014 12-59-45 IST","Acknowledged");
INSERT INTO loginhistory VALUES("93","admin","Mihir Karandikar","Sat, 18-Jan-2014 13-09-21 IST","Acknowledged");
INSERT INTO loginhistory VALUES("94","admin","Mihir Karandikar","Sat, 18-Jan-2014 13-14-10 IST","Acknowledged");
INSERT INTO loginhistory VALUES("95","admin","Mihir Karandikar","Sat, 18-Jan-2014 13-19-03 IST","Acknowledged");
INSERT INTO loginhistory VALUES("96","admin","Mihir Karandikar","Sun, 19-Jan-2014 18-24-58 IST","Acknowledged");
INSERT INTO loginhistory VALUES("97","admin","Mihir Karandikar","Sun, 19-Jan-2014 19-10-37 IST","Acknowledged");
INSERT INTO loginhistory VALUES("98","admin","Mihir Karandikar","Mon, 20-Jan-2014 18-46-59 IST","Acknowledged");
INSERT INTO loginhistory VALUES("99","admin","Mihir Karandikar","Tue, 21-Jan-2014 10-55-15 IST","Acknowledged");
INSERT INTO loginhistory VALUES("100","admin","Mihir Karandikar","Tue, 21-Jan-2014 11-45-56 IST","Acknowledged");
INSERT INTO loginhistory VALUES("101","admin","Mihir Karandikar","Tue, 21-Jan-2014 19-23-45 IST","Acknowledged");
INSERT INTO loginhistory VALUES("102","admin","Mihir Karandikar","Fri, 24-Jan-2014 20-21-42 IST","Acknowledged");
INSERT INTO loginhistory VALUES("103","admin","Mihir Karandikar","Mon, 27-Jan-2014 14-24-00 IST","Acknowledged");
INSERT INTO loginhistory VALUES("104","admin","Mihir Karandikar","Mon, 27-Jan-2014 15-27-33 IST","Acknowledged");
INSERT INTO loginhistory VALUES("105","kaushik","Kaushik Shinde","Mon, 27-Jan-2014 15-31-41 IST","Acknowledged");
INSERT INTO loginhistory VALUES("106","admin","Mihir Karandikar","Mon, 27-Jan-2014 15-34-58 IST","Acknowledged");
INSERT INTO loginhistory VALUES("107","admin","Mihir Karandikar","Mon, 27-Jan-2014 15-36-24 IST","Acknowledged");
INSERT INTO loginhistory VALUES("108","admin","Mihir Karandikar","Mon, 27-Jan-2014 18-21-29 IST","Acknowledged");
INSERT INTO loginhistory VALUES("109","admin","Mihir Karandikar","Mon, 27-Jan-2014 18-26-21 IST","Acknowledged");
INSERT INTO loginhistory VALUES("110","jitesh","Jitesh Deshpande","Mon, 27-Jan-2014 18-44-28 IST","Acknowledged");
INSERT INTO loginhistory VALUES("111","admin","Mihir Karandikar","Mon, 27-Jan-2014 19-37-23 IST","Acknowledged");
INSERT INTO loginhistory VALUES("112","admin","Mihir Karandikar","Tue, 28-Jan-2014 19-49-04 IST","Acknowledged");
INSERT INTO loginhistory VALUES("113","admin","Mihir Karandikar","Tue, 28-Jan-2014 20-08-47 IST","Acknowledged");
INSERT INTO loginhistory VALUES("114","admin","Mihir Karandikar","Wed, 29-Jan-2014 16-24-48 IST","Acknowledged");
INSERT INTO loginhistory VALUES("115","jitesh","Jitesh Deshpande","Wed, 29-Jan-2014 16-44-23 IST","Acknowledged");
INSERT INTO loginhistory VALUES("116","admin","Mihir Karandikar","Wed, 29-Jan-2014 16-45-44 IST","Acknowledged");
INSERT INTO loginhistory VALUES("117","admin","Mihir Karandikar","Wed, 29-Jan-2014 18-21-21 IST","Acknowledged");
INSERT INTO loginhistory VALUES("118","admin","Unknown","Fri, 31 Jan 2014 11:31:29 IST","Rejected");
INSERT INTO loginhistory VALUES("119","admin","Unknown","Fri, 31 Jan 2014 11:33:13 IST","Rejected");
INSERT INTO loginhistory VALUES("120","admin","Unknown","Fri, 31 Jan 2014 11:33:27 IST","Rejected");
INSERT INTO loginhistory VALUES("121","admin","Unknown","Fri, 31 Jan 2014 11:33:33 IST","Rejected");
INSERT INTO loginhistory VALUES("122","admin","Unknown","Fri, 31 Jan 2014 11:33:43 IST","Rejected");
INSERT INTO loginhistory VALUES("123","admin","Unknown","Fri, 31 Jan 2014 11:33:52 IST","Rejected");
INSERT INTO loginhistory VALUES("124","admin","Unknown","Fri, 31 Jan 2014 11:33:58 IST","Rejected");
INSERT INTO loginhistory VALUES("125","admin","Mihir Karandikar","Fri, 31-Jan-2014 11-34-11 IST","Acknowledged");
INSERT INTO loginhistory VALUES("126","admin","Mihir Karandikar","Fri, 31-Jan-2014 12-04-24 IST","Acknowledged");
INSERT INTO loginhistory VALUES("127","admin","Mihir Karandikar","Fri, 31-Jan-2014 12-23-03 IST","Acknowledged");
INSERT INTO loginhistory VALUES("128","admin","Mihir Karandikar","Fri, 31-Jan-2014 12-49-09 IST","Acknowledged");
INSERT INTO loginhistory VALUES("129","admin","Unknown","Fri, 31 Jan 2014 13:13:12 IST","Rejected");
INSERT INTO loginhistory VALUES("130","admin","Unknown","Fri, 31 Jan 2014 13:13:17 IST","Rejected");
INSERT INTO loginhistory VALUES("131","admin","Mihir Karandikar","Fri, 31-Jan-2014 13-13-20 IST","Acknowledged");
INSERT INTO loginhistory VALUES("132","admin","Mihir Karandikar","Fri, 31-Jan-2014 14-12-55 IST","Acknowledged");
INSERT INTO loginhistory VALUES("133","admin","Mihir Karandikar","Fri, 31-Jan-2014 14-14-59 IST","Acknowledged");
INSERT INTO loginhistory VALUES("134","admin","Mihir Karandikar","Fri, 31-Jan-2014 14-15-52 IST","Acknowledged");
INSERT INTO loginhistory VALUES("135","admin","Mihir Karandikar","Fri, 31-Jan-2014 14-18-13 IST","Acknowledged");
INSERT INTO loginhistory VALUES("136","admin","Mihir Karandikar","Fri, 07-Feb-2014 15-26-05 IST","Acknowledged");
INSERT INTO loginhistory VALUES("137","jitesh","Jitesh Deshpande","Fri, 07-Feb-2014 15-44-56 IST","Acknowledged");
INSERT INTO loginhistory VALUES("138","admin","Mihir Karandikar","Fri, 07-Feb-2014 15-45-10 IST","Acknowledged");
INSERT INTO loginhistory VALUES("139","admin","Mihir Karandikar","Fri, 07-Feb-2014 16-28-31 IST","Acknowledged");
INSERT INTO loginhistory VALUES("140","admin","Mihir Karandikar","Fri, 07-Feb-2014 18-32-37 IST","Acknowledged");
INSERT INTO loginhistory VALUES("141","jitesh","Jitesh Deshpande","Fri, 07-Feb-2014 18-39-53 IST","Acknowledged");
INSERT INTO loginhistory VALUES("142","admin","Mihir Karandikar","Fri, 07-Feb-2014 18-40-00 IST","Acknowledged");
INSERT INTO loginhistory VALUES("143","admin","Mihir Karandikar","Sat, 08-Feb-2014 19-23-05 IST","Acknowledged");
INSERT INTO loginhistory VALUES("144","sad","Unknown","Sat, 08 Feb 2014 19:27:20 IST","Rejected");
INSERT INTO loginhistory VALUES("145","asd","Unknown","Sat, 08 Feb 2014 19:27:27 IST","Rejected");
INSERT INTO loginhistory VALUES("146","admin","Mihir Karandikar","Sat, 08-Feb-2014 19-28-01 IST","Acknowledged");
INSERT INTO loginhistory VALUES("147","admin","Mihir Karandikar","Sun, 09-Feb-2014 13-00-19 IST","Acknowledged");
INSERT INTO loginhistory VALUES("148","admin","Mihir Karandikar","Sun, 09-Feb-2014 20-08-03 IST","Acknowledged");
INSERT INTO loginhistory VALUES("149","admin","Mihir Karandikar","Sun, 09-Feb-2014 20-33-09 IST","Acknowledged");
INSERT INTO loginhistory VALUES("150","admin","Mihir Karandikar","Mon, 10-Feb-2014 07-42-40 IST","Acknowledged");



DROP TABLE IF EXISTS messenger;

CREATE TABLE `messenger` (
  `message` text,
  `sender` text,
  `recipient` text,
  `timestamp` text,
  `readstatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO messenger VALUES("adhudhudhu","Jitesh Deshpande","Mihir Karandikar","Mon, 27 Jan 2014 18:44:55 IST","1");
INSERT INTO messenger VALUES("adhudhu\n","Mihir Karandikar","Jitesh Deshpande","Mon, 27 Jan 2014 18:45:50 IST","1");
INSERT INTO messenger VALUES("yoyoyo","Jitesh Deshpande","Mihir Karandikar","Mon, 27 Jan 2014 18:46:09 IST","1");



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

INSERT INTO receipt VALUES("1","Mihir Karandikar","Grand Hyatt Dubai","166044","Credit/Debit Card","","2013-12-14","","Master","1");
INSERT INTO receipt VALUES("2","Atharva Dandekar","Ducs de Bourgogne","102700","Cheque","ICICI Bank, Shivajinagar Branch","2013-12-14","125478"," ","2");
INSERT INTO receipt VALUES("3","Nikita Pethe","Ducs de Bourgogne","152750.22","Credit/Debit Card","","2013-12-14","","Visa","8");
INSERT INTO receipt VALUES("4","Kaushik Shinde","Ducs de Bourgogne","50000","Credit/Debit Card","","2014-02-09","","Master","9");
INSERT INTO receipt VALUES("5","Kaushik Shinde","Ducs de Bourgogne","102853.22","Wire Transfer","","2014-02-09","","Â ","9");
INSERT INTO receipt VALUES("6","Mihir karandikar","Hyatt Regency Mumbai","1200","Cash","","2014-02-09","","","10");
INSERT INTO receipt VALUES("7","Mihir karandikar","Hyatt Regency Mumbai","120000.22","Cash","","2014-02-09","","","10");
INSERT INTO receipt VALUES("8","Mihir karandikar","Hyatt Regency Mumbai","3000","Cash","","0000-00-00","","","10");
INSERT INTO receipt VALUES("9","Mihir karandikar","Hyatt Regency Mumbai","1000","Cash","","0000-00-00","","","10");



DROP TABLE IF EXISTS resetrequest;

CREATE TABLE `resetrequest` (
  `srno` int(11) NOT NULL,
  `username` text,
  `name` text,
  `address` text,
  `contact` text,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS roomdetails;

CREATE TABLE `roomdetails` (
  `roomtype` text,
  `paxnos` int(11) DEFAULT NULL,
  `extrapax` int(11) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `hotelid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO roomdetails VALUES("Grand Club King","2","1","150000","1");
INSERT INTO roomdetails VALUES("Grand Suite","2","1","120000","1");
INSERT INTO roomdetails VALUES("Standard Suite","3","1","60000","1");
INSERT INTO roomdetails VALUES("Prince Suite King","2","0","200000","1");
INSERT INTO roomdetails VALUES("Classic Room","2","0","150000","2");
INSERT INTO roomdetails VALUES("Single Room","1","1","60000","2");
INSERT INTO roomdetails VALUES("Superior Room","2","0","75000","2");
INSERT INTO roomdetails VALUES("Executive Room","2","0","100000","2");
INSERT INTO roomdetails VALUES("Standard Room","2","1","35000","3");
INSERT INTO roomdetails VALUES("Regency Club","2","0","50000","3");
INSERT INTO roomdetails VALUES("Suite","2","1","50000","3");
INSERT INTO roomdetails VALUES("Standard Suite","2","1","6999","4");
INSERT INTO roomdetails VALUES("Double Bed","4","1","20000","4");
INSERT INTO roomdetails VALUES("Soho Suite","2","0","25000","4");
INSERT INTO roomdetails VALUES("Junior Suite","2","0","30000","4");
INSERT INTO roomdetails VALUES("Terrace Rooms","4","1","12500","5");
INSERT INTO roomdetails VALUES("Suites","2","1","10000","5");
INSERT INTO roomdetails VALUES("Twin Sharing","10","5","25000","5");
INSERT INTO roomdetails VALUES("Park Room","2","1","15000","6");
INSERT INTO roomdetails VALUES("Imperador Suite","2","0","25000","6");
INSERT INTO roomdetails VALUES("Standard","3","1","10000","6");
INSERT INTO roomdetails VALUES("Deluxe","2","1","15000","6");
INSERT INTO roomdetails VALUES("Hi","2","2","255","35");



DROP TABLE IF EXISTS statelist;

CREATE TABLE `statelist` (
  `statename` text,
  `countryname` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO statelist VALUES("Dubai","United Arab Emirates");
INSERT INTO statelist VALUES("Ile-de-France","France");
INSERT INTO statelist VALUES("Maharashtra","India");
INSERT INTO statelist VALUES("Goa","India");



DROP TABLE IF EXISTS tablelist;

CREATE TABLE `tablelist` (
  `TableName` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tablelist VALUES("application");
INSERT INTO tablelist VALUES("enquiry");
INSERT INTO tablelist VALUES("citylist");
INSERT INTO tablelist VALUES("countrylist");
INSERT INTO tablelist VALUES("statelist");
INSERT INTO tablelist VALUES("receipt");
INSERT INTO tablelist VALUES("params");
INSERT INTO tablelist VALUES("HotelList");
INSERT INTO tablelist VALUES("feedback");
INSERT INTO tablelist VALUES("LoginHistory");
INSERT INTO tablelist VALUES("messanger");
INSERT INTO tablelist VALUES("roomdetails");
INSERT INTO tablelist VALUES("dbactivity");



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



