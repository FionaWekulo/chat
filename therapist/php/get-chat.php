<?php 
include_once  '../../path.php';
require_once MODEL_PATH . "operations.php";

$conn = connect(); 
    if(isset($_SESSION['therapist_id'])){
        $outgoing_id = $_SESSION['therapist_id'];
                $incoming_id = $_POST['incoming_id'];

                $profile = get_by_id('user',$incoming_id);

        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN therapist ON therapist.therapist_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id')
                OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id') ORDER BY message_id";
        $query = select_rows($sql);
        if(!empty($query)){
                    foreach ($query as $row) {
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                <img src="' . file_url . $profile['user_image'] . '" alt="therapist image" class="d-block ms-0 ms-sm-4 rounded user-profile-img" />
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>