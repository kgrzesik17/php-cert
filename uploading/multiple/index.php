<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uploading Multiple Files</title>
</head>
<body>
  

  <h2>Upload Multiple Files</h2>

  <form action="upload.php" method="POST" enctype="multipart/form-data">
    Select files to upload:
    <input type="file" name="files[]" multiple><br><br>
    <input type="Submit" value="Uploading files">
  </form>

</body>
</html>