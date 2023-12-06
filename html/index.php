<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF and TXT Converter</title>
  <link rel="stylesheet" type="text/css" href="../css/output.css">
  <style>
    body {
      background-image: url('../images/Fall Tree.jpg');
      background-size: cover;
      /* or 'contain' depending on your preference */
      background-repeat: no-repeat;
      background-attachment: fixed;
      /* Fixed background */
      margin: 0;
      /* Remove default margin */
      margin-top: 50px;
      /* Adjust the value based on the height of your fixed header */
      padding: 0;
      /* Remove default padding */
    }

    .font-header {
      font-family: 'Cambria', sans-serif;
      font-style: italic;
    }

    .arial-black-font {
      font-family: Arial Black, sans-serif;
    }

    .verdana-font {
      font-family: Verdana, sans-serif;
    }

    .times-font {
      font-family: 'Times New Roman', Times, serif;
      font-size: 1.1em;
    }

    /* Keyframe animation for falling leaves with fade-in and rotation (right-hand side leaves) */
    @keyframes fallingLeavesRight {
      0% {
        transform: translateY(-10vh) translateX(0) rotate(0deg);
        opacity: 0;
        /* Start with opacity 0 */
      }

      20% {
        opacity: 0.7;
        /* Gradually increase opacity within the first second */
      }

      100% {
        transform: translateY(110vh) translateX(10vw) rotate(360deg);
        opacity: 0.9;
        /* Maintain opacity at 0.9 after the initial fade-in */
      }
    }

    /* Keyframe animation for falling leaves with fade-in and rotation (left-hand side leaves) */
    @keyframes fallingLeavesLeft {
      0% {
        transform: translateY(-10vh) translateX(0) rotate(0deg);
        opacity: 0;
        /* Start with opacity 0 */
      }

      10% {
        opacity: 0.7;
        /* Gradually increase opacity within the first second */
      }

      100% {
        transform: translateY(110vh) translateX(-10vw) rotate(360deg);
        opacity: 0.9;
        /* Maintain opacity at 0.9 after the initial fade-in */
      }
    }

    /* Style for the falling leaves */
    .falling-leaf {
      position: fixed;
      pointer-events: none;
      /* Do not capture pointer events */
      z-index: -1;
      /* Set a lower z-index to place leaves behind other elements */
    }

    /* Apply different styles to each leaf */
    .leaf1 {
      animation: fallingLeavesRight linear infinite;
      animation-duration: 8s;
    }

    .leaf2 {
      animation: fallingLeavesRight linear infinite;
      animation-duration: 10s;
    }

    .leaf3 {
      animation: fallingLeavesRight linear infinite;
      animation-duration: 12s;
    }

    .leaf4 {
      animation: fallingLeavesRight linear infinite;
      animation-duration: 9s;
    }

    /* Apply different styles to each bottom leaf */
    .leaf5 {
      animation: fallingLeavesLeft linear infinite;
      animation-duration: 8s;
    }

    .leaf6 {
      animation: fallingLeavesLeft linear infinite;
      animation-duration: 10s;
    }

    .leaf7 {
      animation: fallingLeavesLeft linear infinite;
      animation-duration: 12s;
    }

    .leaf8 {
      animation: fallingLeavesLeft linear infinite;
      animation-duration: 9s;
    }
  </style>
</head>

