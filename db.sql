use S19_430_Group2_Zeitz
drop table if exists admin;
drop table if exists students;
drop table if exists assignments;
create table admin( 
  username varchar(30),
  password character(60),
  PRIMARY KEY (username)
);
create table assignments(
  pid varchar(30),
  class varchar(30),
  assignmentName varchar(50),
  initDue DATE,
  daysUsed int,
  newDueDate DATE
);
create table students(
  pid varchar(30),
  firstname varchar(30),
  lastname varchar(30),
  password character(60),
  class varchar(60),
  agreement int,
  days int
);

insert into admin values ('cwatt',ENCODE('cwatt','PROJECT')),
('amalyevac',ENCODE('amalyevac','PROJECT')),
('jzeitz',ENCODE('jzeitz','PROJECT')),
('aqureshi',ENCODE('aqureshi','PROJECT'));
