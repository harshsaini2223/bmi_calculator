<?php
include 'header.php';
?>

<div class="container">
    <?php
    require 'connection.php';

    $name = "";
    $errors = ['name' => "",];

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);

        if (empty($name)) {
            $errors['name'] = "Name required";
        }
        if($name){
            $sqli = "DELETE FROM `visitors` WHERE name='$name'";
                mysqli_query($conn, $sqli);
                header('location: data.php');
        }
      
    }
    ?>

    <div class="row ">
        <div class="col-md-5">
            <form class="form-group mt-5 " action="delete.php" method="POST">
                <input class="form-control" type="text" placeholder="Enter your name" name="name">
                <span class="text-danger"><?php echo $errors['name'] ?></span><br>

                <input type="submit" class="btn btn-warning" name="submit">
            </form>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>