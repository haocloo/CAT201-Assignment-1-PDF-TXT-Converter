<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Welcome to hell!</title>
  <link rel="stylesheet" type="text/css" href="../css/index.css">
</head>

<body>

  <div class="header">Welcome to PDF and TXT Converter</div>

  <div class="container">
    <div class="hero">
      <div class="title">PDF and TXT Converter</div>
      <div class="content">Convert your PDF to TXT and TXT to PDF without having to install software.</div>
    </div>

    <!-- Form for PDF file upload -->
    <form action="../php/convert_pdf_to_txt.php" method="POST" enctype="multipart/form-data">
      <div class="btn-large">
        <i class="material-icons left">file_upload</i>
        Select PDF File to Convert to TXT <input type="file" name="user-file" id="user-file" accept=".pdf">
      </div>
      <div class="btn-large">
        <input type="submit" value="Submit">
      </div>
    </form>
    <div id="pdf-message">
      <?php
      if (isset($_SESSION['pdf-message'])) {
        echo $_SESSION['pdf-message'];
        unset($_SESSION['pdf-message']);
      }
      ?>
    </div>

    <!-- Form for TXT file upload -->
    <form action="../php/convert_txt_to_pdf.php" method="POST" enctype="multipart/form-data">
      <div class="btn-large">
        <i class="material-icons left">file_upload</i>
        Select TXT File to Convert to PDF <input type="file" name="user-file" id="user-file" accept=".txt">
      </div>
      <div class="btn-large">
        <input type="submit" value="Submit">
      </div>
    </form>
    <div id="txt-message">
      <?php
      if (isset($_SESSION['txt-message'])) {
        echo $_SESSION['txt-message'];
        unset($_SESSION['txt-message']);
      }
      ?>
    </div>

    <!-- Link to download CSV file -->
    <a class="btn-large" href="../csv/sample.csv" download>Download CSV file</a>

  </div>

  <div class="footer">© 2023 PDF and TXT Converter. All rights reserved.</div>

</body>

</html>