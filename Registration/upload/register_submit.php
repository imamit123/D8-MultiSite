<?php
session_start();
include '../basic.php';
include '../config.php';
?>


<html>
    <body>
        <?php

        if (isset($_POST['Register']))
        {

            if(isset($_POST['count'])) {$count=$_POST['count'];}
            

            for($i=1; $i<=$count; $i++)
            {
                if(!empty($_POST['confirm'.$i])) 
                { ?>

                <?php 

                    if(isset($_POST['id'.$i])) 
                    {
                        $id=$_POST['id'.$i];

                        $query = "update delegate set registered = 1 where id=$id";
                        $result = mysql_query($query);

                        if ($result)
                        {
                            echo "Record with ID: ".$id." successfully registered."; ?>
                            <br></br>
                            <?php
                        }
                    }
                }
            }
        }
        ?>
    <a href="register.php">Back</a>
    </body>
</html>
