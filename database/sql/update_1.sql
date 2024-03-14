create table if not exists db_version(
	db_id	int not null,
	name	varchar(20) not null,
	descr	varchar(255) not null,
	primary key(db_id)
);

INSERT INTO db_version
(db_id,name,descr)
VALUES
(1,'database version 0.1','added db_version, employee_allowance table and salary, grade column to employee table')
;


create table if not exists employee_allowance(
        id   int not null,
        grade   varchar(20) not null,
        allowance   int not null,
        primary key(id)
);

INSERT INTO employee_allowance
(id,grade,allowance)
VALUES
(1,'4A',25),
(2,'5A',50),
(3,'6A',75),
(4,'7A',100)
;


ALTER TABLE employee ADD COLUMN grade VARCHAR(255) DEFAULT '4A' NOT NULL;
ALTER TABLE employee ADD COLUMN salary double DEFAULT 100 NOT NULL;



