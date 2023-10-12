<?php

header("Access-Conrol-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Conrol-Allow-Method: GET");
header("Acess-Conrol-Allow-Header: Content-type, Acess-Conrol-Allow-Header, Authorization, X-Request-With");

include("function.php");

$request_method = $_SERVER["REQUEST_METHOD"];

if($request_method == 'GET')
{
    if(isset($_GET['id']))
    {
        $student_data = get_one_data($_GET);
        echo $student_data;
    }
    else
    {
        $student_data = get_all_data();
        echo $student_data;
    }
}
else
{
    $data = [
        "status" => 405,
        "message" => $request_method. " Method not allowed",
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}

?>
