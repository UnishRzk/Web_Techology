<?php
// Custom function to divide two numbers with error handling
function divide($numerator, $denominator) {
    if ($denominator == 0) {
        // Throw an exception if division by zero
        throw new Exception("Division by zero is not allowed.");
    }
    return $numerator / $denominator;
}

// Main code block
try {
    $num1 = 10;
    $num2 = 0;

    echo "Trying to divide $num1 by $num2...<br>";
    $result = divide($num1, $num2);
    echo "Result: $result";
}
catch (Exception $e) {
    // Catch and handle the exception
    echo "Error: " . $e->getMessage();
}
finally {
    echo "<br>End of script.";
}
?>
