<?php
$servername = "us-cluster-east-01.k8s.cleardb.net";
$username = "b8193b124c8531";
$password = "c2a67b2b"; 
$dbname = "mkl"; 
$conn = $con = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function get_data_by_query($query, $params = array())
{
    $result = array();
    global $conn;

    // Prepare statement
    $stmt = $conn->prepare($query);
    
    // Bind parameters if provided
    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Assuming all parameters are strings
        $stmt->bind_param($types, ...$params);
    }

    // Execute statement
    $stmt->execute();

    // Get result set
    $data = $stmt->get_result();
    
    // Fetch data
    while ($row = $data->fetch_assoc()) {
        $result[] = $row;
    }

    // Close statement
    $stmt->close();

    return $result;
}

?>