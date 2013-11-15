# This file creates the Limbo database.
# Author: <Zach Meath & Aaron Kippins>

drop database if exists limbo_db ;
create database limbo_db ;
use limbo_db ;

#--Creating the table locations to store the data of the locations of which the lost stuff was found this will work cooperatively with the stuff table
drop table if exists locations;
create table if not exists locations
(
location_id    int    primary key   auto_increment,
create_date    date   not null,
update_date    date   not null,
location_name  text   not null
);



drop table if exists inventory;
create table inventory
(
item_id       serial not null  primary key,
description   text, 
object        text   not null,
date_found    date   not null,
location_id   int    not null  references locations(location_id),
room          text,
owner         text,
finder        text,
status        set('found','lost','claimed')   not null
);

drop table if exists users;
create table if not exists users 
(
user_id    int        not null   auto_increment   primary key,
username   char(20)   not null,
pass       char(40)   not null
);

#--Inserting data into the users table
insert into users(username, pass)
	values ('admin','gaze11e');
	


#--Inserting data into the locations table
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Hancock Center');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Dyson Center');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Donnelly Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Lowell Thomas');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Fontaine Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Fontaine Annex');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Library');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Leo Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Champagnat Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Sheahan Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Marian Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Byrne House');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Our Lady Seat Of Wisdom Chapel');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Cornell Boathouse');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Fern Tor');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Foy Townhouses');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Fulton Street Townhouses');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','New Fulton Townhouses');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Gartland Commons');	
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Greystone Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Kieran Gatehouse');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Kirk House');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Longview Park');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Lower Townhouses');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Marist Boathouse');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','McCann Center');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Midrise Hall');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','New Townhouses');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','St.Ann\s Hermitage');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','St.Peter\s');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Steel Plant Art Studios');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Rotunda');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Tenney Stadium');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Tennis Pavilion');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Lower West Cedar Townhouses');
	
insert into locations(create_date, update_date, location_name)
	values ('now()','now()','Upper West Cedar Townhouses');


explain inventory;
