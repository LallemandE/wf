
ALTER TABLE person_address ADD CONSTRAINT constraint_name 
FOREIGN KEY (Personid) 
REFERENCES Person(id);

ALTER TABLE person_address ADD CONSTRAINT constraint2 
FOREIGN KEY (Addressid) 
REFERENCES address(id);

ALTER TABLE person_address ADD CONSTRAINT constraint3 
FOREIGN KEY (Address_typeid) 
REFERENCES address_type(id);

alter table town add constraint constraint4
foreign key (Countryid)
references Country(id);

alter table address add constraint constraint5
foreign key (Townid)
references Town(id);