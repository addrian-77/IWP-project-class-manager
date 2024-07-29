<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>IWP Project</title>

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <header>
    <div class="container">
      <p>Welcome!</p>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
      <br>
      <form action="./phpScripts/loginScript.php" method="POST">
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="mb-3">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password" required>
        </div>
        <div class="mb-3">
            <fieldset>
                <input type="radio" name="loginType" value="Professor" required>
                <label for="prof">Professor</label>
                <input type="radio" name="loginType" value="Student" required>
                <label for="student">Student</label><br>
            </fieldset>
        </div>
        <button type="submit" class="btn btn-success">Login</button>
    </form>

      </div>
      <div class="col-md-7">

      </div>
    </div>
  </div>
  <?php include './phpGen/footer.php'; ?>