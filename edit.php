<?php
    $conn = mysqli_connect("localhost", "root", "", "students");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_POST["submit"])) {
    $sql = "UPDATE students SET 
      first_name = '" . $_POST["first_name"] . "', 
      last_name = '" . $_POST["last_name"] . "', 
      email = '" . $_POST["email"] . "', 
      birthday = '" . $_POST["birthday"] . "', 
      gender = '" . $_POST["gender"] . "', 
      grade = '" . $_POST["grade"] . "' 
      WHERE id = '" . $_GET["id"] . "'";

    if (mysqli_query($conn, $sql)) {
      header("Location: index.php");
      exit();
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  } else if(isset($_POST["cancel"])) {
    header("Location: index.php");
    exit();
  }

  $sql = "SELECT * FROM students WHERE id = '" . $_GET["id"] . "'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
?>
<html>
  <head>
    <title>Students</title>
  </head>
  <body>
    <div class="container">
      <form action="edit.php?id=<?php echo $_GET["id"]; ?>" method="post">
      <label for="last_name">Lastname</label>
        <input type="text" name="last_name" pattern="[a-zA-ZăîâțșĂÎÂȚȘ]+" required value="<?php echo $row["last_name"]; ?>">
        <label for="first_name">Firstname</label>
        <input type="text" name="first_name" pattern="[a-zA-ZăîâțșĂÎÂȚȘ]+" required value="<?php echo $row["first_name"]; ?>">   
        <label for="email">Email</label> 
        <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="name@mail.com" required value="<?php echo $row["email"]; ?>">
        <label for="birthday">Birthday</label>
        <input type="date" name="birthday" required value="<?php echo $row["birthday"]; ?>">
        <label for="gender">Gender</label>
        <select name="gender">
          <option value="Bărbat" <?php if ($row["gender"] == "Male") echo "selected"; ?>>Male</option>
          <option value="Femeie" <?php if ($row["gender"] == "Female") echo "selected"; ?>>Female</option>
        </select>
        <label for="grade">Grade</label>
        <input type="number" name="grade" min="1" max="10" required value="<?php echo $row["grade"]; ?>">
        <input type="submit" name="submit" value="Edit"><input type="submit" name="cancel" value="Cancel">
      </form>
    </div>
  </body>
  <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #eee;
        color: #333;
      }
      label {
        display: block;
        margin-bottom: 10px;
      }
      form {
        width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      input[type="text"],
      select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
        font-size: 16px;
        border: 1px solid #ddd;
      }
      input[type="submit"] {
        width: 49.3%;
        padding: 10px;
        background-color: #333;
        color: #fff;
        border: 0;
        cursor: pointer;
        margin-left: 4px;
      }
      input[name="submit"] {
        background-color: #4CAF50;
      }
      input[name="cancel"] {
        background-color: #f44336;
      }
      input[type="date"] {
        border: 1px solid #ddd;
        font-size: 16px;
        padding: 10px;
        width: 100%;
        margin-bottom: 20px;
        box-sizing: border-box;
      }
      input[type="number"] {
        border: 1px solid #ddd;
        font-size: 16px;
        padding: 10px;
        width: 100%;
        margin-bottom: 20px;
        box-sizing: border-box;
      }
    </style>
</html>
