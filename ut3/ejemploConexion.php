<?php
$host="localhost";
$us="root";
$pw="";
$bd="escuela";
@$conn=mysqli_connect($host,$us,$pw,$bd);
if($conn){
    $sql="select * from usuarios";
    $rest=mysqli_query($conn,$sql);
    echo "<select>";
    while($row=mysqli_fetch_assoc($rest)){
        echo "<option value=".$row['tipo']."\"> ".$row['usuario']."</option>";
    }
    echo "</select>";
}
mysqli_close($conn);