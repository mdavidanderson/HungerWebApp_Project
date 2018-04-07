DROP DATABASE IF EXISTS HungerDB;
CREATE DATABASE HungerDB;

USE HungerDB;

CREATE TABLE meats (
  meat_id int(11) NOT NULL COMMENT 'PK',
  meat_name varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE menu (
    menu_id INT(11) NOT NULL COMMENT 'PK',
    restaurant_id INT(11) NOT NULL COMMENT 'FK RESTAURANTS TABLE'
);


CREATE TABLE item (
    item_id INT(11) NOT NULL COMMENT 'PK',
    menu_id INT(11) NOT NULL COMMENT 'FK MENU TABLE',
    item_name VARCHAR(255) NOT NULL,
    item_description TEXT(1000) NOT NULL,
    meat_id INT(11) NOT NULL COMMENT 'FK MEATS TABLE',
    spicy BOOLEAN NOT NULL,
    price DECIMAL(10,2) DEFAULT 0.0
);


CREATE TABLE location (
  location_id int(11) NOT NULL COMMENT 'PK',
  street_address varchar(255) NOT NULL,
  zip_code int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE orders (
  order_id INT(11) NOT NULL COMMENT 'PK',
  order_date DATE NOT NULL,
  user_id INT(11) NOT NULL COMMENT 'FK',
  total DECIMAL(10,2) NOT NULL DEFAULT 0.0
  );

CREATE TABLE ordered_items (
  ordered_id INT (11) NOT NULL COMMENT 'PK',
  order_id INT (11) NOT NULL COMMENT 'fk',
  item_id INT (11) NOT NULL COMMENT 'fk',
  quantity INT (11) NOT NULL
);

CREATE TABLE restaurants (
  restaurant_id int(11) NOT NULL COMMENT 'PK',
  location_id int(11) NOT NULL COMMENT 'FK Location Table',
  owner int(11) NOT NULL COMMENT 'FK Users table',
  restaurant_name varchar(50) NOT NULL,
  phone varchar(11) NOT NULL,
  rating int(1) NOT NULL COMMENT '1 to 5'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE users (
  user_id int(11) NOT NULL COMMENT 'PK',
  username varchar(25) NOT NULL,
  password varchar(25) NOT NULL,
  usertype_id int(11) NOT NULL COMMENT 'FK USERTYPE TABLE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE usertype (
  usertype_id int(11) NOT NULL,
  usertype_name varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE orders ADD PRIMARY KEY (order_id);
ALTER TABLE orders MODIFY order_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE ordered_items ADD PRIMARY KEY (ordered_id);
ALTER TABLE ordered_items MODIFY ordered_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE meats ADD PRIMARY KEY(meat_id);
ALTER TABLE meats MODIFY meat_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE menu ADD PRIMARY KEY(menu_id);
ALTER TABLE menu MODIFY menu_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE item ADD PRIMARY KEY(item_id);
ALTER TABLE item MODIFY item_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE restaurants ADD PRIMARY KEY(restaurant_id);
ALTER TABLE restaurants MODIFY restaurant_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE location ADD PRIMARY KEY(location_id);
ALTER TABLE location MODIFY location_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE users ADD PRIMARY KEY (user_id);
ALTER TABLE users MODIFY user_id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE usertype ADD PRIMARY KEY (usertype_id);
ALTER TABLE usertype MODIFY usertype_id INT(11) NOT NULL AUTO_INCREMENT;
 
ALTER TABLE orders ADD FOREIGN KEY(user_id) REFERENCES users(user_id);

ALTER TABLE ordered_items ADD FOREIGN KEY(order_id) REFERENCES orders(order_id);
ALTER TABLE ordered_items ADD FOREIGN KEY(item_id) REFERENCES item(item_id);

ALTER TABLE menu ADD FOREIGN KEY(restaurant_id) REFERENCES restaurants(restaurant_id);
ALTER TABLE item ADD FOREIGN KEY(menu_id) REFERENCES menu(menu_id);
ALTER TABLE item ADD FOREIGN KEY(meat_id) REFERENCES meats(meat_id);
ALTER TABLE users ADD FOREIGN KEY(usertype_id) REFERENCES usertype(usertype_id);
ALTER TABLE restaurants ADD FOREIGN KEY(location_id) REFERENCES location(location_id);
ALTER TABLE restaurants ADD FOREIGN KEY(owner) REFERENCES users(user_id);

INSERT INTO usertype (usertype_name)
	VALUES ('owner'), ('customer');

INSERT INTO users (username, password, usertype_id) 
	VALUES ('owner1', '1234', (SELECT usertype_id FROM usertype WHERE usertype_name='owner')),
	('customer1', '4321', (SELECT usertype_id FROM usertype WHERE usertype_name='customer'));

INSERT INTO location (street_address, zip_code) 
	VALUES ('2700 N. California Ave', 60647);

INSERT INTO restaurants (location_id, owner, restaurant_name, phone, rating) 
	VALUES ((SELECT location_id FROM location WHERE street_address='2700 N. California Ave'),
			(SELECT user_id FROM users WHERE username = 'owner1'),
			'Pete\'s Pizza', '7735554444', 5);

INSERT INTO menu (restaurant_id) 
	VALUES ((SELECT restaurant_id FROM restaurants WHERE restaurant_name='Pete\'s Pizza'));

INSERT INTO meats (meat_name) 
	VALUES ('Chicken'),('Fish'),('Beef'),('Pork'),('Vegetarian');

INSERT INTO item (menu_id, item_name, item_description, meat_id, spicy, price)
	VALUES (1, 'Mongolian Beef', 'Some tasty asian beef', (select meat_id from meats where meat_name='Beef'), TRUE, 6.99);

INSERT INTO item (menu_id, item_name, item_description, meat_id, spicy, price)
	VALUES (1, 'Beef Strogenoff', 'Delicious Beef', (select meat_id from meats where meat_name='Beef'), TRUE, 7.99);

INSERT INTO item (menu_id, item_name, item_description, meat_id, spicy, price)
	VALUES (1, 'Beef Teriyaki', 'Tangy beef', (select meat_id from meats where meat_name='Beef'), FALSE, 8.99);