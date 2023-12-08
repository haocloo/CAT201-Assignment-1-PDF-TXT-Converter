<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Convert PDF to TXT and TXT to PDF easily without installing any software.">
  <title>PDF and TXT Converter</title>
  <link rel="stylesheet" type="text/css" href="../css/output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans pt-2 flex flex-col min-h-screen bg-no-repeat bg-fixed bg-cover mt-12" style="background-image: url('../images/Fall Tree.jpg');">
  <header class="z-10 fixed top-0 w-full text-center p-4 text-white text-2xl shadow-md" style="background-image: url('../images/Header.jpg');">
    <h2 class="text-3xl md:text-4xl lg:text-5xl text-shadow-md italic font-bold uppercase tracking-wider">PDF & TXT CONVERTER</h2>
  </header>

  <main class="flex-grow container mx-auto flex flex-col gap-5 p-8 mt-5">

    <section class="bg-white p-8 mt-8 rounded-lg shadow-lg">
      <h2 class="text-3xl sm:text-3xl font-bold mb-4 ">PDF and TXT Converter</h2>
      <p class="text-gray-700">Easily convert multiple PDF to TXT and TXT to PDF without installing any software.</p>
    </section>

    <section class="z-0 container mx-auto p-8 bg-yellow-100 bg-opacity-80 border shadow-lg rounded-lg ">
      <!-- Form for PDF file upload -->
      <div class="relative">
        <form id="pdf-form" action="../php/convert_pdf_to_txt.php" method="POST" enctype="multipart/form-data" class="mt-4">
          <h2 class="text-xl font-bold">Select PDF File to Convert to TXT File</h2>
          <!-- Upload button -->
          <div class="w-full py-2 mt-2 flex flex-row gap-3">
            <input type="file" name="user-file[]" id="pdf-file" accept=".pdf" class="hidden" multiple required onchange="displayFileNames(this.files)">
            <label for="pdf-file" class="cursor-pointer bg-blue-500 text-white font-bold py-2 px-4 rounded inline-block hover:bg-blue-700">Upload PDF files</label>
            <div id="pdf-file-names" class="mt-2 text-lg font-semibold text-blue-600"></div>
          </div>
          <!-- Submit button -->
          <div class="flex flex-row gap-5 mt-4">
            <button id="pdf-submit-button" type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold h-10 px-4 rounded transition-width duration-500 delay-200 hover:scale-110">
              <span id="pdf-submit-text">Submit</span>
              <i id="pdf-submit-loading" class="ml-2 fa-solid fa-circle-notch animate-spin origin-center" style="display:none;"></i>
            </button>
          </div>
        </form>
        <!-- Download button -->
        <div id="pdf-message" class="absolute bottom-0 left-36 flex flex-row gap-3">
          <?php
          if (isset($_SESSION['pdf-message'])) {
            echo $_SESSION['pdf-message'];
            unset($_SESSION['pdf-message']);
          }
          ?>
        </div>
      </div>

      <!-- Form for TXT file upload -->
      <div class="relative">
        <form action="../php/convert_txt_to_pdf.php" method="POST" enctype="multipart/form-data" class="mt-8">
          <h2 class="text-xl font-bold">Select TXT File to Convert to PDF File</h2>
          <!-- Upload button -->
          <div class="w-full py-2 mt-2 flex flex-row gap-3">
            <input type="file" name="user-file[]" id="txt-file" accept=".txt" class="hidden" multiple required onchange="displayFileNames(this.files)">
            <label for="txt-file" class="cursor-pointer bg-blue-500 text-white font-bold py-2 px-4 rounded inline-block hover:bg-blue-700">Upload .TXT files</label>
            <div id="txt-file-names" class="mt-2 text-lg font-semibold text-blue-600"></div>
          </div>

          <div class="flex flex-row gap-5 mt-4">
            <button id="txt-submit-button" type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold h-10 px-4 rounded transition-width duration-500 delay-200 hover:scale-110">
              <span id="txt-submit-text">Submit</span>
            </button>
          </div>
        </form>
        <!-- Download Button -->
        <div id="txt-message" class="absolute bottom-0 left-36 flex flex-row gap-3">
          <?php
          if (isset($_SESSION['txt-message'])) {
            echo $_SESSION['txt-message'];
            unset($_SESSION['txt-message']);
          }
          ?>
        </div>
      </div>
    </section>

    <div class=" flex flex-col md:flex-row justify-center">
      <!-- Instructions for PDF to TXT conversion -->
      <div class="float-left flex-1 border rounded-tl-lg rounded-tr-lg md:rounded-tr-none md:rounded-tl-lg md:rounded-bl-lg p-4 bg-gray-100">
        <div class="text-2xl font-bold mb-2 text-blue-500">How to Convert PDF to TXT:</div>
        <ol class="list-decimal pl-6 times-font">
          <li>Choose the PDF file(s) from your laptop.</li>
          <li>Click the <span class="font-semibold text-blue-700">Submit</span> button.</li>
          <li>Wait patiently while the system converts the file to TXT.</li>
          <li>Once the conversion is complete, press the <span class="font-semibold text-blue-700">Download</span> button to get the TXT file.</li>
        </ol>
      </div>

      <!-- Instructions for TXT to PDF conversion -->
      <div class="float-right flex-1 border rounded-bl-lg rounded-br-lg md:rounded-bl-none md:rounded-tr-lg md:rounded-br-lg p-4 bg-gray-100">
        <div class="text-2xl font-bold mb-2 text-blue-500">How to Convert TXT to PDF:</div>
        <ol class="list-decimal pl-6 times-font">
          <li>Choose the TXT file(s) from your laptop.</li>
          <li>Click the <span class="font-semibold text-blue-700">Submit</span> button.</li>
          <li>Wait patiently while the system converts the file to PDF.</li>
          <li>Once the conversion is complete, press the <span class="font-semibold text-blue-700">Download</span> button to get the PDF file.</li>
        </ol>
      </div>
    </div>


  </main>
  <footer class="text-center w-full h-auto pt-2 mt-4 rounded-lg" style="background: linear-gradient(to bottom, rgba(255, 255, 204, 0.15) 0%, rgba(255, 255, 204, 0.5) 50%, rgba(255, 255, 204, 0.8) 100%);">
    <div class="text-black font-semibold">Prepared by: Yeo Din Song, Loo Chi Hao, Lim Yong Jun, Lim Jia Liang</div>
    <div class="text-black font-semibold">© 2023 PDF and TXT Converter. All rights reserved.</div>
  </footer>


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
    <img src="../images/leaves4.png" alt="Leaf 4">`
  </div>

</body>

</html>

<script>
  // Upload button
  function displayFileNames(inputElementId, outputElementId) {
    var fileInput = document.getElementById(inputElementId);
    fileInput.addEventListener('change', function() {
      var files = fileInput.files;
      var fileNames = Array.from(files).map(file => file.name);
      if (fileNames.length > 0) {
        document.getElementById(outputElementId).textContent = 'Selected ' + fileNames.join(', ');
      } else {
        document.getElementById(outputElementId).textContent = '';
      }
    });
  }

  // Submit & Loading button
  function handleFormSubmit(formId, submitButtonId, submitLoadingId) {
    var form = document.getElementById(formId);
    var submitButton = document.getElementById(submitButtonId);
    var submitLoading = document.getElementById(submitLoadingId);

    form.addEventListener('submit', function(event) {
      if (form.checkValidity()) {
        submitLoading.style.display = 'inline-block';
        submitButton.disabled = true;
      } else {
        event.preventDefault();
        event.stopPropagation();
      }
    });
  }

  displayFileNames('pdf-file', 'pdf-file-names');
  handleFormSubmit('pdf-form', 'pdf-submit-button', 'pdf-submit-loading');

  displayFileNames('txt-file', 'txt-file-names');
  handleFormSubmit('txt-form', 'txt-submit-button', 'txt-submit-loading');
</script>