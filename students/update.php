<?php

error_reporting(0);

header("Access-Conrol-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Conrol-Allow-Method: PUT");
header("Acess-Conrol-Allow-Header: Content-type, Acess-Conrol-Allow-Header, Authorization, X-Request-With");

include("function.php");

$request_method = $_SERVER["REQUEST_METHOD"];

if($request_method == "PUT")
{
    $input_data =json_decode(file_get_contents("php://input"),true);
    $student_data = edit_std_data($input_data,$_GET);
    echo $student_data ;

}else
{
    $data = [
        "status" => 405,
        "message" => $request_method. " Method not allowed",
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}

?>