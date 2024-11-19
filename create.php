<?php
include 'db.php'; // Importerar databaskopplingen.

// Kontrollera om formuläret skickades.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Förbereder en SQL-fråga för att lägga till en ny artikel.
	$stmt = $pdo->prepare('INSERT INTO articles (title, content) VALUES (:title, :content)');
	$stmt->execute([
		':title' => $_POST['title'],
		':content' => $_POST['content'],
	]);

	// Omdirigera tillbaka till startsidan efter att artikeln skapats.
	header('Location: index.php');
	exit;
}

/*
Exempel på ett unprepared statement:
$title = $_POST['title'];
$content = $_POST['content'];
$query = "INSERT INTO articles (title, content) VALUES ('$title', '$content')";
$pdo->query($query);

Om någon skickar in '); DROP TABLE articles; -- som titel, kan det radera din databas.
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Grundläggande metadata -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Skapa artikel</title>
</head>

<body>
	<h1>Skapa ny artikel</h1>
	<!-- Formulär för att skapa en ny artikel -->
	<form method="POST" action="">
		<input type="text" name="title" placeholder="Titel" required>
		<textarea name="content" placeholder="Innehåll" required></textarea>
		<button type="submit">Spara</button>
	</form>
</body>

</html>