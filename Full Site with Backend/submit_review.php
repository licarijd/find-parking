<?php
if (!isset($_POST["rating"]) || ($_POST["rating"] === "")) {
    echo json_encode(array("status" => false, "message" => "No rating provided"));
} else {
    echo json_encode(array("status" => true, "rating" => htmlspecialchars($_POST["rating"]), "review" => htmlspecialchars($_POST["review"])));
}
?>