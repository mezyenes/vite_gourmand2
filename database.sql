-- =========================
-- USERS
-- =========================
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  nom VARCHAR(100),
  prenom VARCHAR(100),
  email VARCHAR(150) UNIQUE,
  password VARCHAR(255),
  adresse TEXT,
  gsm VARCHAR(20),
  role VARCHAR(50) DEFAULT 'user',
  active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- MENUS
-- =========================
CREATE TABLE menus (
  id SERIAL PRIMARY KEY,
  name VARCHAR(150),
  description TEXT,
  price NUMERIC(10,2),
  themes VARCHAR(255),
  allergie VARCHAR(255),
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO menus (id, name, description, price, themes, allergie, image, created_at) VALUES
(1, 'Pitta', 'Délicieux pitta avec viande et crudités', 7.50, 'classique', 'gluten', 'pitta.jpg', NOW()),
(2, 'Burger', 'Burger maison avec steak, fromage et sauce', 9.90, 'fast-food', 'gluten,lactose', 'burger.jpg', NOW()),
(3, 'Pizza', 'Pizza mozzarella tomate et basilic', 11.50, 'italien', 'gluten,lactose', 'pizza.jpg', NOW()),
(4, 'Sportifs', 'Menu riche en protéines pour sportifs', 12.90, 'healthy', 'aucun', 'sportif.jpg', NOW()),
(5, 'Étudiants', 'Menu pas cher pour étudiants', 6.50, 'budget', 'gluten', 'etudiants.jpg', NOW()),
(7, 'Mezze', 'Assortiment de spécialités orientales', 10.90, 'oriental', 'gluten,sesame', 'mezze.jpg', NOW());

-- =========================
-- ORDERS
-- =========================
CREATE TABLE orders (
  id SERIAL PRIMARY KEY,
  user_id INT REFERENCES users(id) ON DELETE CASCADE,
  menu_id INT REFERENCES menus(id) ON DELETE CASCADE,
  adresse TEXT,
  livraison_time TIMESTAMP,
  delivery_price NUMERIC(10,2),
  status VARCHAR(50) DEFAULT 'en cours',
  cancel_reason TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- REVIEWS
-- =========================
CREATE TABLE reviews (
  id SERIAL PRIMARY KEY,
  order_id INT REFERENCES orders(id) ON DELETE CASCADE,
  user_id INT REFERENCES users(id) ON DELETE CASCADE,
  rating INT,
  comment TEXT,
  status VARCHAR(50) DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- SETTINGS
-- =========================
CREATE TABLE settings (
  id SERIAL PRIMARY KEY,
  opening_time TIME DEFAULT '08:00',
  closing_time TIME DEFAULT '22:00'
);

INSERT INTO settings (opening_time, closing_time)
VALUES ('08:00', '22:00');