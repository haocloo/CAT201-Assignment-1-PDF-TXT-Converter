<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>PDF and TXT Converter</title>
  <link rel="stylesheet" type="text/css" href="../css/output.css">
</head>

<body>

  <div class="header">Welcome to PDF and TXT Converter</div>

  <div class="container">

    <div class="hero">
      <div class="title">PDF and TXT Converter</div>
      <div class="content">Easily convert PDF to TXT and TXT to PDF without installing any software.</div>
    </div>

    <!-- Form for PDF file upload -->
    <form action="../php/convert_pdf_to_txt.php" method="POST" enctype="multipart/form-data">
      <label class="btn-large">
        <i class="material-icons left">file_upload</i>
        Select PDF File to Convert to TXT
        <input type="file" name="user-file" accept=".pdf" required>
      </label>
      <div class="btn-large">
        <input type="submit" value="Convert">
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
      <label class="btn-large">
        <i class="material-icons left">file_upload</i>
        Select TXT File to Convert to PDF
        <input type="file" name="user-file" accept=".txt" required>
      </label>
      <div class="btn-large">
        <input type="submit" value="Convert">
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

    <!-- Button to download CSV file -->
    <a class="btn-large" href="../csv/sample.csv" download>
      <i class="material-icons left">cloud_download</i> Download Sample CSV
    </a>

  </div>

  <div class="footer">© 2023 PDF and TXT Converter. All rights reserved.</div>

</body>

</html>