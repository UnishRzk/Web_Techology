<?php
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Create uploads directory if not exists
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

// Check if file was uploaded without errors
if (isset($_POST["submit"])) {
    // Check file size (limit: 2MB)
    if ($_FILES["fileToUpload"]["size"] > 2 * 1024 * 1024) {
        echo "Sorry, your file is too large. Max size is 2MB.";
        $uploadOk = 0;
    }

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
        $uploadOk = 0;
    }

    // Upload if everything is ok
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
