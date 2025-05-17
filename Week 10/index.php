<!DOCTYPE html>
<html>
<head>
    <title>PHP Basics</title>
</head>
<body>

<?php
    echo "<h2>Hello, World from PHP!</h2>";

    $language = "PHP";
    $version = 8.2;
    $isFun = true;

    echo "This page is powered by $language version $version.<br>";

    print "Learning PHP is easy and fun!<br>";

    $color = "blue";
    echo "My favorite color is " . $color . ".<br>";

    $car = "Tesla";
    $speed = 250;
    echo "I drive a $car which can go up to $speed km/h.<br>";

    echo "<h3>Debugging with var_dump:</h3>";
    var_dump($language); echo "<br>";
    var_dump($version); echo "<br>";
    var_dump($isFun); echo "<br>";

    echo "<p>This is a paragraph printed from PHP.</p>";
?>

</body>
</html>
