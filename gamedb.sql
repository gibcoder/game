CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `SQ` int(11) NOT NULL,
  `SQA` varchar(100) NOT NULL,
  `acc_type` varchar(10) NOT NULL) 
  ENGINE=InnoDB 

CREATE TABLE `gamedb`.`student` (
    `student_id` INT NOT NULL AUTO_INCREMENT,
    `account_id` INT NOT NULL,
    `HS` INT NOT NULL,
    `AvS` INT NOT NULL,
    `TS` INT NOT NULL,
    `GP` INT NOT NULL,
    PRIMARY KEY (`student_id`),
    FOREIGN KEY (`account_id`) REFERENCES `account`(`account_id`)
) ENGINE = InnoDB;
CREATE TABLE `gamedb`.`teacher` (
    `teacher_id` INT NOT NULL AUTO_INCREMENT,
    `account_id` INT NOT NULL,
    PRIMARY KEY (`teacher_id`),
    FOREIGN KEY (`account_id`) REFERENCES `account`(`account_id`)
) ENGINE = InnoDB;
CREATE TABLE `gamedb`.`class` (
    `classCode` VARCHAR(20) NOT NULL,
    `teacher_id` INT NOT NULL,
    PRIMARY KEY (`classCode`),
    FOREIGN KEY (`teacher_id`) REFERENCES `teacher`(`teacher_id`)
) ENGINE = InnoDB;
CREATE TABLE `gamedb`.`studentclass` (
    `student_id` INT NOT NULL,
    `classCode` VARCHAR(20) NOT NULL,
    FOREIGN KEY (`student_id`) REFERENCES `student`(`student_id`),
    FOREIGN KEY (`classCode`) REFERENCES `class`(`classCode`)
) ENGINE = InnoDB;

ALTER TABLE `account` ADD COLUMN `login_count` INT DEFAULT 0;