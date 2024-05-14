<?php
include "spajanje.php"; 


if(isset($_GET['action'])) {
    $action = $_GET['action'];

    
    if($action === 'obrisi_ponudu') {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $sql = "DELETE FROM ponuda WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "Ponuda uspješno obrisana.";
                header("Location: ponude.php"); 
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Nije dostavljen ID ponude za brisanje.";
        }
    }
    else if($action === 'obrisi_jelovnik') {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $sql = "DELETE FROM jelovnik WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "Ponuda uspješno obrisana.";
                header("Location: jelovnici.php"); 
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Nije dostavljen ID ponude za brisanje.";
        }
    }
}

$conn->close();
?>
