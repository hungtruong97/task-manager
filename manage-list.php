<?php
include 'config/constants.php';
?>

<body>
    <h1>TASK MANAGER</h1>
    <a href="<?php echo SITEURL; ?>index.php">Home</a>
    <h3>Manage Lists Page</h3>

    <p>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['delete_fail'])) {
            echo $_SESSION['delete_fail'];
            unset($_SESSION['delete_fail']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
    </p>

    <!--Table to display list starts here-->
    <div class="all-list">
        <a href="<?php echo SITEURL; ?>add-list.php">Add List</a>
        <table>
            <tr>
                <th>#</th>
                <th>List Name</th>
                <th>Action</th>
            </tr>

            <?php
            //Connect the database
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die();
            $db_select = mysqli_select_db($conn, DB_NAME) or die();
            $sql = "SELECT * FROM tbl_lists";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                $count_rows = mysqli_num_rows($res);
                $sm = 1;
                if ($count_rows > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $list_id = $row['list_id'];
                        $list_name = $row['list_name'];
            ?>
                        <tr>
                            <td><?php echo $sm++; ?></td>
                            <td><?php echo $list_name; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>">Update</a>
                                <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php

                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="3">No Lists Added Yet</td>
                    </tr>
            <?php


                }
            }
            ?>

        </table>
    </div>
    <!--Table to display list ends here-->
</body>

</html>