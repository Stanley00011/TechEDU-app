<?php
if (isset($_GET['action']) && $_GET['action'] == 'addContactDetails') {
   include_once("./../connection/connection.php");
    $stmt = $conn->prepare("INSERT INTO `contactform` (`firstname`, `email`, `subject`, `message`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $_POST['firstName'], $_POST['contactEmail'], $_POST['subject'], $_POST['msgBody']);
    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Thank You for contacting us we get you back asap!');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to add contact details');
    }
    $stmt->close();
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
