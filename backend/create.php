<?php

include("connection.php");

$title = $_POST['title'];
$content = $_POST['content'];

$query = $mysqli->prepare("INSERT INTO news(title, content) VALUES(?,?);");

$query->bind_param('ss', $title, $content);
$query->execute();
$response['status'] = 'success';
$response['message'] = "new added successfully";


echo json_encode($response);
