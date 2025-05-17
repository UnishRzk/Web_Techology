<?php
$xml = simplexml_load_file("books.xml") or die("Error: Cannot load XML file.");

foreach ($xml->book as $book) {
    echo "Title: " . $book->title . "<br>";
    echo "Author: " . $book->author . "<br>";
    echo "Year: " . $book->year . "<br>";
    echo "---------------------------<br><br>";
}
?>
`   