<?php
include "spajanje.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM ponuda WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Pretvorite rezultat u asocijativni niz i vratite ga kao JSON
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
       
        echo json_encode(array('error' => 'Ponuda nije pronađena'));
    }
} else {
    
    echo json_encode(array('error' => 'ID ponude nije priložen'));
}
?>