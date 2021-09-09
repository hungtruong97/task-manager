<?php
include 'config/constants.php';
?>

<body>
    <h1>TASK MANAGER</h1>
    <a href="<?php echo SITEURL; ?>">Home</a>
    <h3>Add Task Page</h3>

    <form action="" method="POST">
        <table>
            <tr>
                <td>Task Name:</td>
                <td><input type="text" name="task_name" placeholder="Type your task name"></td>
            </tr>

            <tr>
                <td>Task Description:</td>
                <td><textarea name="task_description" placeholder="Type your task description"></textarea></td>
            </tr>

            <tr>
                <td>Select List: </td>
                <td>
                    <select name="list_id" id="">
                        <?php
                        $conn =  mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
                        $sql = "SELECT * FROM tbl_lists";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            $count_rows = mysqli_num_rows($res);
                            if ($count_rows > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $list_id = $row['list_id'];
                                    $list_name = $row['list_name'];
                        ?>
                                    <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">None</option>
                        <?php
                            }
                        }
                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Priority: </td>
                <td>
                    <select name="priority" id="">
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Deadline: </td>
                <td><input type="date" name="deadline"></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>


    </form>
</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die();
    $db_select2 = mysqli_select_db($conn2, DB_NAME);
    $sql2 = "INSERT INTO tbl_tasks SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = '$list_id',
            priority = '$priority',
            deadline = '$deadline'
            ";
    $res2 = mysqli_query($conn2, $sql2);
    if ($res2 == true) {
        $_SESSION['add_task'] = 'Task Added';
        header('location:' . SITEURL);
    } else {
        $_SESSION['add_task_fail'] = 'Fail to add task';
        header('locatiion:' . SITEURL);
    }
}
?>