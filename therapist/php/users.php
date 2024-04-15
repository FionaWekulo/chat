<?php
include_once  '../../path.php';
require_once MODEL_PATH . "operations.php";

$conn = connect();
    $outgoing_id = $_SESSION['therapist_id'];
    $sql = "SELECT * FROM user";
    
    $query = select_rows($sql);
    $output = "";
    if(empty($query)){
        $output .= "No users are available to chat";
    }elseif(!empty($query)){
        include_once "data.php";
    }
    echo $output;
?>