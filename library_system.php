<?php
// Load library data from JSON file
function loadLibraryData() {
    $jsonData = file_get_contents('library_data.json');
    return json_decode($jsonData, true);
}

// Save library data to JSON file
function saveLibraryData($data) {
    file_put_contents('library_data.json', json_encode($data, JSON_PRETTY_PRINT));
}

// Borrow book function
function borrowBook($memberName, $bookTitle) {
    $data = loadLibraryData();
    
    // Find member and book
    $member = null;
    $book = null;
    
    foreach ($data['members'] as &$m) {
        if ($m['name'] == $memberName) {
            $member = &$m;
            break;
        }
    }

    foreach ($data['books'] as &$b) {
        if ($b['title'] == $bookTitle) {
            $book = &$b;
            break;
        }
    }

    if ($member && $book) {
        if ($book['availableCopies'] > 0) {
            // Update available copies and member's borrowed books
            $book['availableCopies']--;
            $member['borrowedBooks'][] = $bookTitle;
            saveLibraryData($data);
            return "Success: $memberName borrowed $bookTitle.";
        } else {
            return "Error: No available copies of $bookTitle.";
        }
    }
    
    return "Error: Member or Book not found.";
}

// Return book function
function returnBook($memberName, $bookTitle) {
    $data = loadLibraryData();
    
    // Find member and book
    $member = null;
    $book = null;
    
    foreach ($data['members'] as &$m) {
        if ($m['name'] == $memberName) {
            $member = &$m;
            break;
        }
    }

    foreach ($data['books'] as &$b) {
        if ($b['title'] == $bookTitle) {
            $book = &$b;
            break;
        }
    }

    if ($member && $book) {
        if (in_array($bookTitle, $member['borrowedBooks'])) {
            // Update available copies and member's borrowed books
            $book['availableCopies']++;
            $key = array_search($bookTitle, $member['borrowedBooks']);
            unset($member['borrowedBooks'][$key]);
            saveLibraryData($data);
            return "Success: $memberName returned $bookTitle.";
        } else {
            return "Error: $memberName did not borrow $bookTitle.";
        }
    }
    
    return "Error: Member or Book not found.";
}

// Display available books
function displayAvailableBooks() {
    $data = loadLibraryData();
    echo "<h3>Available Books:</h3>";
    foreach ($data['books'] as $book) {
        echo $book['title'] . " - " . $book['availableCopies'] . " copies available<br>";
    }
}
?>
