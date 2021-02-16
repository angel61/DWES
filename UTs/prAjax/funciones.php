<?php

function login($l,$c){
    $ret ="NO_OK";
    $cnn=mysqli_connect(HOST,US,PW,BBDD);
    if ($cnn){
        $sql="SELECT DISTINCT * FROM ". TBL_USER." WHERE nombre='$l' AND clave='$c'";
        $rest=mysqli_query($cnn, $sql);
        if (mysqli_num_rows($rest) == 1){//si se valida
            $ret="OK";

            $_SESSION['validado'] = True;
        }
        else{
            session_destroy();
        }
    }
    mysqli_close($cnn);

    return "<xml><data><func>0</func><status>$ret</status></data></xml>";
}

function logout(){
    session_destroy();
    return "<xml><data><func>1</func><status>OK</status></data></xml>";
}

function selectData(){
    if (isset($_SESSION['validado']) && $_SESSION['validado'])
        return '{
                "data": {
                "func": "2",
                "status": "OK",
                "data": [{"a1":"a1d", "b1":"b1d"},{"a1":"a2d", "b1":"b2d"}]
                }
            }';
    else
        return '{
                "data": {
                "func": "2",
                "status": "NO_OK",
                }
            }';
}
function updateData(){
    if (isset($_SESSION['validado']) && $_SESSION['validado'])
        return '{
                "data": {
                "func": "3",
                "status": "OK",
                }
            }';
    else
        return '{
                "data": {
                "func": "3",
                "status": "NO_OK",
                }
            }';
}

function deleteData(){
    if (isset($_SESSION['validado']) && $_SESSION['validado'])
        return '{
                "data": {
                "func": "4",
                "status": "OK",
                }
            }';
    else
        return '{
                "data": {
                "func": "4",
                "status": "NO_OK",
                }
            }';
}