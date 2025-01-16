<?php
include 'header.php';
?>

<div class="container">
    <?php
    require 'connection.php';

    $name = "";
    $updateName = "";
    $errors = ['updateName' => "", 'name' => "",];

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $updateName = htmlspecialchars($_POST['updateName']);


        if (empty($name)) {
            $errors['name'] = "Name required";
        }

        if (empty($updateName)) {
            $errors['updateName'] = "Name for update required";
        }

        if ($conn) {
            $sqli = "UPDATE `visitors` SET `name`='$updateName' WHERE name='$name'";
            mysqli_query($conn, $sqli);
            header('location: data.php');
        }

    }
    ?>

    <div class="row ">
        <div class="col-md-5">
            <form class="form-group mt-5 " action="update.php" method="POST">
                <input class="form-control" type="text" placeholder="Name of person" name="name">
                <span class="text-danger"><?php echo $errors['name'] ?></span><br>

                <input class="form-control" type="text" placeholder="Enter name for update" name="updateName">
                <span class="text-danger"><?php echo $errors['name'] ?></span><br>

                <input type="submit" class="btn btn-warning" name="submit">
            </form>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>