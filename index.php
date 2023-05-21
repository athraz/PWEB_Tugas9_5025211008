<?php include("config.php"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PWEB Tugas 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark-subtle">
        <div class="container-fluid mx-3">
            <a class="navbar-brand" href="#">BOOKS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="form-create.php" role="button">Add Books!</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <?php
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM books");
        $res = mysqli_fetch_assoc($query);
        if (!$res['total']) {
            echo '
                <div class="text-center" style="margin: 100px 0">
                <h1>No books available!</h1>
                </div>
            ';
        } else {
            echo '<div class="row justify-content-center" style="margin: 40px 0">';
            $query = mysqli_query($conn, "SELECT * FROM books");
            while ($books = $query->fetch_assoc()) {
                echo '
                    <div class="col-5 mx-3 mt-4" style="border:solid 1px black; border-radius: 30px;">
                    <div class="row align-items-center px-3 py-3">
                    <div class="col-4">
                ';
                if ($books['cover'] != NULL) {
                    echo '<img class="img-fluid" src="cover/' . $books['cover'] . '" style="width:180px; height:288px;"/>';
                } else {
                    echo '<img class="img-fluid" src="cover/null.png" style="width:180px; height:288px;" />';
                }
                echo '
                    </div>
                    <div class="col-8">
                ';
                echo '<h4 class="my-3 fs-5" style="font-weight: bolder; font-size: 24px;">' . $books['title'] . '</h4>';
                $description = strlen($books['description']) > 300 ? substr($books['description'], 0, 300) . "..." : $books['description'];
                echo '<h6 class="my-3" style="font-weight: normal; text-align: justify; font-size: 18px;">' . $description . '</h6>';
                echo '<div class="d-inline-flex my-2 justify-content-center">';
                echo '<a href="form-edit.php?id=' . $books['id'] . '" class="btn btn-warning me-3" style="max-width: 20rem; font-size: 18px;">Edit</a>'; 
                echo '<a href="delete.php?id=' . $books['id'] . '" class="btn btn-danger" style="max-width: 20rem; font-size: 18px;">Delete</a>'; 
                echo ' 
                    </div></div></div></div>
                ';
            }
            echo '</div>';
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>