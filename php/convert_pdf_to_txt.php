<?php
session_start();

$_SESSION['message'] = 'File is uploading...';

if (isset($_FILES['user-file'])) {
    //Array to display different errors
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    //Initialise the error as false
    $extension_error = false;

    //Prompt user that the file extension type is not accepted
    if ($extension_error) {
        echo "Invalid File extension!";
        echo "We only accept pdf file.";
    } else {
        // Create the input directory if it does not exist
        if (!file_exists('/var/www/html/input')) {
            mkdir('/var/www/html/input', 0777, true);
        }

        // Move the uploaded file to the input directory
        move_uploaded_file($_FILES['user-file']['tmp_name'], '/var/www/html/input/' . $_FILES['user-file']['name']);

        // Create the output directory if it does not exist
        if (!file_exists('/var/www/html/output')) {
            mkdir('/var/www/html/output', 0777, true);
        }

        // Execute the java program
        file_put_contents("/var/www/html/output/compile_log.txt", shell_exec("cd /var/www/html/java && javac -cp .:lib/* PDFTextConverter.java 2>&1"));
        $output = shell_exec("cd /var/www/html/java && java -cp .:lib/* PDFTextConverter \"/var/www/html/input/" . $_FILES['user-file']['name'] . "\" 2>&1");
        file_put_contents("/var/www/html/output/run_log.txt", $output);

        // Set success message with a link to download the converted text file
        $filenameWithoutExtension = pathinfo($_FILES['user-file']['name'], PATHINFO_FILENAME);
        $_SESSION['txt-message'] = '
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold h-10 px-4 rounded">
          <a href="/output/' . $filenameWithoutExtension . '.txt" download>Download</a>
        </button>';
    }
}

// Redirect back to index.php
header('Location: ../html/index.php');
exit;
