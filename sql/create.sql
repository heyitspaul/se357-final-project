USE s0777136;
CREATE TABLE shopping_users
(
  user_id int NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  salt varchar(255) NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  email_confirmed tinyint(1),
  vendor tinyint(1),
  vendor_applied tinyint(1),
  admin tinyint(1),
  address varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  state varchar(255) NOT NULL,
  zipcode varchar(255) NOT NULL,
  confirm_token varchar(255),
  confirm_expiration int,
  password_reset_token varchar(255),
  password_reset_expiration int,
  attempts int,
  locktime int,
  PRIMARY KEY (user_id)
);

CREATE TABLE categories(
  category_id int NOT NULL AUTO_INCREMENT,
  category_name varchar(255) NOT NULL,
  PRIMARY KEY (category_id)
);

CREATE TABLE products(
  product_id int NOT NULL AUTO_INCREMENT,
  product_name varchar(255) NOT NULL,
  product_description text NOT NULL,
  product_price decimal(10,2) NOT NULL,
  product_stock int NOT NULL,
  vendor_id int NOT NULL,
  category_id int NOT NULL,
  product_picture text,
  product_approved tinyint(1),
  PRIMARY KEY (product_id),
  FOREIGN KEY (vendor_id) REFERENCES shopping_users(user_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE orders(
  order_id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  date Date NOT NULL,
  PRIMARY KEY (order_id),
  FOREIGN KEY (user_id) REFERENCES shopping_users(user_id)
);

CREATE TABLE suborders(
  suborder_id int NOT NULL AUTO_INCREMENT,
  order_id int NOT NULL,
  product_id int NOT NULL,
  quantity int NOT NULL,
  unitprice decimal(10,2) NOT NULL,
  fulfilled tinyint(1),
  PRIMARY KEY (suborder_id),
  FOREIGN KEY (order_id) REFERENCES orders(order_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE UNIQUE INDEX username ON shopping_users (username);