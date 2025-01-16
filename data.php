<?php
include 'header.php';
?>

<div class="container">
    <?php
    require 'connection.php';
    $sqli="SELECT * FROM `visitors`";
    $result_q=mysqli_query($conn, $sqli);
    $data = mysqli_fetch_all($result_q, MYSQLI_ASSOC);
    
    ?>
 <table class="table">
                <tr>
                    <th> Name</th>
                    <th> Weight</th>
                    <th> Height</th>
                    <th> Result</th>
                </tr>
                <?php
                foreach ($data as $person) {
                    echo "
                    <tr> 
                             <td>" . $person['name'] . "</td>
                             <td>" . $person['weight'] . "</td>
                             <td>" . $person['height'] . "</td>
                             <td>" . $person['Result'] . "</td>
                          </tr>";
                }
                ?>
            </table>


    <?php
    include 'footer.php';
    ?>