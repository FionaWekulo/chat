<?php
include_once  '../../path.php';
require_once MODEL_PATH . "operations.php";

$conn = connect();

                            foreach ($query as $row) {

        $profile = get_by_id('therapist',$row['therapist_id']);

        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = '$row[therapist_id]'
                OR outgoing_msg_id = '$row[therapist_id]') AND (outgoing_msg_id = '$outgoing_id' 
                OR incoming_msg_id = '$outgoing_id') ORDER BY message_id DESC LIMIT 1";
       
        $row2 = select_rows($sql2)[0];

        
        (!empty($row2)) ? $result = $row2['message'] : $result ="No message available";
        (strlen($result) > 28) ? $message =  substr($result, 0, 28) . '...' : $message = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            
            $you = "";
        }
        ($row['activity'] == "Inactive") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['therapist_id']) ? $hid_me = "hide" : $hid_me = "";

       $output .= '<a href="chat.php?therapist_id='. $row['therapist_id'] .'">
                <div class="content">
                <img src="' . file_url . $row['therapist_image'] . '" alt="therapist image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />

                <div class="details">
                    <span>'. $row['therapist_name'] . '</span>
                    <p>'. $you . $message .'</p>
                </div>
                </div>
                <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
            </a>';

    }
    
?>