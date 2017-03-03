<?php
require_once(dirname(__FILE__).'/include/global.php');

if (isset($_GET['action'])){

    $retVals = array('error'=>'', 'setfocus'=>'');    
    
    if($_GET['action'] == 'get_user_path_steps'){
        
        $setting_key = checkRequiredFieldGet("setting_key", "No key was supplied, please try again.");
        $setting_value = checkRequiredFieldGet("setting_value", "No value was supplied, please try again.");
        
        $pa_id = ProcessFormParameter("get", "pa_id", true);
        $team_id = ProcessFormParameter("get", "team_id", true);
        
        setUserSetting($setting_key, $setting_value, $pa_id, $team_id);
        
        echo json_encode($retVals);
        exit();        
    }
    
    elseif($_GET['action'] == 'get_person_setting'){
        
        $setting_key = checkRequiredFieldGet("setting_key", "No key was supplied, please try again.");

        $pa_id = ProcessFormParameter("get", "pa_id", true);
        $team_id = ProcessFormParameter("get", "team_id", true);
        
        $retVals['setting_value'] = getUserSetting($setting_key, $pa_id, $team_id);
        
        echo json_encode($retVals);
        exit();        
    }
    
    //When all else fails - send something
	$retVals['error'] = "No valid action specified (" . $_GET['action'] . ")";
    echo json_encode($retVals);
    exit();  
}


    $sql = "SELECT
                *
            FROM
                agency_reps
            ";
    $query = $db->query($sql);
    $reps = $db->fetch_all($query);

    if ($db->num_rows($query) > 0) {
    
        foreach($reps as $rep){
            echo "rep: " . $rep['rep_name'] . "<br/>";
        }
        
    } else {
        echo "Nothing here!";
    }
?>