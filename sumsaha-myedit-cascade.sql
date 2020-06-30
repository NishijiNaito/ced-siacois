-- -----------------------------------------------------
-- Schema sumsaha
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `sumsaha` ;

-- -----------------------------------------------------
-- Schema sumsaha
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sumsaha` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `sumsaha` ;

-- -----------------------------------------------------
-- Table `sumsaha`.`users_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`users_role` (
  `users_role_id` INT NULL AUTO_INCREMENT,
  `users_role_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`users_role_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sumsaha`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`users` (
  `users_id` INT NULL AUTO_INCREMENT,
  `users_name` VARCHAR(45) NOT NULL,
  `users_Password` VARCHAR(32) NOT NULL,
  `users_FLName` VARCHAR(100) NOT NULL,
  `users_role` INT NOT NULL,
  PRIMARY KEY (`users_id`),
  CONSTRAINT `user_role`
    FOREIGN KEY (`users_role`)
    REFERENCES `sumsaha`.`users_role` (`users_role_id`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;

CREATE INDEX `user_role_idx` ON `sumsaha`.`users` (`users_role` ASC) INVISIBLE;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `sumsaha`.`users` (`users_name` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `sumsaha`.`University`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`UniCol` (
  `UniCol_id` INT NOT NULL AUTO_INCREMENT,
  `UniCol_name` VARCHAR(100) NOT NULL,
  `UniCol_formtype` ENUM('in', 'out') NULL,
  `UniCol_type` ENUM('uni','col') NULL,
  PRIMARY KEY (`UniCol_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sumsaha`.`Faculty`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`Faculty` (
  `Faculty_id` INT NOT NULL AUTO_INCREMENT,
  `Faculty_name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`Faculty_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sumsaha`.`Department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`Department` (
  `Department_id` INT NOT NULL AUTO_INCREMENT,
  `Department_name` VARCHAR(100) NOT NULL,
  `Department_type` ENUM('uni','col') NOT NULL,
  PRIMARY KEY (`Department_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sumsaha`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`student` (
  `student_id` VARCHAR(15) NOT NULL,
  `student_password` VARCHAR(32) NOT NULL,
  `student_FNS` VARCHAR(10) NOT NULL,
  `student_FName` VARCHAR(45) NOT NULL,
  `student_LName` VARCHAR(45) NOT NULL,
  `student_UniCol` INT NOT NULL,
  `student_Faculty` INT NULL,
  `student_department` INT NULL,
  `student_Year` INT(1) NULL,
  `student_type` ENUM('1', '2') NOT NULL,
  `student_Start` DATE NOT NULL,
  `student_End` DATE NOT NULL,
  PRIMARY KEY (`student_id`, `student_Start`),
  CONSTRAINT `uni`
    FOREIGN KEY (`student_UniCol`)
    REFERENCES `sumsaha`.`UniCol` (`UniCol_id`)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT `fac`
    FOREIGN KEY (`student_Faculty`)
    REFERENCES `sumsaha`.`Faculty` (`Faculty_id`)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT `dep`
    FOREIGN KEY (`student_department`)
    REFERENCES `sumsaha`.`Department` (`Department_id`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;

CREATE INDEX `uni_idx` ON `sumsaha`.`student` (`student_University` ASC) VISIBLE;

CREATE INDEX `fac_idx` ON `sumsaha`.`student` (`student_Facuty` ASC) VISIBLE;

CREATE INDEX `dep_idx` ON `sumsaha`.`student` (`student_department` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `sumsaha`.`Leaves`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`Leaves` (
  `Leaves_id` INT NOT NULL AUTO_INCREMENT,
  `Leaves_Std_id` VARCHAR(15) NOT NULL,
  `Leaves_Std_Start` DATE NULL,
  `Leaves_Type` ENUM('1', '2') NOT NULL,
  `Leaves_Reason` LONGTEXT NOT NULL,
  `Leaves_Time_Request` DATETIME NULL,
  PRIMARY KEY (`Leaves_id`),
  CONSTRAINT `Leave_Std_id`
    FOREIGN KEY (`Leaves_Std_id`,`Leaves_Std_Start`)
    REFERENCES `sumsaha`.`student` (`student_id`,`student_Start`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;

CREATE INDEX `Leave_Std_id_idx` ON `sumsaha`.`Leaves` (`Leaves_Std_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `sumsaha`.`form_accept`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`form_accept` (
  `form_id` INT NOT NULL AUTO_INCREMENT,
  `form_unicol` INT NULL,
  `form_fac` INT NULL,
  `form_dep` INT NULL,
  `form_ref` VARCHAR(100) NULL,
  `form_start` DATE NULL,
  `form_end` DATE NULL,
  `form_amo` INT NULL,
  `form_type` ENUM('1', '2') NULL,
  PRIMARY KEY (`form_id`),
  CONSTRAINT `fau`
    FOREIGN KEY (`form_unicol`)
    REFERENCES `sumsaha`.`UniCol` (`UniCol_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `faf`
    FOREIGN KEY (`form_fac`)
    REFERENCES `sumsaha`.`Faculty` (`Faculty_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fad`
    FOREIGN KEY (`form_dep`)
    REFERENCES `sumsaha`.`Department` (`Department_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fau_idx` ON `sumsaha`.`form_accept` (`form_unicol` ASC) VISIBLE;

CREATE INDEX `faf_idx` ON `sumsaha`.`form_accept` (`form_fac` ASC) VISIBLE;

CREATE INDEX `fad_idx` ON `sumsaha`.`form_accept` (`form_dep` ASC) VISIBLE;




-- -----------------------------------------------------
-- Table `sumsaha`.`form_return`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`form_return` (
  `form_id` INT NOT NULL AUTO_INCREMENT,
  `form_unicol` INT NULL,
  `form_fac` INT NULL,
  `form_dep` INT NULL,
  `form_about` MEDIUMTEXT NULL,
  `form_start` DATE NULL,
  `form_end` DATE NULL,
  `form_amo` INT NULL,
  `form_type` ENUM('1', '2') NULL,
  PRIMARY KEY (`form_id`),
  CONSTRAINT `fou`
    FOREIGN KEY (`form_unicol`)
    REFERENCES `sumsaha`.`UniCol` (`UniCol_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fof`
    FOREIGN KEY (`form_fac`)
    REFERENCES `sumsaha`.`Faculty` (`Faculty_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fod`
    FOREIGN KEY (`form_dep`)
    REFERENCES `sumsaha`.`Department` (`Department_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fau_idx` ON `sumsaha`.`form_return` (`form_unicol` ASC) VISIBLE;

CREATE INDEX `faf_idx` ON `sumsaha`.`form_return` (`form_fac` ASC) VISIBLE;

CREATE INDEX `fad_idx` ON `sumsaha`.`form_return` (`form_dep` ASC) VISIBLE;

-- -----------------------------------------------------
-- Table `sumsaha`.`evaluate`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sumsaha`.`evaluate` ;

CREATE TABLE IF NOT EXISTS `sumsaha`.`evaluate` (
  `evaluate_id` INT NOT NULL AUTO_INCREMENT,
  `evaluate_Std_id` VARCHAR(15) NOT NULL,
  `evaluate_Std_start` DATE NULL,
  `evaluate_date` DATE NULL,
  `evaluate_address` TEXT NULL,
  `evaluate_section` ENUM('1', '2', '3') NULL,
  `evaluate_year` INT NULL,
  `evaluate_range` ENUM('1', '2', '3') NULL,
  `evaluate_Q01` INT NULL,
  `evaluate_Q02` INT NULL,
  `evaluate_Q03` INT NULL,
  `evaluate_Q04` INT NULL,
  `evaluate_Q05` INT NULL,
  `evaluate_Q06` INT NULL,
  `evaluate_Q07` INT NULL,
  `evaluate_Q08` INT NULL,
  `evaluate_Q09` INT NULL,
  `evaluate_QCom` TEXT NULL,
  PRIMARY KEY (`evaluate_id`),
    FOREIGN KEY (`evaluate_Std_id`,`evaluate_Std_start`)
    REFERENCES `sumsaha`.`student` (`student_id`,`student_Start`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;




USE `sumsaha` ;

-- -----------------------------------------------------
-- Placeholder table for view `sumsaha`.`upr`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sumsaha`.`upr` (`users_id` INT, `users_name` INT, `users_password` INT, `users_role_name` INT, `users_FLName` INT);

-- -----------------------------------------------------
-- View `sumsaha`.`upr`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sumsaha`.`upr`;
USE `sumsaha`;
CREATE  OR REPLACE VIEW upr AS 
select users_id,users_name,users_password,users_role_name,users_FLName from users,users_role where users.users_role=users_role.users_role_id;

-- -----------------------------------------------------
-- View `sumsaha`.`eval`
-- -----------------------------------------------------

USE `sumsaha`;
CREATE  OR REPLACE VIEW `eval` AS 
select evaluate_date as da,
UniCol_name as ucname,
evaluate_address as addr,
evaluate_section as sec,
student_type as typ,
evaluate_year as yrs ,
student_Start as sta_date,student_End as en_date,
evaluate_range as rang,
evaluate_Q01
,evaluate_Q02
,evaluate_Q03
,evaluate_Q04
,evaluate_Q05
,evaluate_Q06
,evaluate_Q07
,evaluate_Q08
,evaluate_Q09
,evaluate_QCom

from student,evaluate ,UniCol
where	student_id = evaluate_Std_id and student_Start =evaluate_Std_start and student_UniCol=UniCol_id;




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `sumsaha`.`users_role`
-- -----------------------------------------------------
START TRANSACTION;
USE `sumsaha`;
INSERT INTO `sumsaha`.`users_role` (`users_role_id`, `users_role_name`) VALUES (1, 'admin');
INSERT INTO `sumsaha`.`users_role` (`users_role_id`, `users_role_name`) VALUES (2, 'science');
INSERT INTO `sumsaha`.`users_role` (`users_role_id`, `users_role_name`) VALUES (3, 'officer');
INSERT INTO `sumsaha`.`users_role` (`users_role_id`, `users_role_name`) VALUES (4, 'Head');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sumsaha`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `sumsaha`;
INSERT INTO `sumsaha`.`users` (`users_id`, `users_name`, `users_Password`, `users_FLName`, `users_role`) VALUES (1, 'rootadmin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Root Admin', 1);
INSERT INTO `sumsaha`.`users` (`users_id`, `users_name`, `users_Password`, `users_FLName`, `users_role`) VALUES (2, 'rootofficer', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Root Officer', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `sumsaha`.`University`
-- -----------------------------------------------------
START TRANSACTION;
USE `sumsaha`;
INSERT INTO `sumsaha`.`UniCol` (`UniCol_id`, `UniCol_name`, `UniCol_formtype`,`UniCol_type`) VALUES (1, 'สงขลานครินทร์ วิทยาเขตหาดใหญ่', 'in','uni');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sumsaha`.`Faculty`
-- -----------------------------------------------------
START TRANSACTION;
USE `sumsaha`;
INSERT INTO `sumsaha`.`Faculty` (`Faculty_id`, `Faculty_name`) VALUES (1, 'วิทยาศาสตร์');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sumsaha`.`Department`
-- -----------------------------------------------------
START TRANSACTION;
USE `sumsaha`;
INSERT INTO `sumsaha`.`Department` (`Department_id`, `Department_name`) VALUES (1, 'วิทยาการคอมพิวเตอร์');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sumsaha`.`student`
-- -----------------------------------------------------
START TRANSACTION;
USE `sumsaha`;
INSERT INTO `sumsaha`.`student` (`student_id`, `student_password`, `student_FNS`, `student_FName`, `student_LName`, `student_UniCol`, `student_Faculty`, `student_department`, `student_Year`, `student_type`, `student_Start`, `student_End`) VALUES ('6010210252', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'นาย', 'สัณหวัชร', 'แก้วยะรัตน์', 1, 1, 1, 3, '1', '2019/10/17', '2019/12/17');

COMMIT;

