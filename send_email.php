<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $service = $_POST['service'];

    // Email recipient
    $to = "edwinmade54@gmail.com";

    // Email subject
    $subject = "New Booking Request from Hair Studio Website";

    // Create HTML message
    $message = "
    <html>
    <head>
        <title>New Booking Request</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { padding: 20px; }
            .header { background-color: #4CAF50; color: white; padding: 10px; }
            .content { padding: 20px; }
            .footer { background-color: #f5f5f5; padding: 10px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Booking Request</h2>
            </div>
            <div class='content'>
                <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                <p><strong>Date:</strong> " . htmlspecialchars($date) . "</p>
                <p><strong>Service:</strong> " . htmlspecialchars($service) . "</p>
            </div>
            <div class='footer'>
                <p>This is an automated message from Hair Studio Website</p>
            </div>
        </div>
    </body>
    </html>";

    // Set content-type header for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    try {
        if(mail($to, $subject, $message, $headers)) {
            echo json_encode(['status' => 'success', 'message' => 'Booking submitted successfully! We will contact you shortly.']);
        } else {
            throw new Exception('Failed to send email');
        }
    } catch (Exception $e) {
        error_log("Email sending failed: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Failed to send booking request. Please try again.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>