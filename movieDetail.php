<?php
require("connect.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $querry = "SELECT * FROM movies WHERE id = $id";
    $result = mysqli_query($db, $querry);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
        foreach ($result as $row) {


            ?>
            <div class="card mb-3" style="max-hight:200px">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="<?php echo $row['image'] ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p class="float-start">title</p>
                                    <p class="float-end">
                                        <?php echo $row['title'] ?>
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="float-start">rating</p>
                                    <p class="float-end">
                                        <?php echo $row['rating'] ?>
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="float-start">release</p>
                                    <p class="float-end">
                                        <?php echo $row['relaseDate'] ?>
                                    </p>
                                </li>
                             
                            </ul> </small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Reviews
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $row['title']; ?>
                    </h5>
                    <p class="card-text">
                        <?php
                        echo $row['review'];
                        ?>
                    </p>
                    <a href="<?php echo $row['teleLink'] ?>" class="btn float-end btn-primary">Download Now</a>
                </div>
            </div>
        <?php } ?>
    </body>

    </html>
<?php } ?>