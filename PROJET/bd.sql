INSERT INTO im2021_users (pk, nom, prenom, anniversaire, identifiant, motdepasse, isadmin) VALUES (1, 'admin', 'admin', null, 'admin', 'a4cbb2f3933c5016da7e83fd135ab8a48b67bf61', 1);
INSERT INTO im2021_users (pk, nom, prenom, anniversaire, identifiant, motdepasse, isadmin) VALUES (2, 'Subrenat', 'Gilles', '2000-01-01', 'gilles', 'ab9240da95937a0d51b41773eafc8ccb8e7d58b5', 0);
INSERT INTO im2021_users (pk, nom, prenom, anniversaire, identifiant, motdepasse, isadmin) VALUES (3, 'Zrour', 'Rita', '2001-01-02', 'rita', '1811ed39aa69fa4da3c457bdf096c1f10cf81a9b', 0);

INSERT INTO im2021_products (id, name, description, price, stock) VALUES (1, 'Pizza Chèvre-Miel', 'Magnifique pizza base crème au chèvre et miel.', 7.5, 2);
INSERT INTO im2021_products (id, name, description, price, stock) VALUES (2, 'Noir gazeux', 'Coca bien frais chakal !', 2.5, 2);
INSERT INTO im2021_products (id, name, description, price, stock) VALUES (3, 'Magik Kishta', 'Liasse de 2 billets de 5 euros.', 50.25, 2);
INSERT INTO im2021_products (id, name, description, price, stock) VALUES (5, 'Un truc null', 'N''achetez surtout pas ça !', 100000, 0);
INSERT INTO im2021_products (id, name, description, price, stock) VALUES (7, 'Essai', null, 10, 1);

INSERT INTO im2021_carts (id, id_user_id, id_product_id, quantity) VALUES (16, 2, 7, 1);
INSERT INTO im2021_carts (id, id_user_id, id_product_id, quantity) VALUES (20, 3, 1, 3);
INSERT INTO im2021_carts (id, id_user_id, id_product_id, quantity) VALUES (21, 3, 2, 3);
INSERT INTO im2021_carts (id, id_user_id, id_product_id, quantity) VALUES (22, 3, 3, 3);