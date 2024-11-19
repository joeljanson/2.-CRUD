<?php
include 'db.php'; // Importerar databaskopplingen.

// Kontrollera om en artikel-id skickades med i URL:en.
if (isset($_GET['id'])) {
	// Förbereder en SQL-fråga för att hämta artikelns data.
	$stmt = $pdo->prepare('SELECT * FROM articles WHERE id = :id');
	$stmt->execute([':id' => $_GET['id']]);
	$article = $stmt->fetch(PDO::FETCH_ASSOC);

	// Om artikeln inte finns, visa ett felmeddelande.
	if (!$article) {
		die('Artikel hittades inte.');
	}
}

/*
Detta är också ett prepared statement av samma anledning.
$id = $_GET['id'];
$query = "SELECT * FROM articles WHERE id = $id";
$stmt = $pdo->query($query);
$article = $stmt->fetch(PDO::FETCH_ASSOC);
Detta är utan och om någon skickar in update.php?id=1; DROP TABLE articles; -- kommer det att radera din tabell.
*/

// Hantera POST-förfrågan för att uppdatera artikelns data.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Förbereder en SQL-fråga för att uppdatera artikeln.
	$stmt = $pdo->prepare('UPDATE articles SET title = :title, content = :content WHERE id = :id');
	$stmt->execute([
		':id' => $_POST['id'],
		':title' => $_POST['title'],
		':content' => $_POST['content'],
	]);

	// Omdirigera tillbaka till startsidan efter uppdateringen.
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Grundläggande metadata -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Redigera artikel</title>
</head>

<body>
	<h1>Redigera artikel</h1>
	<!-- Formulär för att redigera artikel -->
	<form method="POST" action="">
		<!-- Gömmer artikelns ID i formuläret -->
		<input type="hidden" name="id" value="<?= $article['id'] ?>">
		<!-- Titel och innehåll med förifyllt värde -->
		<input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
		<textarea name="content" required><?= htmlspecialchars($article['content']) ?></textarea>
		<button type="submit">Spara ändringar</button>
	</form>
</body>

</html>