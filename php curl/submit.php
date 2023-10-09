<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the submitted form
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];

    // URL to submit the form data
    $targetUrl = 'https://webhook.site/140f1660-445d-49a5-813e-a54438278937'; // Replace with the actual URL

    // Data to be sent in the POST request
    $postData = array(
        'name' => $name,
        'mobile' => $mobile
    );

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options for the POST request
    curl_setopt($ch, CURLOPT_URL, $targetUrl);
    curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData)); // Encode POST data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

    // Execute the cURL request and store the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    } else {
        // Output the response
        echo 'Form data submitted successfully!<br>';
        echo 'Response from server:<br>';
        echo $response;
    }

    // Close the cURL session
    curl_close($ch);
}




//database connection 
require_once('db_config.php'); // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the submitted form
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $place = $_POST["place"];
    $occupation = $_POST["occupation"];

    // SQL query to insert data into the database
    $sql = "INSERT INTO saving (name, mobile, place, occupation) VALUES (?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssss", $name, $mobile, $place, $occupation);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo 'Form data submitted and stored in the database successfully!';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);


?>