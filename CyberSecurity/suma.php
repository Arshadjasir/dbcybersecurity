<?php
// Function to generate a random OTP
function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[mt_rand(0, $max)];
    }
    return $otp;
}

// Generate a random OTP
$otp = generateOTP();

// Send OTP to email
$to = 'recipient@example.com';
$subject = 'Your OTP';
$message = 'Your One-Time Password (OTP) is: ' . $otp;
$headers = 'From:fayasahamed118@gmail.com' . "\r\n" .
    'Reply-To: arshadjasir007@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Send email
$mailSent = mail($to, $subject, $message, $headers);

if ($mailSent) {
    echo "OTP sent successfully to $to";
} else {
    echo "Failed to send OTP. Please try again later.";
}
?>
