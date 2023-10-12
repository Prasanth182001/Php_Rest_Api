<?php

require "../inc/db_connect.php";


function error422($messages)
{
    $data = [
        "status" => 422,
        "message" => $messages,
    ];
    header("HTTP/1.0 422 Unprocessable entity");
    return json_encode($data);
    exit();
}


function add_std_data($input_data)
{
    global $db_connect;

    $name = mysqli_real_escape_string($db_connect,$input_data['name']);
    $age = mysqli_real_escape_string($db_connect,$input_data['age']);
    $city = mysqli_real_escape_string($db_connect,$input_data['city']);

    if(empty(trim($name)))
    {
        return error422("Enter your name :");
    }
    elseif(empty(trim($age)))
    {
        return error422("Enter your age :");
    }
    elseif(empty(trim($city)))
    {
        return error422("Enter your city :");
    }
    else
    {
        $query = "insert into students (Student_Name,Student_Age,Student_City) values ('$name','$age','$city')";
        $query_run = mysqli_query($db_connect,$query);

        if($query_run)
        {
            $data = [
                "status" => 201,
                "message" => "Student data added successfully",
            ];
            header("HTTP/1.0 201 Added");
            return json_encode($data);
        }
        else
        {
            $data = [
                "status" => 500,
                "message" => "Internal server error",
            ];
            header("HTTP/1.0 500 Internal server error");
            return json_encode($data);
        }
    }
}


function get_all_data()
{
    global $db_connect;

    $query = "select * from students";
    $query_run = mysqli_query($db_connect,$query);

    if($query_run)
    {
        if(mysqli_num_rows($query_run) > 0)
        {
            $result = mysqli_fetch_all($query_run,MYSQLI_ASSOC);

            $data = [
                "status" => 200,
                "message" => "Student data fetched successfully",
                "data" => $result,
            ];
            header("HTTP/1.0 200 Student data fetched successfully");
            return json_encode($data);
        }
        else
        {
            $data = [
                "status" => 404,
                "message" => "Student data not found",
            ];
            header("HTTP/1.0 404 Student data not found");
            return json_encode($data);
        }

    }
    else
    {
        $data = [
            "status" => 500,
            "message" => "Internal server error",
        ];
        header("HTTP/1.0 500 Internal server error");
        return json_encode($data);
    }

}


function get_one_data($std_id)
{
    global $db_connect;

    if($std_id['id'] == null)
    {
        return error422("Enter student id :");
    }
    
    $student_id = mysqli_real_escape_string($db_connect,$std_id['id']);

    $qurey = "select * from students where Id='$student_id' limit 1";
    $query_run = mysqli_query($db_connect,$qurey);

    if($query_run)
    {
        if(mysqli_num_rows($query_run) == 1)
        {
            $result = mysqli_fetch_assoc($query_run);

            $data = [
                "status" => 200,
                "message" => "student data fetched successfully",
                'data' => $result
            ];
            header("HTTP/1.0 200 success");
            return json_encode($data);

        }
        else
        {
            $data = [
                "status" => 404,
                "message" => "student data not found",
            ];
            header("HTTP/1.0 404 Data not found");
            return json_encode($data);
        }
    }
    else
    {
        $data = [
            "status" => 500,
            "message" => "Internal server error",
        ];
        header("HTTP/1.0 500 server error");
        return json_encode($data);
    }

}


function edit_std_data($input_data,$std_id)
{
    global $db_connect;

    if(!isset($std_id['id']))
    {
        return error422("Student id not found in url");
    }
    elseif($std_id['id'] == null)
    {
        return error422("Enter the student id :");
    }

    $id = mysqli_real_escape_string($db_connect,$std_id['id']);

    $name = mysqli_real_escape_string($db_connect,$input_data['name']);
    $age = mysqli_real_escape_string($db_connect,$input_data['age']);
    $city = mysqli_real_escape_string($db_connect,$input_data['city']);

    if(empty(trim($name)))
    {
        return error422("Enter your name :");
    }
    elseif(empty(trim($age)))
    {
        return error422("Enter your age :");
    }
    elseif(empty(trim($city)))
    {
        return error422("Enter your city :");
    }
    else
    {
        $query = "update students set Student_Name='$name',Student_Age='$age',Student_City='$city' where Id='$id' limit 1";
        $query_run = mysqli_query($db_connect,$query);

        if($query_run)
        {
            $data = [
                "status" => 201,
                "message" => "Student data added successfully",
            ];
            header("HTTP/1.0 201 Added");
            return json_encode($data);
        }
        else
        {
            $data = [
                "status" => 500,
                "message" => "Internal server error",
            ];
            header("HTTP/1.0 500 Internal server error");
            return json_encode($data);
        }
    }
}


function del_std_data($std_id)
{
    global $db_connect;

    if(!isset($std_id['id']))
    {
        return error422("Student id not found in url");
    }
    elseif($std_id['id'] == null)
    {
        return error422("Enter the student id :");
    }

    $id = mysqli_real_escape_string($db_connect,$std_id['id']);

    $query =" delete from students where Id='$id' limit 1 ";
    $query_run = mysqli_query($db_connect,$query);

    if($query_run)
        {
            $data = [
                "status" => 200,
                "message" => "Student data deleted successfully",
            ];
            header("HTTP/1.0 200 sucsess");
            return json_encode($data);
        }
        else
        {
            $data = [
                "status" => 404,
                "message" => "data not found",
            ];
            header("HTTP/1.0 404 Not found");
            return json_encode($data);
        }




}
?>