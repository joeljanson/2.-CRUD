<?php
include 'db.php'; // Importerar databaskopplingen.

// Kontrollera om en artikel-id skickades med.
if (isset($_GET['id'])) {
	// Förbereder en SQL-fråga för att ta bort artikeln.
	$stmt = $pdo->prepare('DELETE FROM articles WHERE id = :id');
	$stmt->execute([':id' => $_GET['id']]);

	// Omdirigera tillbaka till startsidan efter borttagningen.
	header('Location: index.php');
	exit; // Avsluta scriptet.
}
