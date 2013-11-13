# This file creates and populates the Limbo database.
# Author: <Zach Meath & Aaron Kippins>
# Version 0.1

#--Clearing the space in prep to create the database 
drop database limbo_db;
create database if not exists limbo_db;
use limbo_db;

#--Creating the table users which hold the administrative user
drop table if exists users cascade;
create table if not exists users 
(
user_id    int        not null   auto_increment   primary key,
username   char(20)   not null,
pass       char(40)   not null
);

#--Inserting data into the users table
insert into users(username, pass)
	values ('admin','gaze11e');
	
#--Creating the table stuff to hold an inventory of the items found this table will work cooperatively with the locations table
drop table if exists stuff cascade;
create table if not exists stuff
(
id            int                             auto_increment   primary key,
location_id   int                             not null         references locations(id),
description   text                            not null,
create_date   datetime                        not null,
update_date   datetime                        not null,
room          text,
owner         text,
finder        text,
status        set('found','lost','claimed')   not null
);

#--Creating the table locations to store the data of the locations of which the lost stuff was found this will work cooperatively with the stuff table
drop table if exists locations cascade;
create table if not exists locations
(
id            int        primary key   auto_increment,
create_date   datetime   not null,
update_date   datetime   not null,
name          text       not null
);


#--Inserting data into the locations table
insert into locations(create_date, update_date, name)
	values ('now()','now()','Hancock Center');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Dyson Center');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Donnelly Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Lowell Thomas');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Fontaine Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Fontaine Annex');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Library');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Leo Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Champagnat Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Sheahan Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Marian Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Byrne House');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Our Lady Seat Of Wisdom Chapel');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Cornell Boathouse');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Fern Tor');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Foy Townhouses');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Fulton Street Townhouses');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','New Fulton Townhouses');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Gartland Commons');	
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Greystone Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Kieran Gatehouse');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Kirk House');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Longview Park');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Lower Townhouses');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Marist Boathouse');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','McCann Center');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Midrise Hall');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','New Townhouses');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','St.Ann\s Hermitage');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','St.Peter\s');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Steel Plant Art Studios');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Rotunda');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Tenney Stadium');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Tennis Pavilion');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Lower West Cedar Townhouses');
	
insert into locations(create_date, update_date, name)
	values ('now()','now()','Upper West Cedar Townhouses');
	
#--Testing to see if the data was inserted properly
explain stuff;

explain users;

explain locations;

select * from stuff;

select * from users;

select * from locations
order by name;

