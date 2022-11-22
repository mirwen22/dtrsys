/* SQL Manager for MySQL                              5.8.0.53936 */
/* -------------------------------------------------------------- */
/* Host     : localhost                                           */
/* Port     : 3306                                                */
/* Database : db_dtrsys                                           */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8mb4' */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `db_dtrsys`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `db_dtrsys`;

/* Structure for the `dtr` table :  */

CREATE TABLE `dtr` (
  `emptime_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `emp_id` INTEGER(11) DEFAULT NULL,
  `ua_id` INTEGER(11) DEFAULT NULL,
  `emptime_datetime` DATETIME DEFAULT NULL,
  `emptime_timein` DATETIME DEFAULT NULL,
  `emptime_timeout` DATETIME DEFAULT NULL,
  PRIMARY KEY USING BTREE (`emptime_id`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `employee` table :  */

CREATE TABLE `employee` (
  `emp_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `emp_fname` VARCHAR(50) COLLATE latin1_swedish_ci DEFAULT NULL,
  `emp_lname` VARCHAR(50) COLLATE latin1_swedish_ci DEFAULT NULL,
  `emp_createBy` INTEGER(11) DEFAULT NULL,
  `emp_datetimeAdded` DATETIME DEFAULT NULL,
  `emp_datetimeUpdated` DATETIME DEFAULT NULL,
  PRIMARY KEY USING BTREE (`emp_id`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `employee_qrcode` table :  */

CREATE TABLE `employee_qrcode` (
  `emp_qrID` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `emp_id` INTEGER(11) DEFAULT NULL,
  `emp_qrCode` VARCHAR(40) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`emp_qrID`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `user_type` table :  */

CREATE TABLE `user_type` (
  `ut_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `ut_desc` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`ut_id`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `useraccount` table :  */

CREATE TABLE `useraccount` (
  `ua_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `ua_fullname` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `ua_username` VARCHAR(30) COLLATE latin1_swedish_ci NOT NULL,
  `ua_password` VARCHAR(30) COLLATE latin1_swedish_ci NOT NULL,
  `ut_id` INTEGER(11) NOT NULL,
  `ua_datetimeAdded` DATETIME NOT NULL,
  `ua_datetimeModified` DATETIME DEFAULT NULL,
  `ua_remove` TINYINT(4) DEFAULT 0,
  PRIMARY KEY USING BTREE (`ua_id`),
  UNIQUE KEY `ua_id` USING BTREE (`ua_id`),
  UNIQUE KEY `ua_username` USING BTREE (`ua_username`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Data for the `user_type` table  (LIMIT 0,500) */

INSERT INTO `user_type` (`ut_id`, `ut_desc`) VALUES
  (1,'Super Admin'),
  (2,'Admin');
COMMIT;

/* Data for the `useraccount` table  (LIMIT 0,500) */

INSERT INTO `useraccount` (`ua_id`, `ua_fullname`, `ua_username`, `ua_password`, `ut_id`, `ua_datetimeAdded`, `ua_datetimeModified`, `ua_remove`) VALUES
  (1,'Mirwen John Oraiz','superadmin','Qwerty!2345',1,'2022-11-21 00:44:00',NULL,0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;