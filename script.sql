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
    vehicule_id INT,
    user_id INT,
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(vehicule_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- CREATE TABLE reservations (
--     reservation_id INT AUTO_INCREMENT PRIMARY KEY, 
--     reservation_name VARCHAR(255) NOT NULL,       
--     date1 DATE NOT NULL,                           
--     date2 DATE NOT NULL,                           
--     lieu VARCHAR(255) NOT NULL,                   
--     vehicule_id INT NOT NULL,                     
--     user_id INT NOT NULL,                        
--     FOREIGN KEY (vehicule_id) REFERENCES vehicules(vehicule_id), 
--     FOREIGN KEY (user_id) REFERENCES users(user_id)            
-- );
