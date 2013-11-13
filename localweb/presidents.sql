# Presidents of the United States
# Authors: Aaron Kippins & Zack Meath

use site_db
create database if not exists site_db;
drop table if exists presidents;
create table presidents
(
id int auto_increment primary key,
fname  text     not null,
lname  text     not null,
number int      not null,
dob    datetime not null
);

insert into presidents(fname , lname, number, dob)
	values ('George','Washington','1','1732-02-22 00:00:00'),
	('John','Adams','6','1767-06-11 00:00:00'),
	('Abraham','Lincoln','16','1809-02-12 00:00:00'),
	('Franklin','Roosevelt','32','1882-01-30 00:00:00'),
	('Richard','Nixon','37','1913-01-09 00:00:00');
	
select * from presidents;

select * from presidents
order by number;

select * from presidents
order by lname;

select * from presidents
order by dob desc;