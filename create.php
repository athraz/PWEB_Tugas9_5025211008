<?php

include('config.php');

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    if ($title == '' || $description == '') {
        $_SESSION['failed'] = "Data tidak lengkap!";
        header('Location: form-create.php');
        exit;
    }

    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);

    $bookId = uniqid();

    if (!empty($_FILES['cover']['size'])) {
        $fileExtension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        $newFileName = $bookId . '.' . $fileExtension;
        $uploadDirectory = 'cover/';


        if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadDirectory . $newFileName)) {
            mysqli_query($conn, "INSERT INTO books VALUES ('$bookId', '$title', '$description', '$newFileName')");
            $_SESSION['sukses'] = "Pesan berhasil disampaikan";
            header('Location: index.php');
        }
    } 
    else {
        mysqli_query($conn, "INSERT INTO books VALUES ('$bookId', '$title', '$description', NULL)");
        $_SESSION['sukses'] = "Pesan berhasil disampaikan";
        header('Location: index.php');
    }
}
