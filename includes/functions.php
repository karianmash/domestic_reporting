<?php 

function confirmQuery($result) {
    
     global $conn;
    
    if (!$result) {
        die("Query Failed " . mysqli_error($conn));
    }
}

function escape_string($string) {
    
    global $conn;
    
    return mysqli_real_escape_string($conn, $string);
}

function redirect($string) {

    header("Location: $string");
}

function logout($string) {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_first_name']);
    unset($_SESSION['user_last_name']);
    unset($_SESSION['user_email']);
    unset($_SESSION['role_id']);

	redirect($string);
}

function delete_center($id, $center) {

    global $conn;

    $find_sql   =   "SELECT * FROM centers WHERE center_id = $id";
    $find_query =   mysqli_query($conn, $find_sql);

    if (mysqli_num_rows($find_query) > 0) {
        $sql = "DELETE FROM centers WHERE center_id = $id";

        if(mysqli_query($conn, $sql)) {
            $_SESSION['success_message']   =   "Center Deleted Succesfully";
            $_SESSION['error_message']  =   "";
        } else {
            $_SESSION['error_message']    =   "Failed To Delete Center";
            $_SESSION['success_message']  =   "";
        }

    }

    redirect($center);
}

function resolve_issue($id) {

    global $conn;

    $sql = "UPDATE issues SET issues.issue_state = 1, issues.issue_resolve_date = now() WHERE issue_id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        
        $_SESSION['success_message']   =   "Issue Resolved Succesfully";
        $_SESSION['error_message']  =   "";
    } else {

        $_SESSION['error_message']    =   "Failed To Resolve Issue";
        $_SESSION['success_message']  =   "";
    }

    redirect("issues.php");

}

?>
