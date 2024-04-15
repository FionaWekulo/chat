<?php
   include_once  '../../path.php';
require_once MODEL_PATH . "operations.php";

$conn = connect();

    $outgoing_id = $_SESSION['user_id'];
    $searchTerm = $_POST['searchTerm'];

    $sql = "SELECT * FROM therapist WHERE therapist_name LIKE '%{$searchTerm}%'  ";

    $output = "";
    $query = select_rows($sql);
    if(!empty($query)){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>
