# Run the create command first

CREATE TABLE products2 (
id INT NOT NULL AUTO_INCREMENT,
sku VARCHAR(8) NOT NULL,
name VARCHAR(25) NOT NULL,
price DECIMAL(5,2) NOT NULL,
PRIMARY KEY(id)
)

# Then run the following 4 insert commands:

insert into products2 set sku = 'TY232278', name = 'AquaSmooth Toothpaste', price = 2.25;
insert into products2 set sku = 'PO988932', name = 'HeadsFree Shampoo', price = 3.99;
insert into products2 set sku = 'ZP457321', name = 'Painless Aftershave', price = 4.50;
insert into products2 set sku = 'KL334899', name = 'WhiskerWrecker Razors', price = 4.17;

# Add two more columns for images

alter table products2 add image blob
alter table products2 add imgtype varchar(50)
