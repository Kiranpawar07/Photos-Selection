<?php 

        session_start(); 

        if(!isset($_SESSION["user_id"])){
        header("Location:login.php");
        }

        include('topbar.php');
        include('connection.php');
        $user_id  = "";

        // For seleced images...
        if(isset($_POST['name']))
        {
                $name = $_POST['name'];
                $user_id = $_SESSION['user_id'];

                $sql = "SELECT name FROM tbl_gallery WHERE name='$name'";
                $res    = mysqli_query($link, $sql);

                if(mysqli_num_rows($res)!=1)
                {
                        $sql1 = "INSERT INTO tbl_gallery (name,user_id) VALUES ('$name','$user_id')";

                        if(mysqli_query($link, $sql1)){
                
                        ?>
                                <div class="container-fluid">
                                        <div class="alert alert-primary" role="alert">Image Is Selected ...!</div>
                                </div>
                
                        <?php
                        } else{
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                
                        }
                }
                else{
                        ?>
                                <div class="container-fluid">
                                        <div class="alert alert-primary" role="alert">Image Is Allready Selected ...!</div>
                                </div>
                        <?php
                }

        }
?>      

<html>

<head> 
        <title>PHOTOGRAPHY</title>

        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script src="assets/js/jquery.fancybox.min.js"></script>
        <link href="assets/js/jquery.fancybox.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head> 

<style> 
 
        body {
                margin:  0;
                padding: 0;
                background: #ccc;
        }

        main{
                width:100%;
                margin:  20px;

        }

        .thumbnails{
                width:30%;
                float: left;
                margin: 6px;
                padding: 8px;
                background: #fff;
                /* box-sizing : border-box; */
        }

        .thumbnails img{
                width:100%;
                height:auto;
        }

</style> 

<body>

        <div class="container-fluid">
        <main>
                <hr>
                <?php 
                        $path="assets/images/" .$_SESSION["username"];

                        $files = glob($path."/{*.jpg,*.jpeg,*.png}",GLOB_BRACE);

                        for ($i = 0; $i < count($files); $i++) {
                ?>
                        <form method="post" action="index.php">

                                <div class="thumbnails">

                                        <?php
                                                $image = $files[$i];
                                        ?>
                                                <a href="<?php echo $image ;?>" data-fancybox="images" data-caption="<?php echo $image; ?>">
                                                <img src="<?php echo $image ;?>" alt="<?php echo $image; ?> " class="img-responsive"></a>
                                                <input type="hidden" name="name" value="<?php echo basename($image);?>" />
                                                <input type="submit" name="select" class="btn btn-success" value="Select"/>
                                        <?php

                                        ?>
                                </div>
                        </form>

                <?php
                        }
                ?>
        </main>
        </div> 
</body>

</html>