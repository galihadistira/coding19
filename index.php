<?php

$conn = new mysqli('localhost', 'root', '', 'tugas19');


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


$categoriesQuery = "SELECT * FROM categories";
$categoriesResult = $conn->query($categoriesQuery);

if (!$categoriesResult) {
    die("Query Error: " . $conn->error);  


$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$articlesQuery = "SELECT * FROM artikel WHERE title LIKE '%$searchKeyword%'"; 
$articlesResult = $conn->query($articlesQuery);

if (!$articlesResult) {
    die("Query Error: " . $conn->error);  
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>List of Articles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

    <nav class="navbar">
            <ul>
                <?php while($category = $categoriesResult->fetch_assoc()): ?>
                    <li><a href="index.php?category_id=<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
                <?php endwhile; ?>
            </ul>
        </nav>

        
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Cari artikel..." value="<?= htmlspecialchars($searchKeyword) ?>" class="search-input">
            <button type="submit" class="search-button">Cari</button>
        </form>
    

        
        <div class="artikel-list">
            <?php while($artikel = $articlesResult->fetch_assoc()): ?>
                <div class="artikel-item">
                    <h2><a href="artikel.php?id=<?= $artikel['id'] ?>"><?= $artikel['title'] ?></a></h2>
                    <p><?= substr($artikel['content'], 0, 100) ?>...</p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
