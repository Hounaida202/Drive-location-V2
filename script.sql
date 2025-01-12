CREATE DATABASE driveLocation;

use driveLocation;

create table roles (
role_id INT AUTO_INCRIMENT PRIMARY KEY,
role_name VARCHAR(255) NOT NULL
);

insert into roles(role_id,role_name)
values ("admin"),("user");

create table users (
user_id INT AUTO_INCRIMENT PRIMARY KEY,
user_name VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
role_id INT,
FOREIGN KEY(role_id) REFERENCES roles(role_id)
);

CREATE TABLE categories (
    categorie_id INT AUTO_INCREMENT PRIMARY KEY,
    categorie_name VARCHAR(255) NOT NULL
);

 INSERT INTO categories (categorie_name)
 VALUES("luxe"),("travail");

 CREATE TABLE vehicules (
    vehicule_id INT AUTO_INCREMENT PRIMARY KEY,          
    vehicule_model VARCHAR(255) NOT NULL,                       
    disponibilite BOOLEAN NOT NULL,                     
    prix DECIMAL(10, 2) NOT NULL,                 
    categorie_id INT NOT NULL,                         
     FOREIGN KEY (categorie_id)  
    REFERENCES categories(categorie_id)                
    ON DELETE CASCADE                                  
    ON UPDATE CASCADE                                  
);

INSERT INTO vehicules (vehicule_model, disponibilite, prix, categorie_id)
VALUES 
    ('Toyota Yaris', TRUE, 40.00, 1,'https://th.bing.com/th/id/OIP._KtAMeXe0wCfnOnKkTcygAHaEE?rs=1&pid=ImgDetMain'), 
    ('Hyundai i20', FALSE, 35.50, 1,'https://th.bing.com/th/id/R.3bb7f5817404200431c9d00cc4f20f93?rik=gXQYoqCvknesZg&pid=ImgRaw&r=0'); 


INSERT INTO vehicules (vehicule_model, disponibilite, prix, categorie_id)
VALUES 
    ('Ford Transit', TRUE, 60.00, 2 ,'https://th.bing.com/th/id/R.cf4ddee20330e99b00b72a03116ebfb1?rik=h%2fBTPJrkqOoAcw&pid=ImgRaw&r=0'),  
    ('Mercedes Sprinter', FALSE, 75.00, 2,'https://mediacloud.carbuyer.co.uk/image/private/s--yt5BiHFM--/v1579629776/carbuyer/2018/02/1mercedessprinter_0.jpg'); 
 ALTER TABLE categories
ADD categorie_image_url VARCHAR(255) NOT NULL;

INSERT INTO categories (categorie_name, categorie_image_url)
VALUES 
    ('luxe', 'https://example.com/luxe.jpg'),
    ('travail', 'https://example.com/travail.jpg');

    CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    date1 DATE NOT NULL,
    date2 DATE NOT NULL,
    lieu VARCHAR(255) NOT NULL,
    status enum('en attente','accepter','refuser'),
    vehicule_id INT,
    user_id INT,
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(vehicule_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY, 
    reservation_name VARCHAR(255) NOT NULL,       
    date1 DATE NOT NULL,                           
    date2 DATE NOT NULL,                           
    lieu VARCHAR(255) NOT NULL,                   
    vehicule_id INT NOT NULL,                     
    user_id INT NOT NULL,                        
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(vehicule_id), 
    FOREIGN KEY (user_id) REFERENCES users(user_id)            
);

CREATE TABLE rating (
    rating_id INT AUTO_INCREMENT PRIMARY KEY, 
    rating_value INT,                  
    reservation_id INT NOT NULL,                     
    FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id)
);
CREATE TABLE themes (
    theme_id INT AUTO_INCREMENT PRIMARY KEY, 
    theme_name VARCHAR(255) NOT NULL,                
);
INSERT INTO themes (theme_name)
VALUES 
('L\'impact des véhicules électriques sur l\'industrie automobile'),
('L\'évolution des technologies de sécurité dans les voitures modernes'),
('Les véhicules autonomes : défis et perspectives d\'avenir');

CREATE TABLE articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY, 
    article_titre VARCHAR(255) NOT NULL,                   
    article_contenu TEXT NOT NULL,                   
    theme_id INT NOT NULL,  
    status enum('en attente','accepte','refuse') DEFAULT 'en attente'                   
    FOREIGN KEY (theme_id) REFERENCES themes(theme_id) 
);



