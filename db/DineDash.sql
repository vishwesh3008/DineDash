create database dindash_final;
use dindash_final;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `food` (
  `id` INT(5) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` DECIMAL(6, 2) NOT NULL DEFAULT 0.00,
  `res_id` INT(5) NOT NULL DEFAULT 1,
  `pref` TINYINT(1) NOT NULL DEFAULT 0,
  `image` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuisine` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ;

INSERT INTO `food` (`id`, `name`, `price`, `res_id`, `pref`, `image`, `description`, `cuisine`) VALUES
(1, 'Pizza', 10, 1, 1, 'images/Pizza.jpg', 'A classic pizza with a crisp crust, topped with fresh tomato sauce, Chicken and mozzarella.', 'Italian'),
(2, 'Packaged Juice', 8, 2, 0, 'images/PackageJuice.jpg', 'A refreshing blend of orange, pineapple, and apple juices. Packed with vitamins.', 'Beverage'),
(3, 'Veggie Wrap', 9, 4, 0, 'images/VeggieWrap.jpg', 'Wheat wrap with fresh veggies and cream cheese', 'Fast Food'),
(4, 'Spinach Beef Wrap', 16, 5, 1, 'images/SpinachBeefWrap.jpg', 'Beef served in fresh Spinach leaves', 'Fast Food'),
(5, 'Corn Mega Wrap', 11, 6, 0, 'images/CornMegaWrap.jpg', 'Wheat wrap with corn kernels along with fresh vegetables and lemon juice', 'Fast Food'),
(6, 'Rich Chocolate Cake', 29, 8, 1, 'images/RichChocolateCake.jpg', 'Double dark chocolate cake', 'Dessert'),
(7, 'Double Patty Burger', 23, 9, 1, 'images/DoublePattyBurger.jpg', 'Double beefy patty with cheese and lettuce', 'Fast Food'),
(8, 'Tofu Wrap', 16, 10, 0, 'images/Tofu Wrap.jpg', 'High protein vegan wrap with tofu and vegetables', 'Fast Food'),
(9, 'Grilled Cheese and Tomato Soup', 28, 11, 1, 'images/Grilled Cheese and Tomato Soup.jpg', 'Grilled Cheese sandwich with side of fresh tomato soup', 'Fast Food'),
(10, 'Tomato Cheese Wrap', 16, 12, 0, 'images/Tomato Cheese Wrap.jpg', 'Wheat wrap with sliced tomato parsley and cheese', 'Fast Food'),
(11, 'Hot Chocolate Cake', 32, 13, 1, 'images/Hot Chocolate Cake.jpg', 'Hot chocolate lava cake', 'Dessert'),
(12, 'Bacon Sandwich', 17, 14, 1, 'images/Bacon Sandwich.jpg', 'Toasted Bacon Sandwich', 'Fast Food'),
(13, 'Fresh Vegetable Juices', 13, 15, 0, 'images/Fresh Vegetable Juices.jpg', 'Freshly squeezed vegetable juice', 'Beverage'),
(14, 'Gold Pizza', 48, 16, 0, 'images/Gold Pizza.jpg', 'Margerita Pizza with a thin layer of edible gold', 'Italian'),
(15, 'Carrot Cake', 32, 17, 0, 'images/Carrot Cake.jpg', 'Carrot cake baked with honey and wheat, topped with icing', 'Dessert'),
(16, 'Blueberry Juice', 13, 18, 0, 'images/Blueberry Juice.jpg', 'Organic Blueberry juice freshly squeezed', 'Beverage'),
(17, 'Black Bean Burger', 15, 19, 0, 'images/Black Bean Burger.jpg', 'Black bean patty with bun', 'Fast Food'),
(18, 'Loaded Cheese Burger', 18, 20, 0, 'images/Loaded Cheese Burger.jpg', 'Burger with patty and three cheeses', 'Fast Food'),
(19, 'Strawberry Cake', 28, 17, 0, 'images/Strawberry Cake.jpg', 'Moist Strawberry cake with icing', 'Dessert'),
(20, 'Basil Feta Cheese Pizza', 18, 8, 0, 'images/Basil Feta Cheese Pizza.jpg', 'Pan Baked pizza with basic and gouda cheese', 'Italian'),
(21, 'Lemon Cake', 36, 3, 0, 'images/Lemon Cake.jpg', 'Moist Lemon Cake with honey', 'Dessert'),
(22, 'Mango Shake', 11, 4, 0, 'images/Mango Shake.jpg', 'Mango and Milk Shake', 'Beverage'),
(23, 'Cold Wrap', 17, 2, 0, 'images/Cold Wrap.jpg', 'Cold wraps with veggies', 'Fast Food'),
(24, 'Kale Juice', 19, 6, 0, 'images/Kale Juice.jpg', 'Fresh Kale Juice with celery and ginger', 'Beverage'),
(25, 'Pepperoni Cheese Pizza', 22, 7, 1, 'images/Pepperoni Cheese Pizza.jpg', 'Fresh pan pizza with cheese and pepperoni', 'Italian'),
(26, 'Chicken Wrap', 17, 12, 1, 'images/Chicken Wrap.jpg', 'Grilled lemon chicken wheat wrap', 'Fast Food'),
(27, 'Mini Burger', 15, 13, 0, 'images/Mini Burger.jpg', 'Mini cheese burgers', 'Fast Food'),
(28, 'Pineapple Cake', 26, 3, 0, 'images/Pineapple Cake.jpg', 'Eggless Pineapple cake with fresh pineapple chunks', 'Dessert');


CREATE TABLE Restaurants (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    restaurant_name TEXT NOT NULL,
    restaurant_type TEXT NOT NULL,
    rate REAL NOT NULL,
    location TEXT NOT NULL,
    email_id TEXT NOT NULL,
    password TEXT NOT NULL
);


INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (1, 'Bengaluru Baking Company - JW Marriott Bengaluru', 'Bakery, Cafe', 4.3, 'Brigade Road, Lavelle Road', 'contact@bengalurubakingco.com', 'password123');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (2, 'Chin Lung Resto Bar', 'Bar', 3.9, 'Brigade Road, Residency Road', 'info@chinlungrestobar.com', 'barlife789');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (3, 'Grand Taj Durbar', 'Quick Bites', 3.5, 'Electronic City, Electronic City', 'hello@grandtajdurbar.com', 'taj12345');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (4, 'Frootality', 'Beverage Shop, Quick Bites', 4.0, 'Indiranagar, Indiranagar', 'support@frootality.com', 'fruitlover456');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (5, 'Choco Allure', 'Takeaway, Delivery', 3.4, 'Indiranagar, Indiranagar', 'info@chocoallure.com', 'choco567');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (6, 'Flechazo', 'Casual Dining', 4.7, 'Marathahalli, Marathahalli', 'contact@flechazo.com', 'dinefine789');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (7, 'Peppermill Bistro', 'Casual Dining, Cafe', 4.0, 'Malleshwaram, New BEL Road', 'hello@peppermillbistro.com', 'bistro2021');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (8, 'Ur Cutlet Factory', 'Takeaway, Delivery', 3.1, 'HSR, HSR', 'support@cutletfactory.com', 'cutlet123');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (9, 'Cakes and Moulds', 'Bakery', 3.6, 'Koramangala 4th Block, Koramangala 1st Block', 'info@cakesandmoulds.com', 'cake5678');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (10, 'Marahaba', 'Quick Bites', 3.0, 'Byresandra,Tavarekere,Madiwala, Koramangala 6th Block', 'hello@marahaba.com', 'quickbites');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (11, 'Roast ''N'' Frost', 'Quick Bites', 3.7, 'Malleshwaram, Rajajinagar', 'info@roastnfrost.com', 'frost2022');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (12, 'Waffle Walle', 'Kiosk', 4.3, 'Marathahalli, Whitefield', 'contact@wafflewalle.com', 'waffle789');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (13, 'Pizza Connect', 'Takeaway, Delivery', 3.8, 'Kammanahalli, Kammanahalli', 'info@pizzaconnect.com', 'pizza456');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (14, 'Momo Street', 'Quick Bites', 4.0, 'HSR, HSR', 'support@momostreet.com', 'momo1234');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (15, 'Barbeque Nation', 'Casual Dining', 4.6, 'Koramangala 5th Block, Koramangala', 'contact@bbqnation.com', 'bbq7890');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (16, 'Paradise', 'Casual Dining', 4.1, 'Indiranagar, Indiranagar', 'info@paradiserestaurant.com', 'paradise123');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (17, 'Chung Wah', 'Casual Dining', 4.2, 'MG Road, MG Road', 'hello@chungwah.com', 'asianfood2020');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (18, 'Cafe Coffee Day', 'Cafe', 3.9, 'Whitefield, Whitefield', 'support@ccd.com', 'coffee456');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (19, 'Baskin Robbins', 'Ice Cream, Dessert', 4.5, 'Koramangala, Koramangala 6th Block', 'info@baskinrobbins.com', 'dessert567');

INSERT INTO Restaurants (id, restaurant_name, restaurant_type, rate, location, email_id, password)
VALUES (20, 'Truffles', 'Cafe', 4.7, 'Indiranagar, Indiranagar', 'contact@truffles.com', 'truffles789');

CREATE TABLE orders (
    id INTEGER AUTO_INCREMENT PRIMARY KEY, 
    food_id INTEGER NOT NULL,           
    quantity INTEGER NOT NULL,            
    user_id INTEGER NOT NULL,             
    time DATETIME NOT NULL,               
    restaurant_id INTEGER NOT NULL,      
    FOREIGN KEY (food_id) REFERENCES food(id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(id)
);
INSERT INTO orders (id, food_id, quantity, user_id, time, restaurant_id) VALUES
(2, 10, 1, 1, '2023-03-25 20:57:51', 9),
(3, 4, 1, 1, '2023-03-25 20:57:51', 13),
(4, 7, 3, 2, '2023-03-25 20:59:01', 12),
(5, 11, 2, 2, '2023-03-25 20:59:01', 20),
(6, 4, 1, 2, '2023-03-25 20:59:01', 14),
(8, 6, 3, 3, '2023-03-25 21:00:12', 17),
(10, 9, 1, 3, '2023-03-25 21:00:12', 9),
(11, 1, 2, 4, '2023-03-25 21:01:19', 19),
(12, 9, 3, 4, '2023-03-25 21:01:19', 18),
(13, 8, 1, 4, '2023-03-25 21:01:20', 16),
(14, 7, 2, 4, '2023-03-25 21:01:20', 7),
(15, 6, 2, 4, '2023-03-25 21:01:20', 10),
(17, 4, 1, 4, '2023-03-25 21:01:20', 4),
(19, 10, 1, 4, '2023-03-25 21:01:20', 18),
(20, 11, 2, 4, '2023-03-25 21:01:20', 6),
(21, 9, 3, 1, '2023-03-25 21:09:43', 18),
(22, 4, 10, 3, '2023-03-25 22:00:54', 14),
(23, 10, 1, 3, '2023-03-25 22:00:54', 9),
(24, 1, 2, 3, '2023-03-25 22:02:00', 19),
(25, 6, 2, 3, '2023-03-25 22:31:00', 17),
(26, 6, 2, 1, '2023-03-27 01:15:04', 14),
(27, 14, 6, 1, '2023-03-27 01:15:04', 1),
(28, 1, 5, 1, '2023-07-27 14:35:00', 20),
(29, 8, 7, 2, '2023-12-11 15:45:00', 11),
(30, 11, 3, 3, '2023-05-16 12:10:00', 8);

CREATE TABLE Users (
    user_id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    age INTEGER,
    gender TEXT,
    marital_status TEXT,
    family_size INTEGER,
    phone_number TEXT NOT NULL 
);


INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (1, 'Sierra Chase', 'williamclark@hotmail.com', 'w7tTtjoA$', 18, 'Male', 'Single', 3, '123-456-7890');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (2, 'Lee Williams', 'lbutler@hotmail.com', 'MzwKfA7+', 43, 'Male', 'Divorced', 2, '987-654-3210');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (3, 'Gary Leon', 'jason83@austin.com', '7RrRlb5t#', 19, 'Female', 'Divorced', 3, '456-789-0123');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (4, 'James Davis', 'zbenjamin@gmail.com', '6H0OXfxu)', 30, 'Female', 'Divorced', 9, '321-654-9870');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (5, 'Raymond Cisneros', 'martinwalton@gmail.com', 'UZ0EEYsC*', 45, 'Male', 'Married', 3, '789-012-3456');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (6, 'Andrea Parsons', 'james14@ryan-shelton.com', '93r4Itbv!', 32, 'Other', 'Single', 6, '654-321-0987');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (7, 'Elijah Rogers', 'mwebb@king.com', 'ltLGVtdK1)', 38, 'Other', 'Married', 8, '567-890-1234');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (8, 'Jordan Young', 'victoria47@griffin.com', 'IsF15K9z@', 55, 'Female', 'Single', 2, '890-123-4567');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (9, 'Evelyn Garcia', 'ryankathryn@yahoo.com', 'FqIEGaN9%', 26, 'Male', 'Single', 4, '012-345-6789');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (10, 'Maria Fields', 'charlespatricia@hotmail.com', 'RxLT1Ejb1#', 31, 'Female', 'Divorced', 7, '234-567-8901');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (11, 'Ronald Powell', 'johnsonanna@hotmail.com', 'TrnMG91sy@', 40, 'Female', 'Single', 5, '345-678-9012');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (12, 'Christopher Castillo', 'troycox@yahoo.com', 'DyYDldfBx*', 36, 'Male', 'Married', 3, '456-789-0123');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (13, 'Victoria Garcia', 'qpowell@hotmail.com', 'PnV8D4U@', 20, 'Female', 'Divorced', 4, '567-890-1234');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (14, 'Amber White', 'ashleylong@gmail.com', 'Jo9EqO69*', 23, 'Male', 'Single', 7, '678-901-2345');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (15, 'Tiffany Miles', 'gomezdaniel@gmail.com', 'iVtBqaT#', 22, 'Other', 'Single', 2, '789-012-3456');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (16, 'Gary Jordan', 'morrisonemily@gmail.com', 'ODXkVP*$', 39, 'Male', 'Married', 5, '890-123-4567');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (17, 'Ryan Schultz', 'kevin58@yahoo.com', 'KnSxqAY$', 24, 'Female', 'Divorced', 4, '901-234-5678');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (18, 'Kimberly White', 'wthompson@gmail.com', 'LHv9dHBo@', 56, 'Female', 'Single', 3, '123-456-7890');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (19, 'Michelle Moore', 'patricia02@gmail.com', 'P3ZzptX+', 33, 'Male', 'Married', 1, '987-654-3210');

INSERT INTO Users (user_id, name, email, password, age, gender, marital_status, family_size, phone_number)
VALUES (20, 'Amanda Campbell', 'katemartin@roberts.com', 'YxeLU#Ml+', 29, 'Other', 'Married', 2, '234-567-8901');



CREATE TABLE `cart` (
  `id` int(5) NOT NULL,
  `food_id` int(55) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(5) NOT NULL
); 