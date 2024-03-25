INSERT INTO db_version
(db_id,name,descr)
VALUES
(4,'database version 0.1','updated employee tbale and user table')
;

ALTER TABLE employee
ADD COLUMN employee_id varchar(255) DEFAULT NULL;



