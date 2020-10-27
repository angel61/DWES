<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ejer36.php" method="post">
    <?php    
    for($i=1;$i<=5;$i++){
    echo "Numero $i:</td><td><input type=\"number\" name=\"numero[]\">";
    }
    ?>
    </form>
    <?php
    if(isset($_POST["numero"][0])){
        
    }
    ?>
</body>
</html>