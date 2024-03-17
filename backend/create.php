<?php

include("connection.php");


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');



$title = $_POST['title'];
$content = $_POST['content'];

$query = $mysqli->prepare("INSERT INTO news(title, content) VALUES(?,?);");

$query->bind_param('ss', $title, $content);
$query->execute();
$response['status'] = 'success';
$response['message'] = "new added successfully";


echo json_encode($response);
