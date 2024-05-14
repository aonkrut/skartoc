<?php
include "spajanje.php"; 
$korisnicko_ime = $_GET['korisnicko_ime'];
$lozinka = $_GET['lozinka'];
session_start();
$sql = "SELECT * FROM korisnici WHERE korisnicko_ime = '$korisnicko_ime' AND lozinka = '$lozinka'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $_SESSION['korisnicko_ime'] = $row['korisnicko_ime'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['ime'] = $row['ime'];
        $_SESSION['prezime'] = $row['prezime'];
        $_SESSION['email'] = $row['email'];

        $id = $row['id'];
        $ime = $row['ime'];
        $prezime = $row['prezime'];
        $email = $row['email'];
        $korisnicko_ime = $row['korisnicko_ime'];

        echo "<script>
        document.cookie = 'ime=$ime';
        document.cookie = 'prezime=$prezime';
        document.cookie = 'email=$email';
        document.cookie = 'korisnicko_ime=$korisnicko_ime';
        document.cookie = 'id=$id';
        </script>";
    }
    header("Location: profil.php?id=$id");
    } else {
    echo "Pogrešno korisničko ime ili lozinka";
    header("Location: prijava.php");
    }

?>