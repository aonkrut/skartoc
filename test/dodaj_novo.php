<?php

include "spajanje.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naziv = $_POST['naziv'];
    $sastojci_hrv = $_POST['sastojci_hrv'];
    $sastojci_eng = $_POST['sastojci_eng'];

    // Provjera da li je datoteka poslana
    if (isset($_FILES["slika"]) && $_FILES["slika"]["error"] == 0) {
        $target_dir = "slike/jelovnik/";
        $target_file = $target_dir . basename($_FILES["slika"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $slika_putanja = $target_file;

        // Provjera da li je datoteka slika
        $check = getimagesize($_FILES["slika"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Datoteka nije slika.";
            $uploadOk = 0;
        }

        // Provjera veličine datoteke
        if ($_FILES["slika"]["size"] > 500000) {
            echo "Datoteka je prevelika.";
            $uploadOk = 0;
        }



        // Spremanje datoteke
        if ($uploadOk == 0) {
            echo "Greška prilikom spremanja datoteke.";
        } else {
            if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
                // Slika uspješno spremljena, sada možete izvršiti upit za spremanje podataka u bazu podataka
                $sql = "INSERT INTO ponuda (naziv, sastojci_hrv, sastojci_eng, slika_putanja) VALUES ('$naziv', '$sastojci_hrv', '$sastojci_eng', '$slika_putanja')";
                if ($conn->query($sql) === TRUE) {
                    echo "Uspješno dodana nova ponuda.";
                    header("Location: ponude.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Greška prilikom spremanja datoteke.";
            }
        }
    } else {
        echo "Nije poslana slika.";
    }

    $conn->close();
}

?>