create database if not exists forest_management;
use forest_management;

create table forest (
    Official_name varchar(40),
    Lat_north decimal(10,8),
    Lat_south decimal(10,8),
    Long_east decimal(11,8),
    Long_west decimal(11,8),
    primary key (Official_name)
);

create table Forest_location (
    Forest_name varchar(40),
    country varchar(40),
    primary key (Forest_name)
);

create table Climate (
    Climate_name varchar(20),
    Avg_rainfall int(10),
    primary key (Climate_name)
);

create table Cell (
    id int(11),
    X_coordinate int(4),
    Y_coordinate int(4),
    Forest_name varchar(40), 
    Climate_name varchar(20),
    primary key (id)
);

create table Tree_species (
    Scientific_name varchar(40),
    lifespan int(4),
    Dispersal_distance float(4,2),
    Fire_tolerance float(4,2),
    DBH float(4,2),
    primary key (Scientific_name)
);

create table Contains_species (
    Species_name varchar(40),
    cell_id int(11),
    year_recorded YEAR(4),
    count int(10),
    primary key (Species_name, cell_id)
);

