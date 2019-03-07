#drop database if exists coin;
#create database coin default character set utf8;
#use coin;

#UTF8 NA SERVERU
alter database default character set utf8;

create table cc(
id int not null primary key auto_increment,
user int not null,
denomination decimal(4,2) not null,
amount int default 0,
total decimal(10,2) default 0
);

create table user(
id int not null primary key auto_increment,
name varchar(50) not null,
password varchar(50) not null,
email varchar(50) not null
);

alter table cc add foreign key (user) references user(id);


insert into user(name, password, email) values("jurica",md5("password"),"juraos1@yahoo.com");

insert into cc(user,denomination, amount, total) values(1,"0.01", 0, 0),
	 (1,"0.02", 0, 0),
		 (1,"0.05", 0, 0),
			 (1,"0.10", 0, 0),
				 (1,"0.20" , 0, 0),
					 (1,"0.50", 70, 35),
						 (1,"1.00", 69, 69),
							(1,"2.00", 65, 130),
								(1,"5.00", 46, 230),
									(1,"25.00", 0, 0);
