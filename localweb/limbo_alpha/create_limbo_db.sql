# This file creates the Limbo database.
# Author: <Zach Meath & Aaron Kippins>

drop database if exists limbo_db ;
create database limbo_db ;
use limbo_db ;

drop table if exists lost_items
create table lost_items
(
item_id      int    not null   primary key,
description  text, 
object       text   not null,
size         text, 
color        text,
weight       int,
date_found   date   not null,
place_found  text   not null
);

explain stuff;