<?php
// Uključi datoteku za spajanje na bazu podataka
include "spajanje.php";

// Inicijaliziraj praznu varijablu za odgovor
$response = array();

// Provjeri je li zahtjev poslan metodom POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Provjeri je li poslan ID ponude
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

        // Provjeri postojanje ostalih polja
        if (isset($_POST['naziv']) && isset($_POST['sastojci_hrv']) && isset($_POST['sastojci_eng'])) {
            $naziv = $_POST['naziv'];
            $sastojci_hrv = $_POST['sastojci_hrv'];
            $sastojci_eng = $_POST['sastojci_eng'];

            // Pripremi SQL upit za ažuriranje podataka
            $sql = "UPDATE ponuda SET naziv = '$naziv', sastojci_hrv = '$sastojci_hrv', sastojci_eng = '$sastojci_eng' WHERE id = $id";

            // Izvrši SQL upit
            if ($conn->query($sql) === TRUE) {
                $response['status'] = "success";
                $response['message'] = "Ponuda je uspješno ažurirana.";
            } else {
                $response['status'] = "error";
                $response['message'] = "Greška prilikom ažuriranja ponude: " . $conn->error;
            }
        } else {
            $response['status'] = "error";
            $response['message'] = "Nisu dostavljeni svi potrebni podaci.";
        }
    } else {
        $response['status'] = "error";
        $response['message'] = "Nije dostavljen ID ponude.";
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Nevažeći HTTP zahtjev.";
}

// Zatvori konekciju s bazom podataka
$conn->close();

// Vrati odgovor u JSON formatu
echo json_encode($response);
?>