<body class="bg-gray-100 font-sans">
  <div class="fixed top-0 w-full text-center p-4 text-white text-2xl font-header" style="background-image: url('../images/Header.jpg'); box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.5);">
    <h1 style="font-size: 40px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); letter-spacing: 2px; text-transform: uppercase;"> PDF & TXT CONVERTER</h1>
  </div>

  <div class="container mx-auto p-8">

    <div class="bg-white p-8 rounded shadow-lg">
      <div class="text-3xl font-bold mb-4 arial-black-font">PDF and TXT Converter</div>
      <div class="text-gray-700">Easily convert PDF to TXT and TXT to PDF without installing any software.</div>
    </div>

    <div class="mt-4"></div>

    <div class="container mx-auto p-8 bg-yellow-100 bg-opacity-80 border-orange-500 border rounded">

      <!-- Form for PDF file upload -->
      <form action="../php/convert_pdf_to_txt.php" method="POST" enctype="multipart/form-data" class="mt-4">
        <label for="pdf-file" class="text-lg font-semibold verdana-font">Select PDF File to Convert to TXT File</label>
        <input type="file" name="user-file[]" id="pdf-file" accept=".pdf" class="mt-2 p-2 border rounded" multiple required>
        <div class="flex flex-row gap-5 mt-4">
          <input type="submit" value="Submit" class="bg-red-500 hover:bg-red-700 text-white font-bold h-10 px-4 rounded transition-width duration-500 delay-200 hover:scale-110">
          <div id="txt-message">
            <?php
            if (isset($_SESSION['txt-message'])) {
              echo $_SESSION['txt-message'];
              unset($_SESSION['txt-message']);
            }
            ?>
          </div>
        </div>
      </form>

      <!-- Form for TXT file upload -->
      <form action="../php/convert_txt_to_pdf.php" method="POST" enctype="multipart/form-data" class="mt-8">
        <label for="txt-file" class="text-lg font-semibold verdana-font">Select TXT File to Convert to PDF File</label>
        <input type="file" name="user-file[]" id="txt-file" accept=".txt" class="mt-2 p-2 border rounded" multiple required>
        <div class="flex flex-row gap-5 mt-4">
          <input type="submit" value="Submit" class="bg-red-500 hover:bg-red-700 text-white font-bold h-10 px-4 rounded transition-width duration-500 delay-200 hover:scale-110">
          <div id="pdf-message">
            <?php
            if (isset($_SESSION['pdf-message'])) {
              echo $_SESSION['pdf-message'];
              unset($_SESSION['pdf-message']);
            }
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="container mx-auto p-8">
    <!-- Instructions for PDF to TXT conversion -->
    <div class="mt-1 float-left w-1/2 border rounded p-4 bg-gray-100">
      <div class="text-2xl font-bold mb-2 text-blue-500">How to Convert PDF to TXT:</div>
      <ol class="list-decimal pl-6 times-font">
        <li>Choose the PDF file from your laptop.</li>
        <li>Click the <span class="font-semibold text-blue-700 !important">Submit</span> button.</li>
        <li>Wait patiently while the system converts the file to TXT.</li>
        <li>Once the conversion is complete, press the <span class="font-semibold text-blue-700 !important">Download</span> button to get the TXT file.</li>
      </ol>
    </div>

    <!-- Instructions for TXT to PDF conversion -->
    <div class="mt-1 float-right w-1/2 border rounded p-4 bg-gray-100">
      <div class="text-2xl font-bold mb-2 text-blue-500">How to Convert TXT to PDF:</div>
      <ol class="list-decimal pl-6 times-font">
        <li>Choose the TXT file from your laptop.</li>
        <li>Click the <span class="font-semibold text-blue-700 !important">Submit</span> button.</li>
        <li>Wait patiently while the system converts the file to PDF.</li>
        <li>Once the conversion is complete, press the <span class="font-semibold text-blue-700 !important">Download</span> button to get the PDF file.</li>
      </ol>
    </div>
  </div>
  <div class="text-center w-full h-auto mt-8 rounded" style="background: linear-gradient(to bottom, rgba(255, 255, 204, 0) 0%, rgba(255, 255, 204, 0.5) 50%, rgba(255, 255, 204, 0.8) 100%);">
    <div class="text-black font-semibold">Prepared by: Yeo Din Song, Loo Chi Hao, Lim Yong Jun, Lim Jia Liang</div>
    <div class="text-black font-semibold">© 2023 PDF and TXT Converter. All rights reserved.</div>
  </div>

  <!-- Falling leaves animation -->
  <div class="falling-leaf leaf1" style="left: 92.5%; top: 5%;">
    <img src="../images/leaves1.png" alt="Leaf 1">
  </div>
  <div class="falling-leaf leaf2" style="left: 87.5%; top: 10%;">
    <img src="../images/leaves2.png" alt="Leaf 2">
  </div>
  <div class="falling-leaf leaf3" style="left: 75%; top: 5%;">
    <img src="../images/leaves3.png" alt="Leaf 3">
  </div>
  <div class="falling-leaf leaf4" style="left: 62.5%; top: 15%;">
    <img src="../images/leaves4.png" alt="Leaf 4">
  </div>
  <div class="falling-leaf leaf5" style="left: 50%; top: 15%;">
    <img src="../images/leaves1.png" alt="Leaf 1">
  </div>
  <div class="falling-leaf leaf6" style="left: 37.5%; top: 2%;">
    <img src="../images/leaves2.png" alt="Leaf 2">
  </div>
  <div class="falling-leaf leaf7" style="left: 20%; top: 10%;">
    <img src="../images/leaves3.png" alt="Leaf 3">
  </div>
  <div class="falling-leaf leaf8" style="left: 2%; top: 5%;">
    <img src="../images/leaves4.png" alt="Leaf 4">
  </div>

</body>

</html>