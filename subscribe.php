<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $phone = $_POST["phone"];
    $email = $_POST["email"];
      
    echo "Success: You have subscribed to receive daily tech facts!";
} else {

    echo "Error: Invalid request.";
}
?>





<?php
        
$slackApiKey = 'SLACK_API_KEY';


function sendMessageToSlack($message) {
    $slackUrl = "https://slack.com/api/chat.postMessage";
    $channel = "general"; 
    $data = array(
        "text" => $message,
        "channel" => $channel
    );

  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $slackUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

            ?>


