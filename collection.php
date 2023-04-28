<?php
require("connect.php");

$id = $_GET['id']
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="row ">
        <?php
        $querry = "SELECT MovieListId FROM collections WHERE id= $id";
        $result = mysqli_query($db, $querry);
        
        foreach ($result as $row) {
            foreach ($row as $json) {
                $arr = json_decode($json);
                foreach ($arr as $index) {
                    $querry_for_Movie_Title = "SELECT title FROM movies WHERE id = $index";
                    $movie_title = mysqli_query($db, $querry_for_Movie_Title);


                    $querry_for_Movie_Image = "SELECT image FROM movies WHERE id = $index";
                    $movie_image = mysqli_query($db, $querry_for_Movie_Image);

                    $querry_for_Movie_Release_Date = "SELECT relaseDate FROM movies WHERE id = $index";
                    $movie_release_date = mysqli_query($db, $querry_for_Movie_Release_Date);

                    ?>
                    <div class="col-4  mb-3">
                        <a href="movieDetail.php?id=<?php echo $index ?>">
                            <div class="card" style="">
                                <img src="<?php foreach ($movie_image as $image) {
                                    foreach ($image as $result) {
                                        echo $result;
                                    }
                                } ?>" class="card-img-top" style = "height:500px;object-fit:cover" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php foreach ($movie_title as $title) {
                                            foreach ($title as $result) {
                                                echo $result;
                                            }
                                        } ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php foreach ($movie_release_date as $release) {
                                            foreach ($release as $result) {
                                                echo $result;
                                            }
                                        } ?>
                                    </p>
                                </div>
                            </div>
                        </a>

                    </div>
                    <?php
                }
            }
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>