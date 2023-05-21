<?php

include("config.php");

if (!isset($_GET['id'])) {
    header('Location: list-siswa.php');
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM books WHERE id LIKE '$id'");
$book = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan...");
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PWEB Tugas 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <h1 class="mx-5 mb-3" style="margin-top: 20px">Edit book</h1>
    <form action="edit.php" method="POST" enctype="multipart/form-data" class="mx-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?php echo $book['id'] ?>" />

                        <div class="form-group mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Insert Book Title" value="<?php echo $book['title'] ?>" >
                        </div>

                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea type="text" class="form-control" name="description" placeholder="Insert Book Description"><?php echo $book['description'] ?></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label>Cover</label>
                            <input type="file" class="form-control" name="cover" placeholder="Insert Book cover">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-danger">Back</a>
                            <button type="submit" name="edit" class="btn btn-primary" style="border-radius: 3px">
                                <i class="nav-icon fas fa-plus-circle"></i>Save Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>