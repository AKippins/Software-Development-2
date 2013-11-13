# This file creates the Limbo database.
# Author: <Zach Meath & Aaron Kippins>
drop database if exists limbo_db ;
create database limbo_db ;
use limbo_db ;
create table if not exists stuff
(
	id    int not null,
	descr text, 
	object text,
	size text, 
	color text
);
alter table stuff
add primary key (id),
change descr description text,
add column weight int,
add column date_found date,
add column place_found text;
explain stuff;