use forest_management;
alter table Forest_location add constraint fk_Forest_name foreign key (Forest_name) references Forest (Official_name);
alter table Cell add constraint fk_cell_forest foreign key (Forest_name) references Forest (Official_name);
alter table Cell add constraint fk_cell_climate foreign key (Climate_name) references Climate (Climate_name);
alter table Contains_species add constraint fk_species_relation (Species_name) references Tree_species (Scientific_name);
alter table Contains_species add constraint fk_cell_relation (cell_id) references Cell (id);