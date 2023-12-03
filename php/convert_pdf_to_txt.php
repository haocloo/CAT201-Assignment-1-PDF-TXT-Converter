<?php
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
        file_put_contents("/var/www/html/output/compile_log.txt", shell_exec("cd /var/www/html/java && javac -cp .:lib/* ConvertPDF.java 2>&1"));
        $output = shell_exec("cd /var/www/html/java && java -cp .:lib/* ConvertPDF \"/var/www/html/input/" . $_FILES['user-file']['name'] . "\" 2>&1");
        file_put_contents("/var/www/html/output/run_log.txt", $output);
    }
}

// Redirect back to index.html
header('Location: ../html/index.html');
exit;
