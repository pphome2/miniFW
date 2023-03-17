# sql isntall

create database if not exists minifw;

use minifw;

create table if not exists users (
    id bigint auto_increment primary key,
    name varchar(40) charset utf8,
    pass varchar(40) charset utf8,
    email varchar(40) charset utf8,
    comm  varchar(246) charset utf8,
    key name (name(20))
) engine=InnoDB default charset latin1;

create table if not exists params (
    id bigint auto_increment primary key,
    name varchar(20) charset utf8,
    value varchar(80) charset utf8,
    key name (name(20))
) engine=InnoDB default charset latin1;

replace into users (id, name, pass, email, comm) values (1, "admin", "e3274be5c857fb42ab72d786e281b4b8", "", "");
