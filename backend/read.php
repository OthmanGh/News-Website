<?php
include("connection.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$query = $mysqli->prepare("SELECT * from news");

$query->execute();

$query->store_result();

$num_rows = $query->num_rows();


if ($num_rows == 0) {

    $response['status'] = 'no news found';
} else {

    $news = [];

    $query->bind_result($id, $title, $content, $published_date);

    while ($query->fetch()) {

        $new = [
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "published_date" => $published_date,
        ];

        $news[] = $new;
    }

    $response['status'] = 'success';
    $response['news'] =  $news;
}

echo json_encode($response);
