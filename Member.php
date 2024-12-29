<?php
class Member {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function borrowBook(Book $book) {
        if ($book->borrowBook()) {
            echo $this->name . " has borrowed the book: " . $book->getTitle() . "<br>";
        } else {
            echo "Sorry, no available copies of " . $book->getTitle() . " left!<br>";
        }
    }

    public function returnBook(Book $book) {
        $book->returnBook();
        echo $this->name . " has returned the book: " . $book->getTitle() . "<br>";
    }
}
?>
