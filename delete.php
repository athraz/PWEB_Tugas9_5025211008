<?php
include("config.php");

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $filenameQuery = mysqli_query($conn, "SELECT cover FROM books WHERE id = '$id'");
    $filenameRow = mysqli_fetch_assoc($filenameQuery);
    $filename = $filenameRow['cover'];

    $filePath = "cover/" . $filename;
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $query = mysqli_query($conn, "DELETE FROM books WHERE id = '$id'");

    if ($query){
        header('Location: index.php');
    } else {
        die("gagal menghapus...");
    }
} else {
    die("akses dilarang...");
}
?>
