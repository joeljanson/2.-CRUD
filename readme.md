# Kör följande kommandon i terminalen för att skapa en databas och en tabell i MySQL.

## Börja med att öppna SQL-klienten i din MySQL container genom att köra följande kommando i terminalen.

Hitta namnet på din mysql-container genom att köra

```bash
docker compose up -d
docker ps
```

Byt ut mysql-container nedan mot namnet på din MySQL container och kör följande

```bash
docker exec -it mysql-container mysql -u root -p
```

Du kommer då in i SQL-klienten och kan köra följande kommandon i terminalen.

## Skapa databas och tabell

Dessa kommandon skapar en ny databas, navigerar till den och skapar sen tabellen articles som behövs i exemplet

```sql
CREATE DATABASE IF NOT EXISTS crud_app;

USE crud_app;

CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
