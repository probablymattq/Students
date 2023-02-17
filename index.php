<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Students</title>
  </head>
  <body>
    <div class="form-container">
      <form action="" method="post">        
        <label for="last_name">Lastname</label>
        <input type="text" name="last_name" id="last_name" value="" pattern="[a-zA-ZăîâțșĂÎÂȚȘ]+" required>

        <label for="first_name">Firstname</label>
        <input type="text" name="first_name" id="first_name" value="" pattern="[a-zA-ZăîâțșĂÎÂȚȘ]+" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="name@mail.com" required>

        <label for="birthday">Birthday</label>
        <input type="date" name="birthday" id="birthday" value="" required>

        <label for="gender">Gender</label>
        <select name="gender" id="gender" required>
          <option value="">Select</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>

        <label for="grade">Grade</label>
        <input type="number" name="grade" id="grade" value="" min="1" max="10" required>

        <input type="submit" name="submit" value="Submit">
      </form>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Email</th>
            <th>Birthday</th>
            <th>Gender</th>
            <th>Grade</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $conn = mysqli_connect("localhost", "root", "", "students");

          if (isset($_POST["submit"])) {
              $sql = "SELECT id FROM students ORDER BY id DESC LIMIT 1";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              $new_id = $row["id"] + 1;
              $first_name = $_POST["first_name"];
              $last_name = $_POST["last_name"];
              $email = $_POST["email"];
              $birthday = $_POST["birthday"];
              $gender = $_POST["gender"];
              $grade = $_POST["grade"];

              $sql = "INSERT INTO students (id, first_name, last_name, email, birthday, gender, grade) VALUES ('$new_id', '$first_name', '$last_name', '$email', '$birthday', '$gender', '$grade')";

              if ($conn->query($sql) === TRUE) {
                  header("location: index.php");
              } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
              }
          }

            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM students";
            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["last_name"] . "</td>";
              echo "<td>" . $row["first_name"] . "</td>";
              echo "<td>" . $row["email"] . "</td>";
              echo "<td>" . $row["birthday"] . "</td>";
              echo "<td>" . $row["gender"] . "</td>";
              echo "<td>" . $row["grade"] . "</td>";
              echo "<td>";
              echo "<a href='edit.php?id=" . $row["id"] . "' class='edit-btn'>Edit</a> ";
              echo "<a href='delete.php?id=" . $row["id"] . "' class='delete-btn'>Delete</a>";
              echo "</td>";
              echo "</tr>";
            }
            mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
  </body>
  <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #eee;
        color: #333;
      }
      .form-container {
        width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      label {
        display: block;
        margin-bottom: 10px;
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
        width: 100%;
        padding: 10px;
        background-color: #333;
        color: #fff;
        border: 0;
        cursor: pointer;
      }
      table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
      }
      th,
      td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
      }
      th {
        background-color: #333;
        color: #fff;
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
      .edit-btn, .delete-btn {
        background-color: #ccc;
        border: none;
        color: #fff;
        cursor: pointer;
        padding: 6.5px 10px;
        text-align: center;
        text-decoration: none;
      }

     .edit-btn {
        background-color: #4CAF50;
     }

     .delete-btn {
       background-color: #f44336;
      }
    </style>
</html>

