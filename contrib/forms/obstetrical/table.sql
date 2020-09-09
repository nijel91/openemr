CREATE TABLE IF NOT EXISTS `form_obstetrical` (
id bigint(20) NOT NULL auto_increment,
date datetime default NULL,
pid bigint(20) default NULL,
user varchar(255) default NULL,
groupname varchar(255) default NULL,
authorized tinyint(4) default NULL,
activity tinyint(4) default NULL,
name longtext,
birthdate datetime,
feeding longtext,
birth_status longtext,
gender longtext,
circumcised varchar(255),
delivery_method longtext,
labor_hours longtext,
birth_weight longtext,
pregnancy_weeks longtext,
anesthesia longtext,
pediatrician longtext,
length_inches longtext,
head_circumference_inches longtext,
reactions_to_medications_and_immunizations longtext,
birth_complications longtext,
developmental_problems longtext,
chronic_illness longtext,
chronic_medication longtext,
hospitalization longtext,
surgery longtext,
injury longtext,
day_care longtext,
additional_notes longtext,
PRIMARY KEY (id)
) ENGINE=InnoDB;
