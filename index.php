<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>friendsbook</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <?php
        include('header.html');
    ?>
    <br/>
    <!-- form -->
    <form action="index.php" method="post">
        Name : <input type="text" name="myname">
        <input type="submit" class="button1" value="add new friend">
    </form>
    <br/>
    <?php
        echo "<h2>My best friends : </h2>";
        $filename = 'friends.txt';
        if (isset($_POST['myname'])) {
            if($_POST['myname'] != "") {
                $file = fopen($filename, "a");
                fwrite($file, PHP_EOL.$_POST['myname']);
                fclose($file);
            }
        }
    ?>
    <?php
        //unset($_POST);
        $filename = 'friends.txt';
        // Reading file
        $file = fopen($filename, "r");

        while (!feof($file)){

            $name = fgets($file); //reading each line

            if(isset($_POST['nameFilter'])) {
                if(isset($_POST['startingWith'])){
                    $position = strpos(strtolower($name), strtolower($_POST['nameFilter']));
                    if($position !== false){
                        if($position === 0){
                            echo "<li>$name</li>";
                        }
                    }
                }
                else {
                    if (strstr(strtolower($name), strtolower($_POST['nameFilter']))) {
                        echo "<li>$name</li>";
                    }
                }
            } 
            else {
                echo "<li>$name</li>";
            } 
            
        }
        fclose($file);
  
    ?>
    <form action="index.php" method="post">
        <input type="text" name="nameFilter" value="<?=$nameFilter?>" class="filter"> 
        <input type="submit" class="button2" value="Filter list" class="filter"><br>
        <input type="checkbox" name="startingWith"> Only names starting with
        
    </form>
    
   
   <!-- Footer -->
    <?php
         include('footer.html');
    ?>

</body>
</html>