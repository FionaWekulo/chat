<?php
include_once  '../../path.php';
require_once MODEL_PATH . "operations.php";

$conn = connect();

                            foreach ($query as $row) {

        $profile = get_by_id('user',$row['user_id']);

        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = '$row[user_id]'
                OR outgoing_msg_id = '$row[user_id]') AND (outgoing_msg_id = '$outgoing_id' 
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
        ($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";

      $output .= '<a href="chat.php?user_id='. $row['user_id'] .'">
                <div class="content">';
                    if(!empty($row['user_image'])){
                        $output .= '<img src="' . file_url . $row['user_image'] . '" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />';
                    } else {
                        $output .= '<img src="' . file_url . 'user.png" alt="user image" class="w-px-40 h-auto rounded-circle" />';
                    }
$output .= '      <div class="details">
                        <span>'. $row['user_name'] . '</span>
                        <p>'. $you . $message .'</p>
                    </div>
                </div>
                <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
            </a>';


    }
    
?>