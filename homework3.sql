create database if not exists company;
use company;

create table EMPLOYEE (
    Fname varchar(20),
    Minit char(1),
    Lname varchar(20),
    Ssn integer(9),
    Bdate date not null,
    Address varchar(40),
    Sex char(1) check(sex='F' or sex='M'),
    Salary int check(Salary>=0),
    Super_ssn integer(9),
    Dno integer not null,
    primary key (Ssn)
);

alter table EMPLOYEE add constraint fk_Super_ssn foreign key (Super_ssn) references EMPLOYEE (Ssn);


create table DEPARTMENT (
    Dname varchar(30) not null,
    Dnumber integer,
    Mgr_ssn integer(9) not null,
    Mgr_start_date date,
    primary key (Dnumber)
);

alter table DEPARTMENT add constraint fk_Mgr_ssn foreign key (Mgr_ssn) references EMPLOYEE (Ssn);
alter table EMPLOYEE add constraint fk_Dno foreign key (Dno) references DEPARTMENT (Dnumber);


create table DEPT_LOCATIONS (
    Dnumber integer not null,
    Dlocation varchar(20),
    primary key (Dnumber, Dlocation)
);

alter table DEPT_LOCATIONS add constraint fk_Dnumber foreign key (Dnumber) references DEPARTMENT (Dnumber);

create table PROJECT (
    Pname varchar(20) not null,
    Pnumber integer(2),
    Plocation varchar(20) not null,
    Dnum integer not null,
    primary key (Pnumber)
);

alter table PROJECT add constraint fk_Dnum foreign key (Dnum) references DEPARTMENT (Dnumber);

create table WORKS_ON (
    Essn integer(9) not null,
    Pno integer(2) not null,
    Hours numeric(3,2),
    primary key (Essn, Pno)
);

alter table WORKS_ON add constraint fk_Essn foreign key (Essn) references EMPLOYEE (Ssn);
alter table WORKS_ON add constraint fk_Pno foreign key (Pno) references PROJECT (Pnumber);

create table DEPENDENT (
    Essn integer(9),
    Dependent_name varchar(20),
    Sex char(1) check(sex="F" or sex="M"),
    Bdate date not null, 
    Relationship varchar(20) not null,
    primary key (Essn, Dependent_name)
);

alter table DEPENDENT add constraint fk_Dependent_Essn foreign key (Essn) references EMPLOYEE (Ssn);

