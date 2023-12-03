CREATE table phpadmins(
	user_id int not null auto_increment,
	first_name varchar (255),
	last_name varchar (255),
	username varchar (255),
	password varchar (255),
    primary key (user_id)
);
CREATE table phppeople(
	fname varchar (255),
	lname varchar (255),
	email varchar (255),
	telNumber varchar (255),
    primary key (ID)
);
INSERT into phppeople(fname, lname, email, telNumber)
VALUES
    ('Ricky', 'Bobby', 'ricky@email.ca', '7051234567'),
    ('Jane', 'Doe', 'jane@gmail.ca', '7051234567'),
    ('Jon', 'Doe', 'jon@gmail.ca', '7051234567'),
    ('Zeb', 'Something', 'zeb@email.com', '7051234567'),
    ('Laura', 'Smith', 'laura@someemail.com', '7051234567'),
    ('Randy', 'Smith', 'randy@gmail.com', '7051234567'),
    ('Pierce', 'Something', 'pierce@anemail.ca', '7051234567');

CREATE TABLE imagesTest(
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    image varchar(255) NOT NULL,
    PRIMARY KEY (id)
);