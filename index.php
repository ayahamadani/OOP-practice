<?php 

    require('validate.php');

    if(isset($_POST['submit'])) {
        // validate entries
        $validation = new UserValidator($_POST);
        $errors = $validation->validateForm();

        // saving data to db if no errors are available

    }

?>


<html lang="en">
<head>
  <title>PHP OOP</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  
  <div class="new-user">
    <h2>Create a new user</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username']) ?? '' ?>">
            <div class="error">
                <?php echo $errors['username'] ?? '' ?>
            </div>

            <label>Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']) ?? '' ?>">
            <div class="error">
                <?php echo $errors['email'] ?? '' ?>
            </div>
            <input type="submit" value="Submit" name="submit" >
        </div>
    </form>
  </div>

</body>
</html>