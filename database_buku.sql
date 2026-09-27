create database crud_paw;
use crud_paw;

create table buku (
	id int auto_increment primary key,
    judul varchar(100) not null, 
    penulis varchar(100) not null,
    tahun int not null
);
