<?php
include 'config/constants.php';
?>

<body>
    <div class="container">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            <h1 class="navbar-brand">TASK MANAGER</h1>

            <!-- Menu Starts Here-->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href=" <?php echo SITEURL; ?>index.php">Home</a></li>
                <?php
                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $sql2 = "SELECT * FROM tbl_lists";
                $res2 = mysqli_query($conn2, $sql2);
                if ($res2 == true) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $list_name = $row2['list_name'];
                        $list_id = $row2['list_id'];
                ?>
                        <li class="nav-item">
                            <a class="nav-link" href=" <?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                        </li>
                <?php
                    }
                }

                ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a></li>
            </ul>
        </div>

        <!-- Menu Ends Here-->

        <!-- Task Starts Here-->
        <div class="all-tasks">
            <a href="<?php echo SITEURL; ?>add-task.php">Add Task</a>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>

                <p>
                    <?php
                    if (isset($_SESSION['add_task'])) {
                        echo $_SESSION['add_task'];
                        unset($_SESSION['add_task']);
                    }

                    if (isset($_SESSION['add_task_fail'])) {
                        echo $_SESSION['add_task_fail'];
                        unset($_SESSION['add_task_fail']);
                    }

                    if (isset($_SESSION['delete_task'])) {
                        echo $_SESSION['delete_task'];
                        unset($_SESSION['delete_task']);
                    }

                    if (isset($_SESSION['delete_task_fail'])) {
                        echo $_SESSION['delete_task_fail'];
                        unset($_SESSION['delete_task_fail']);
                    }

                    if (isset($_SESSION['update_task'])) {
                        echo $_SESSION['update_task'];
                        unset($_SESSION['update_task']);
                    }
                    ?>
                </p>

                <?php
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
                $db_select = mysqli_select_db($conn, DB_NAME);
                $sql = "SELECT * FROM tbl_tasks";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count_rows = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count_rows > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            $task_id = $row['task_id'];
                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <td colspan="5">No Tasks</td>
                <?php
                    }
                }
                ?>
            </table>
        </div>
        <!-- Task Ends Here-->
    </div>
</body>

</html>