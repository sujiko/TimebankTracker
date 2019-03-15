use S19_430_Group2_Zeitz
drop table if exists admin;
create table admin( 
  username varchar(30),
  password character(60),
  PRIMARY KEY (username)
);
insert into admin values ('cwatt',ENCODE('cwatt','PROJECT')),
('aMalyevac',ENCODE('aMalyevac','PROJECT')),
('jZeitz',ENCODE('jZeitz','PROJECT')),
('aQureshi',ENCODE('aQureshi','PROJECT'));
