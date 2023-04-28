<?php
    require("connect.php");
    $limit = 2;

session_start();
if (isset($_SESSION['index'])) {
    
    $querry_for_row_count = "SELECT * FROM `collections`";
    $number_of_row = mysqli_query($db,$querry_for_row_count);
    $last_index = mysqli_num_rows($number_of_row)/$limit-1;

    
    if (isset($_GET['load'])) {
        if ($_GET['load'] == "Next") {
            if($_SESSION['index'] !== $last_index){
            $_SESSION['index'] = $_SESSION['index'] + 1;
            }
        } 
        else if ($_GET['load'] == "Prev") {
            if($_SESSION['index'] !== 0){
                $_SESSION['index'] = $_SESSION['index'] - 1;
            }
        }
        else if($_GET['load'] == "End"){

           
           $_SESSION["index"] = $last_index;

        }
        else if($_GET['load'] == "Home"){
            $_SESSION['index'] = 0;
        }
      
    }

} 
else {
    $_SESSION['index'] = 0;
}

$index = $limit * $_SESSION['index'];
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
    <nav class="navbar  bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand " href = 'index.php'>Movie Choice</a>
            <form class="d-flex" action="searching.php" method="get" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class=" mt-2  row me-3">
        <div class="float-end me-3">
            <ul class="text-white btn-group float-end" style="list-style:none">
                <li><a class="btn btn-warning" href="index.php?order=ASC">See latest</a></li>
                <li><a class=" ms-1 btn btn-warning" href="index.php?order=DESC">See oldest</a></li>
            </ul>
        </div>



    </div>

    <?php
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = "ASC";
    }
    $querry = "SELECT * FROM `collections` ORDER BY `title` $order Limit $limit offset $index";
    $result = mysqli_query($db, $querry);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            ?>
            <div class="container">
                <div style="   
                 background-color: #fff;" class="card  mt-3">


                    <div class="card-header">
                        <h5 class="card-title ">
                            <?php echo $row['title']; ?>
                        </h5>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <?php
                            $json = $row['MovieListId'];
                            $arr = json_decode($json);
                            $count = 0;
                            $limit = 3;
                            foreach ($arr as $index) {
                                if ($count < $limit) {


                                    $querry_for_Movie_Title = "SELECT title FROM movies WHERE id = $index";
                                    $movie_title = mysqli_query($db, $querry_for_Movie_Title);


                                    $querry_for_Movie_Image = "SELECT image FROM movies WHERE id = $index";
                                    $movie_image = mysqli_query($db, $querry_for_Movie_Image);

                                    $querry_for_Movie_Release_Date = "SELECT relaseDate FROM movies WHERE id = $index";
                                    $movie_release_date = mysqli_query($db, $querry_for_Movie_Release_Date)
                                        ?>
                                    <div class="col-4 mb-3">
                                        <a href="movieDetail.php?id=<?php echo $index ?>">
                                            <div class="card  float-end d-inline-block">
                                                <img style="height:300px;object-fit:cover" src="<?php foreach ($movie_image as $image) {
                                                    foreach ($image as $result) {
                                                        echo $result;
                                                    }
                                                } ?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <?php foreach ($movie_title as $title) {
                                                            foreach ($title as $result) {
                                                                echo $result;
                                                            }
                                                        } ?>
                                                    </h5>

                                                    <p class="card-text"><small class="text-body-secondary">
                                                            <?php foreach ($movie_release_date as $release) {
                                                                foreach ($release as $result) {
                                                                    echo $result;
                                                                }
                                                            } ?>
                                                        </small></p>
                                                </div>
                                            </div>
                                        </a>

                                    </div>


                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </div>


                        <a href="collection.php?id=<?php echo $row['id'] ?>" style="background-color:#FFA500"
                            class="btn  float-end">More Video</a>
                    </div>
                </div>
            </div>
        <?php }
    }
    ?>
    <div class="container d-flex justify-content-center mt-2 mx-auto">

        <nav aria-label="Page navigation text-center example mt-2 d-flex justify-content-center">
            <ul class="pagination ">
                <li class="page-item"><a class="page-link" href="index.php?load=Prev">Previous</a></li>
                <li class="page-item"><a class="page-link" href="index.php?load=Home">Home</a></li>
                <li class="page-item"><a class="page-link" href="index.php?load=End">End</a></li>
                <li class="page-item"><a class="page-link" href="index.php?load=Next">Next</a></li>
            </ul>
        </nav>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>