USE s0777136;
INSERT INTO categories (category_name) VALUES ("Art");
INSERT INTO categories (category_name) VALUES ("Electronics");
INSERT INTO categories (category_name) VALUES ("Books");
INSERT INTO categories (category_name) VALUES ("Toys");
INSERT INTO categories (category_name) VALUES ("Clothing");
INSERT INTO categories (category_name) VALUES ("Jewellery");

INSERT INTO shopping_users (username, password, salt, first_name, last_name, email, email_confirmed, vendor, admin, address, city, state, zipcode) VALUES ("leonardo420", "de33bc870b7ee7600af7e3faa72b28bf3e8fecc6f9d6482a8b58d9c7bf45f0c8", "3zO8VkGIpFWtVAOOFZqXmkU0dwdxxeX8Xb4pdSyeHQk=", "Leonardo", "da Vinci", "leonardo69@gmail.com", 1, 1, 0, "1 Leonardo Way", "Venice Beach", "CA", "90210");
INSERT INTO shopping_users (username, password, salt, first_name, last_name, email, email_confirmed, address, city, state, zipcode) VALUES ("TheAssailant6661", "de33bc870b7ee7600af7e3faa72b28bf3e8fecc6f9d6482a8b58d9c7bf45f0c8", "3zO8VkGIpFWtVAOOFZqXmkU0dwdxxeX8Xb4pdSyeHQk=", "Paulo", "Borges", "theassailant6661@gmail.com", 1, "123 Memers Way", "Long Branch", "NJ", "07740");
INSERT INTO shopping_users (username, password, salt, first_name, last_name, email, email_confirmed, vendor, admin, address, city, state, zipcode) VALUES ("androidguy123", "de33bc870b7ee7600af7e3faa72b28bf3e8fecc6f9d6482a8b58d9c7bf45f0c8", "3zO8VkGIpFWtVAOOFZqXmkU0dwdxxeX8Xb4pdSyeHQk=", "Anders", "Anderson", 1, 0, "androidguy123@gmail.com", 1, "456 Radical Way", "Long Beach", "CA", "90210");

INSERT INTO products (product_name, product_description, product_price, product_stock, vendor_id, category_id, product_picture) VALUES ("Mona Lisa", "The world reknown masterpiece from Leonardo da Vinci.", 39999.99, 1, 1, 1, "http://3.bp.blogspot.com/_fQQ1RUaMzrs/TUiCmVNKPVI/AAAAAAAADks/v1nOGNebYH8/s1600/Mona+Lisa.jpg");
INSERT INTO products (product_name, product_description, product_price, product_stock, vendor_id, category_id, product_picture) VALUES ("Mona Lisa Prints", "Woodcut prints based on the Mona Lisa", 39.95, 100, 1, 1, "http://3.bp.blogspot.com/_fQQ1RUaMzrs/TUiCmVNKPVI/AAAAAAAADks/v1nOGNebYH8/s1600/Mona+Lisa.jpg");
INSERT INTO products (product_name, product_description, product_price, product_stock, vendor_id, category_id, product_picture) VALUES ("Moto 360 Smartwatch", "Everything you could want in a watch is built into the Motorola Moto 360 Smart Watch.", 219.99, 7, 3, 2, "http://scene7.targetimg1.com/is/image/Target/16874134?scl=1");


INSERT INTO orders (user_id, date) VALUES (2, "2015-05-02");
INSERT INTO suborders (order_id, product_id, quantity, unitprice) VALUES (1, 1, 1, 39999.99);
INSERT INTO suborders (order_id, product_id, quantity, unitprice) VALUES (1, 2, 42, 39.95);