INSERT INTO articles (article_titre, article_contenu, theme_id)
VALUES
('L\'avenir des batteries pour véhicules électriques', 
'Les batteries des véhicules électriques (VE) sont au cœur
 de l\'innovation dans l\'industrie automobile. 
 Les chercheurs travaillent sur des batteries plus puissantes,
  durables et rapides à recharger, avec un objectif de réduire les coûts et
   d\'augmenter l\'autonomie des véhicules. Les progrès dans la technologie
    des batteries, comme les batteries à semi-conducteurs, promettent de transformer 
    le marché des VE en rendant les voitures électriques plus accessibles et performantes.',
1),
('Les avantages environnementaux des voitures électriques', 
'Les voitures électriques représentent une solution
 écologique face aux problèmes de pollution et de réchauffement
  climatique. Contrairement aux véhicules à combustion, 
  les VE n\'émettent pas de gaz à effet de serre pendant leur utilisation. 
  De plus, avec l\'augmentation de la part des énergies renouvelables dans
   la production d\'électricité, l\'empreinte carbone des VE diminue encore.
    L\'adoption généralisée de ces véhicules pourrait avoir un impact majeur 
    sur la réduction des émissions mondiales.',
1),
('Les défis de l\'infrastructure de recharge pour véhicules électriques', 
'L\'un des principaux obstacles à l\'adoption
 massive des véhicules électriques est le manque 
 d\'infrastructure de recharge. Bien que le nombre
  de bornes de recharge augmente, il reste insuffisant 
  dans certaines régions, notamment en zone rurale. 
  De plus, la rapidité de la recharge reste un problème majeur
   pour les conducteurs, avec des temps d\'attente encore 
   trop longs comparés à un plein de carburant.
    Le développement de stations de recharge rapides et 
    une meilleure couverture géographique sont essentiels
     pour encourager l\'adoption des VE.',
1);

UPDATE articles
SET picture = 'https://www.guide-auto.com/wp-content/uploads/2023/04/Airbag-frontaux-1-1200x675.jpg'
WHERE article_id=4;
UPDATE articles
SET picture = 'https://th.bing.com/th/id/R.ae3c94e6b39706a65337c46809c149a8?rik=gAm73tnXfEGZ7w&pid=ImgRaw&r=0'
WHERE article_id=5;

UPDATE articles
SET picture = 'https://th.bing.com/th/id/OIP.aK1IuyrwJORG0dcNrqfKWQHaDz?rs=1&pid=ImgDetMain'
WHERE article_id=6;

UPDATE articles
SET picture = 'https://th.bing.com/th/id/OIP.k0su92tZwMqpkyqSh4AAIwHaDt?rs=1&pid=ImgDetMain'
WHERE article_id=7;

UPDATE articles
SET picture = 'https://th.bing.com/th/id/OIP.U7FKzO7r0zzyME1u2hYweQHaEK?rs=1&pid=ImgDetMain'
WHERE article_id=8;

CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,  
    tag_name VARCHAR (255) 
);

CREATE TABLE articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY, 
    article_titre VARCHAR(255) NOT NULL,                   
    article_contenu TEXT NOT NULL,                   
    theme_id INT NOT NULL,  
    status enum('en attente','accepte','refuse') DEFAULT 'en attente'                   
    FOREIGN KEY (theme_id) REFERENCES themes(theme_id) 
);
INSERT INTO tags (tag_name) VALUES
('4x4'),
('Batterie'),
('Camion'),
('Carrosserie'),
('Chaîne'),
('Climatisation'),
('Courroie'),
('Diesel'),
('Essence'),
('Freins'),
('Garage'),
('GPS'),
('Jantes'),
('Moto'),
('Pare-brise'),
('Pneus'),
('Remorque'),
('Scooter'),
('SUV'),
('Transmission');

CREATE TABLE article_tag(
article_tag_id INT PRIMARY KEY AUTO_INCREMENT,
tag_id INT,
article_id INT,
FOREIGN KEY tag_id REFERENCES tags(tag_id),
FOREIGN KEY article_id REFERENCES articles(article_id) DELETE ON CASCADE
);
