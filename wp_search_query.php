<?php

header("Access-Control-Allow-Origin: http://localhost:8888");

    $searchString = $_POST['searchString'];

    $servername = "localhost";
    $username = "cenedex";
    $password = "cenedex";
    $dbname = "oswa";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM products WHERE name LIKE '%" . $searchString . "%' ";
    $result = mysqli_query($conn, $sql);

    $results_json = array();

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

            array_push($results_json, 
                array(
                    'title' => $row["name"],
                    'quantity' => $row["quantity"],
                    'buy_price' => $row["buy_price"],
                    'itemlink' => $row["itemLink"],
                    'city' => $row["city"],
                    'zipcode' => $row["zipcode"],
                    'phone' => $row["phone"],
                    'email' => $row["email"],
                    'website' => $row["website"],
                    'company'=> $row["company"],
                    'reviewLink' => $row["reviewLink"]
                )
            );

        }

    } else {

        echo "0 results";

    }

    mysqli_close($conn);

    echo json_encode($results_json);

?>