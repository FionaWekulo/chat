<?php 
 include_once  '../../path.php';
require_once MODEL_PATH . "operations.php";

$conn = connect(); 
    if(isset($_SESSION['user_id'])){
        $arr['outgoing_msg_id'] = $_SESSION['user_id'];
        $arr['incoming_msg_id'] = $_POST['incoming_id'];
        $arr['message'] = $_POST['message'];
        if(!empty($arr['message'])){
            build_sql_insert("messages",$arr);
           
        }
    }else{
        header("location: ../login.php");
    }


    
?>