<?php
include 'header.php';
?>

<div class="container">
    <?php
    require 'connection.php';

    $name = "";
    $weight = "";
    $height = "";
    $result = "";

    $errors = ['weight' => "", 'height' => "", 'name' => "",];

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $weight = htmlspecialchars($_POST['weight']);
        $height = htmlspecialchars($_POST['height']);

        if (empty($name)) {
            $errors['name'] = "Name required";
        }

        if (empty($weight)) {
            $errors['weight'] = "Weight required";
        } elseif (!is_numeric($weight)) {
            $errors['weight'] = "Weight must be a number";
        }

        if (empty($height)) {
            $errors['height'] = "Height required";
        } elseif (!is_numeric($height)) {
            $errors['height'] = "Height must be a number";
        }
        if ($conn) {
            $sqli = "INSERT INTO `visitors`(`name`, `weight`, `height`, `Result`) VALUES ('$name','$weight','$height','$result')";
            mysqli_query($conn, $sqli);
           
        }

    }
    ?>

    <div class="row ">
        <div class="col-md-5">
            <form class="form-group mt-5 " action="index.php" method="POST">
                <input class="form-control" type="text" placeholder="Enter your name" name="name">
                <span class="text-danger"><?php echo $errors['name'] ?></span><br>

                <input class="form-control" type="text" placeholder="Your Weight in Kg" name="weight">
                <span class="text-danger"><?php echo $errors['weight'] ?></span><br>

                <input class="form-control" type="text" placeholder="Your Height in Meters" name="height">
                <span class="text-danger"><?php echo $errors['height'] ?></span><br>

                <input type="submit" class="btn btn-warning" name="submit">
            </form>

            <p>You have entered:</p>
            <p>Weight: <?php echo $weight; ?></p>
            <p>Height: <?php echo $height; ?></p>

            <?php
            if (isset($_POST['submit']) && empty($errors['weight']) && empty($errors['height']) && empty($errors['name'])) {
                function bodyMass($weight, $height)
                {
                    if ($height == 0) {
                        throw new DivisionByZeroError("Height cannot be zero");
                    }
                    return $weight / ($height ** 2);
                }

                try {
                    $bmi = bodyMass((float) $weight, (float) $height);
                    echo "$name, your BMI is $bmi and you are ";

                    if ($bmi <= 18.5) {
                        $result = "underweight";
                        echo $result;
                    } elseif ($bmi > 18.5 && $bmi <= 24.9) {
                        $result = "healthy";
                        echo $result;
                    } else {
                        $result = "overweight";
                        echo $result;
                    }
                } catch (DivisionByZeroError $e) {
                    echo "Error: " . $e->getMessage();
                }

                if($result){
                    
                    $sqli1="UPDATE `visitors` SET `Result`='$result' WHERE name='$name'";
                    mysqli_query($conn, $sqli1);
                }
            }


            ?>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>