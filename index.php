<?php include 'db.php'; // Importerar databaskopplingen. 
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Grundläggande metadata för sidan -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css"> <!-- Länkar till CSS-fil -->
	<title>CRUD App</title> <!-- Sidtitel -->
</head>

<body>
	<h1>Artiklar</h1>
	<!-- Länk för att skapa en ny artikel -->
	<a href="create.php" class="btn">Lägg till ny artikel</a>
	<table>
		<thead>
			<tr>
				<!-- Definierar kolumnerna i tabellen -->
				<th>ID</th>
				<th>Titel</th>
				<th>Innehåll</th>
				<th>Skapad</th>
				<th>Åtgärder</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Hämtar alla artiklar från databasen.
			// Här används metoden query() på $pdo-objektet för att köra en enkel SQL-fråga.
			// Notera att detta **inte** är ett prepared statement eftersom det inte innehåller några parametrar att binda.
			// Prepared statements används oftast när man vill skydda mot SQL-injektion, vilket inte är aktuellt här eftersom det inte finns några dynamiska värden från användaren i frågan.
			$stmt = $pdo->query('SELECT * FROM articles');

			// Loopa igenom varje artikel och generera en tabellrad.
			// Metoden fetch() hämtar en rad i taget från resultatet av SQL-frågan.
			// Här används PDO::FETCH_ASSOC för att få resultatet som en associativ array, där kolumnnamn är nycklar.
			while ($article = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
				<tr>
					<!-- Här används htmlspecialchars() för att säkerställa att innehållet som skrivs ut på sidan är säkert.
		Det förhindrar attacker som Cross-Site Scripting (XSS) genom att konvertera specialtecken till HTML-entiteter. Vi 
		använder oss av htmlspecialchars om någon mot förmodan skulle lyckats få in något i vår databas och kör typ <script>skadlig jskod</script> -->
					<td><?= htmlspecialchars($article['id']) ?></td>
					<td><?= htmlspecialchars($article['title']) ?></td>
					<td><?= htmlspecialchars($article['content']) ?></td>
					<td><?= htmlspecialchars($article['created_at']) ?></td>
					<td>
						<!-- Här genereras länkar för att redigera eller ta bort artikeln.
			Observera att artikelns ID skickas med som en parameter i URL:en, t.ex., "update.php?id=1". -->
						<a href="update.php?id=<?= $article['id'] ?>" class="btn">Redigera</a>
						<a href="delete.php?id=<?= $article['id'] ?>" class="btn btn-danger">Ta bort</a>
					</td>
				</tr>
			<?php endwhile; ?>

		</tbody>
	</table>
</body>

</html>