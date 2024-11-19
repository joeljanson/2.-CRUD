/*
Kör följande kommandon i terminalen för att skapa en databas och en tabell i MySQL.

Börja med att öppna SQL-klienten i din MySQL container:
docker exec -it mysql-container mysql -u root -p < byt ut mysql-container mot namnet på din MySQL container (hittas med docker ps efter att du kört docker compose up -d)

*/

CREATE DATABASE IF NOT EXISTS crud_app;

USE crud_app;

CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
