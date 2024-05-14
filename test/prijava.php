<!DOCTYPE html>
<html lang="hr">
<head>
<title>Škartoc ljubavi</title>
  <meta charset="UTF-8">
  <meta name="description" content="Škartoc ljubavi - Prvi street food truck u Međimurju koji pruža ukusne burgere i gastronomska iskustva. Posjetite nas i uživajte u vrhunskim jelima.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script defer src="js/bootstrap.bundle.min.js"></script>
  <link rel="icon" href="slike/lgo2.svg" type="image/icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="keywords" content="Škartoc ljubavi,Škartoc Ljubavi, Ljubav, Škartoc, street food, Međimurje, burgeri, gastronomija, food truck, catering, catering u Međimurju, firme, pričesti, ketering, hrana, privatne zabave, ljubav, vjenčanja, street food Međimurje, mobilni catering, gourmet hrana, festivali, događaji, team building, događaj organizacija, Škartoc ljubavi, street food Međimurje, kako naručiti catering, događaj organizacija Međimurje, cijene cateringa, Škartoc ljubavi menu, gdje pronaći Škartoc ljubavi, street food truck najam, catering za zabave, catering za 500 ljudi, catering za događaje, catering za vjenčanja, hrana za firme, street food catering, najam food trucka za evente, gourmet burgeri, street food festivali, catering usluge Međimurje, najam food trucka za zabave, hrana za privatne evente, ketering, krstitke hrana, kvalitetna hrana, premium burgeri, prilagođeni meni, vege hrana ">
  <meta name="author" content="Ivica Šipuš">
  <meta name="robots" content="index, follow">


</head>
<body>
    
</body>
</html>
<?php
include "spajanje.php"; // Uključi datoteku za spajanje na bazu podataka
include "nav.php"; // Uključi navigacijski izbornik

// Provjeri je li korisnik već prijavljen
if (isset($_SESSION['korisnicko_ime'])) {
  // Ako je korisnik već prijavljen, preusmjeri ga na početnu stranicu
  header("Location: profil.php");
} else {
  
  ?>
  <br>
  <br>
  <br>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card bg-dark text-white">
          <div class="card-body">
            <h2 class="text-center" style="font-family: 'Lobster', cursive;">Prijava</h2>
            <form action="akcije.php" method="get">
              <div class="mb-3">
                <label for="korisnicko_ime" class="form-label">Korisničko ime</label>
                <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" required>
                </div>
                <div class="mb-3">
                  <label for="lozinka" class="form-label">Lozinka</label>
                  <input type="password" class="form-control" id="lozinka" name="lozinka" required>
                </div>
                <button type="submit" class="btn btn-primary">Prijavi se</button>
            </form>
        </div>
    </div>
</div> 
<?php
}
?>
<script>

if (document.cookie) {

  var cookies = document.cookie.split(';');

  cookies.forEach(function(cookie) {
    
    var parts = cookie.split('=');
    var name = parts[0].trim();
    var value = parts[1];
   
    if (name === 'korisnicko_ime') {
      document.getElementById('korisnicko_ime').value = value;
    }
    
  });
}
</script>
</body>
</html>
