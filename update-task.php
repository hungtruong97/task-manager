<?php
include 'config/constants.php';
?>

<body>
    <h1>TASK MANAGER</h1>
    <a href="<?php echo SITEURL; ?>">Home</a>
    <h3>Update Task Page</h3>
    <p>
        <?php
        if (isset($_SESSION['update_task_fail'])) {
            echo $_SESSION['update_task_fail'];
            unset($_SESSION['update_task_fail']);
        }
        ?>
    </p>

    <form action="" method="POST">
        <table>
            <tr>
                <td>Task Name: </td>
                <td><input type="text" name="task_name" placeholder="Type your task here" required></td>
            </tr>

            <tr>
                <td>Task Description: </td>
                <td><textarea name="task_description" placeholder="Type your description here"></textarea></td>
            </tr>

            <tr>
                <td>Select List: </td>
                <td><select name="list_name" id="">
                        <?php

                        if (isset($_GET['task_id'])) {
                            $task_id = $_GET['task_id'];
                            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
                            $db_select = mysqli_select_db($conn, DB_NAME);
                            $sql = "SELECT * FROM tbl_lists";
                            $res = mysqli_query($conn, $sql);
                            if ($res == true) {
                                $count_rows = mysqli_num_rows($res);
                                if ($count_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $list_name = $row['list_name'];
                                        $list_id = $row['list_id'];
                        ?>
                                        <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">No Lists Available</option>
                        <?php
                                }
                            }
                        }

                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Priority: </td>
                <td><select name="priority" id="">
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select></td>
            </tr>

            <tr>
                <td>Deadline: </td>
                <td><input type="date" name="deadline"></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
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

    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    $db_select2 = mysqli_select_db($conn2, DB_NAME);
    $sql2 = "UPDATE tbl_tasks SET
    task_name = '$task_name',
    task_description = '$task_description',
    list_id = '$list_id',
    priority = '$priority',
    deadline = '$deadline'
    WHERE task_id = $task_id";
    $res2 = mysqli_query($conn2, $sql2);
    if ($res2 == true) {
        $_SESSION['update_task'] = 'Task Updated';
        header('location:' . SITEURL);
    } else {
        $_SESSION['update_task_fail'] = 'Fail to update task';
        header('location:' . SITEURL . 'update-task.php');
    }
}
?>