<?php
include 'config/constants.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    $db_select = mysqli_select_db($conn, DB_NAME);
    $sql = "DELETE FROM tbl_tasks WHERE task_id = $task_id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $_SESSION['delete_task'] = 'Task Deleted!';
        header('location:' . SITEURL);
    } else {
        $_SESSION['delete_task_fail'] = 'Fail to delete task';
        header('location:' . SITEURL);
    }
}
