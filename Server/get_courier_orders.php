<?php
$response = array();

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $db = mysqli_connect('', '', '', '');

    $result = mysqli_query($db, "SELECT * FROM orders WHERE `courier_id` = '$id' OR `courier_id` = '-1' ORDER BY `courier_id` DESC");

    if (!empty($result)) {
    	if(mysqli_num_rows($result) > 0) {
    		$response["orders"] = array();
    		while($row = mysqli_fetch_array($result)) {
    			$order = array();
    			$order["id"] = $row["id"];
    			$order["customer"] = $row["customer"];
    			$order["price"] = $row["price"];
    			$order["status"] = $row["status"];
    			$order["address2"] = $row["address"];
    			array_push($response["orders"], $order);
    		}
		$response["success"] = 1;

		echo json_encode($response);
        } else {
        	$response["success"] = 0;
		$response["message"] = "Orders not found";

		echo json_encode($response);
        }
    } else {
        $response["success"] = 0;
        $response["message"] = "Orders not found";

        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    echo json_encode($response);
}
?>
