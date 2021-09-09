<?php
include 'config/constants.php';
?>

<body>
    <h1>TASK MANAGER</h1>
    <a href="<?php echo SITEURL; ?>index.php">Home</a>
    <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
    <h3>Add List Page</h3>

    <p>
        <?php
        //Check whether the session is created or not
        if (isset($_SESSION['add_fail'])) {

            //display session message
            echo $_SESSION['add_fail'];

            //remove the message after displaying once
            unset($_SESSION['add_fail']);
        }

        ?>
    </p>

    <!--Form to Add List Starts Here-->
    <form action="" method="post">
        <table>
            <tr>
                <td>List Name</td>
                <td><input type="text" name="list_name" id="" placeholder="Type list name here" required></td>
            </tr>
            <tr>
                <td>List Description</td>
                <td><textarea name="list_description" id="" cols="30" rows="10" placeholder="Type list description here"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>

        </table>


    </form>
    <!--Form to Add List Ends Here-->
</body>

</html>

<?php
//Check wheter the form is submitted or not
if (isset($_POST['submit'])) {
    //echo 'Form Submitted';

    //Get the values from form and save it in a variable
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    //connect database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die();

    //check whether the database connected or not
    /*if($conn == true) {
            echo 'Database connected';
        }
        */

    //Select Database
    $db_select = mysqli_select_db($conn, DB_NAME);

    //Check whether databse is connected or not
    // if ($db_select == true) {
    //     echo 'Database selected!';
    // }

    //SQL Query to insert data into database
    $sql = "INSERT INTO tbl_lists  SET
            list_name = '$list_name',
            list_description = '$list_description'
        ";

    //Execute Query and Insert into database
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if ($res == true) {
        //echo 'Data Inserted!';

        //Create a session variable to display message
        $_SESSION['add'] = "List Added Successfully";

        //Redirect to manage list page
        header('location:' . SITEURL . 'manage-list.php');
    } else {
        // echo 'Fail to insert Data';

        //Create session to save message
        $_SESSION['add_fail'] = "Fail to add list";

        //Redirect to same page
        header('location:' . SITEURL . 'add-list.php');
    }
}
?>