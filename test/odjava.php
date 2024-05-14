<?php
// Provjera je li korisnik prijavljen ako nije preusmjeri ga na prijavu ako jeje uništi sesiju i kolačiče sve osim korisničkog imena i preusmjeri ga na prijavu
session_start();
if (!isset($_SESSION['korisnicko_ime'])) {
    header("Location: prijava.php");
    exit();
} else {
    session_unset();
    session_destroy();
    setcookie("korisnicko_ime", "", time() - 3600, "/");
    header("Location: prijava.php");
    exit();
}
?>