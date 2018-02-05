<?php
    error_reporting(E_ALL);
    require_once 'db_connect.php';
    if(!empty($_GET)) {
        $isbnSearch = $_GET['isbn'];
        $nameSearch = $_GET['name'];
        $authorSearch = $_GET['author'];
    }

    if(!empty($isbnSearch)){
        $select = "SELECT * FROM `books` WHERE `isbn` LIKE ?";

        $statement = $link->prepare($select);
        echo '<pre>';
        var_dump($statement);
        echo '</pre>';
        $statement->execute(["%$isbnSearch%"]);
    }
    elseif(!empty($nameSearch)){
        $select = "SELECT * FROM `books` WHERE `name` LIKE ?";
        $statement = $link->prepare($select);
        $statement->execute(["%$nameSearch%"]);
    }
    elseif(!empty($authorSearch)){
        $select = "SELECT * FROM `books` WHERE `author` LIKE ?";
        $statement = $link->prepare($select);
        $statement->execute(["%$authorSearch%"]);
    }
    else{
        $select = "SELECT * FROM `books`";
        $statement = $link->prepare($select);
        $statement->execute();
    }
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Библиотека успешного человека</title>
    <style>
        table {
            border-spacing: 0;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table td, table th {
            border: 1px solid #ccc;
            padding: 5px;
        }

        table th {
            background: #eee;
        }
    </style>
</head>
<body>
    <h1>Библиотека успешного человека</h1>

    <form method="GET" action="index.php">
        <input type="text" name="isbn" placeholder="ISBN" value="" />
        <input type="text" name="name" placeholder="Название книги" value="" />
        <input type="text" name="author" placeholder="Автор книги" value="" />
        <input type="submit" value="Поиск" />
    </form>

    <table>
        <tr>
            <th>Название</th>
            <th>Автор</th>
            <th>Год выпуска</th>
            <th>Жанр</th>
            <th>ISBN</th>
        </tr>
        <?php while($row = $statement->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['author']; ?></td>
                <td><?= $row['year']?></td>
                <td><?= $row['genre']?></td>
                <td><?= $row['isbn']?></td>
            </tr>
        <?php endwhile ?>
</table>
</body>
</html>