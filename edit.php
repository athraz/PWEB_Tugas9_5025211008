<?php

include("config.php");

if (isset($_POST['edit'])) {
    $bookId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    if ($title == '' || $description == '') {
        $_SESSION['failed'] = "Data tidak lengkap!";
        header('Location: form-create.php');
        exit;
    }

    if (!empty($_FILES['cover']['size'])) {
        $filenameQuery = mysqli_query($conn, "SELECT cover FROM books WHERE id = '$bookId'");
        $filenameRow = mysqli_fetch_assoc($filenameQuery);
        $filename = $filenameRow['cover'];

        $filePath = "cover/" . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $fileExtension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        $newFileName = $bookId . '.' . $fileExtension;
        $uploadDirectory = 'cover/';


        if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadDirectory . $newFileName)) {
            mysqli_query($conn, "UPDATE books SET title = '$title', description = '$description', cover = '$newFileName' WHERE id = '$bookId'");
            $_SESSION['sukses'] = "Pesan berhasil disampaikan";
            header('Location: index.php');
        }
    } else {
        mysqli_query($conn, "UPDATE books SET title = '$title', description = '$description' WHERE id = '$bookId'");
        $_SESSION['sukses'] = "Pesan berhasil disampaikan";
        header('Location: index.php');
    }
} else {
    die("Akses dilarang...");
}
