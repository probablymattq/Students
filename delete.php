<?php
    $conn = mysqli_connect("localhost", "root", "", "students");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "DELETE FROM students WHERE id = '" . $_GET["id"] . "'";

  if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit();
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }

  mysqli_close($conn);
?>