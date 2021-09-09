<?php
include 'config/constants.php';
?>

<body>
    <h1>TASK MANAGER</h1>
    <!-- Menu Starts Here-->
    <div class="menu">
        <a href="<?php echo SITEURL; ?>index.php">Home</a>
        <?php
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $sql2 = "SELECT * FROM tbl_lists";
        $res2 = mysqli_query($conn2, $sql2);
        if ($res2 == true) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $list_name = $row2['list_name'];
                $list_id = $row2['list_id'];
        ?>
                <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
        <?php
            }
        }

        ?>
        <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
    </div>

    <!-- Menu Ends Here-->
    <h3>List Task Page</h3>
    <table>
        <tr>
            <th>No.</th>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Priority</th>
            <th>Deadline</th>
            <th>Action</th>
        </tr>

        <?php
        if (isset($_GET['list_id'])) {
            $list_id = $_GET['list_id'];
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());
            $sql = "SELECT * FROM tbl_tasks WHERE list_id = $list_id";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                $count_rows = mysqli_num_rows($res);
                $sn = 1;
                if ($count_rows > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $task_id = $row['task_id'];
                        $task_name = $row['task_name'];
                        $task_description = $row['task_description'];
                        $priority = $row['priority'];
                        $deadline = $row['deadline'];

        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $task_name; ?></td>
                            <td><?php echo $task_description; ?></td>
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
                    <tr>
                        <td colspan="6">No Tasks Added</td>
                    </tr>
        <?php
                }
            }
        }
        ?>

    </table>
</body>

</html>