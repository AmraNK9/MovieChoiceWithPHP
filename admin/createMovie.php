<?php
require("../connect.php");
?>
<?php
session_start();
$titleErr = "";
$discErr = "";
$titleErrClass = '';
$disErrClass = '';
$imgErrClass = '';
$imgErr = '';
if (isset($_POST['submit'])) {

    if ($_POST["title"] !== "" && 
        $_POST["discription"] !== "" && 
        $_POST['img'] !== '' && 
        $_POST['rating'] !== ''&&
        $_POST['release'] !== ''&&
        $_POST['teleLink'] !== ''
        )
    {
        $title = $_POST['title'];
        $disc = $_POST['discription'];
        $img = $_POST['img'];
        $rating = $_POST['rating'];
        $release = $_POST['release'];
        $teleLink = $_POST['teleLink'];
        $querry = "INSERT INTO movies (title, review,image,rating,relaseDate,teleLink)
         VALUES ('$title', '$disc','$img','$rating','$release','$teleLink')";
        mysqli_query($db, $querry);
        $_SESSION["success-msg"] = "Success! Your Movie has been Added.";
        header("location:index.php");
    }
    if ($_POST["title"] == '') {
        $titleErr = "Title Name is Required";
        $titleErrClass = "is-invalid";
    }
    if ($_POST["discription"] == '') {
        $discErr = "Description Name is Required";
        $disErrClass = "is-invalid";
    }
    if ($_POST['img'] == '') {
        $imgErr = 'Image Link is Require';
        $imgErrClass = 'is-invalid';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-title">
                            Post Creating Page
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="index.php" class="btn btn-secondary float-end">
                            << Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="createMovie.php" method="post">
                    <div class="form-group">
                        <label class="form-label" for="">title</label>
                        <input class="form-control <?php echo $titleErrClass ?>" name="title" type="text">
                        <span class="text-danger">
                            <?php echo $titleErr ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Review</label>
                        <textarea class="form-control <?php echo $disErrClass ?>" name="discription" id="" cols="30"
                            rows="10"></textarea>
                        <span class="text-danger">
                            <?php echo $discErr ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Image Link</label>
                        <input class="form-control <?php echo $imgErrClass ?>" name="img" type="text">
                        <span class="text-danger">
                            <?php echo $imgErr ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Rating</label>
                        <input class="form-control <?php echo $imgErrClass ?>" name="rating" type="text">
                        <span class="text-danger">
                            <?php echo $imgErr ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Release Date</label>
                        <input class="form-control <?php echo $imgErrClass ?>" name="release" type="text">
                        <span class="text-danger">
                            <?php echo $imgErr ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Telegram Link</label>
                        <input class="form-control <?php echo $imgErrClass ?>" name="teleLink" type="text">
                        <span class="text-danger">
                            <?php echo $imgErr ?>
                        </span>
                    </div>
                    <button class="btn btn-primary mt-1" name="submit" type="submit">create</button>
                </form>
            </div>
        </div>



    </div>
</body>

</html>