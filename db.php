<?php
// Definierar anslutningsparametrar för databasen.
$host = 'db'; // Namnet på databastjänsten definierad i docker-compose.yml.
$dbname = 'crud_app'; // Namnet på databasen.
$username = 'user'; // Användarnamn för att ansluta till databasen.
$password = 'password'; // Lösenord för databasen.

try {
	// Skapar en ny PDO-instans för att ansluta till databasen.
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	// Sätter PDO att kasta undantag vid fel (för felsökning).
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	// Fångar eventuella fel och avslutar programmet med ett felmeddelande.
	die("Database connection failed: " . $e->getMessage());
}
