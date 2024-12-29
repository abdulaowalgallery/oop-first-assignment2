<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
</head>
<body>
    <h1>Library System</h1>

    <h2>Available Books</h2>
    <?php
    include 'library_system.php';
    displayAvailableBooks();
    ?>

    <h2>Borrow / Return Books</h2>
    <form action="index.php" method="post">
        <label for="member">Member Name:</label>
        <select name="memberName" id="member">
            <option value="Alice">Alice</option>
            <option value="Bob">Bob</option>
        </select><br><br>

        <label for="book">Book Title:</label>
        <select name="bookTitle" id="book">
            <option value="PHP for Beginners">PHP for Beginners</option>
            <option value="Advanced PHP Programming">Advanced PHP Programming</option>
        </select><br><br>

        <label for="action">Action:</label>
        <select name="action" id="action">
            <option value="borrow">Borrow</option>
            <option value="return">Return</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>

    <h2>Result</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $memberName = $_POST['memberName'];
        $bookTitle = $_POST['bookTitle'];
        $action = $_POST['action'];
        
        if ($action == 'borrow') {
            echo borrowBook($memberName, $bookTitle);
        } elseif ($action == 'return') {
            echo returnBook($memberName, $bookTitle);
        }
    }
    ?>
</body>
</html>
