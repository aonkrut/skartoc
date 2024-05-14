<!DOCTYPE html>
<html lang="hr">

<head>
  <title>Škartoc ljubavi</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script defer src="js/bootstrap.bundle.min.js"></script>
  <link rel="icon" href="slike/lgo2.svg" type="image/icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="keywords"
    content="Škartoc ljubavi,Škartoc Ljubavi, Ljubav, Škartoc, street food, Međimurje, burgeri, gastronomija, food truck, catering, catering u Međimurju, firme, pričesti, ketering, hrana, privatne zabave, ljubav, vjenčanja, street food Međimurje, mobilni catering, gourmet hrana, festivali, događaji, team building, događaj organizacija, Škartoc ljubavi, street food Međimurje, kako naručiti catering, događaj organizacija Međimurje, cijene cateringa, Škartoc ljubavi menu, gdje pronaći Škartoc ljubavi, street food truck najam, catering za zabave, catering za 500 ljudi, catering za događaje, catering za vjenčanja, hrana za firme, street food catering, najam food trucka za evente, gourmet burgeri, street food festivali, catering usluge Međimurje, najam food trucka za zabave, hrana za privatne evente, ketering, krstitke hrana, kvalitetna hrana, premium burgeri, prilagođeni meni, vege hrana ">
  <meta name="author" content="Ivica Šipuš">
  <meta name="robots" content="index, follow">
  <style>
    .bgimg-2 {
      background-image: url('slike/jel_poz.jpg');
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      min-height: 100%;
    }
    .bgimg-3 {
      background-image: url('slike/brgfst241.png');
      background-size: cover;
      background-attachment: fixed;
      background-position: center bottom; 
      min-height: 100%;
    }

    .jelovnik {
      background-color: #FFA917;
    }

    .jel-naslov {
      font-family: 'Lobster', cursive;
    }

    .jel_wh {
      font-family: 'Raleway', cursive;
    }
  </style>
</head>

<body>

  <?php include "nav.php"; ?>
  <!-- Meni -->
  <br>
  <br>
  <div class="bgimg-2">
  
  <?php
    include "spajanje.php"; // Uključi datoteku za spajanje na bazu podataka

    // Dohvati ID jelovnika iz URL-a
    if (!isset($_GET['id'])) {
      $jelovnik_id=0;
    }else{
      $jelovnik_id = $_GET['id'];
    }

    // Upit za dohvaćanje informacija o jelovniku
    $sql_jelovnik = "SELECT * FROM jelovnik WHERE id = $jelovnik_id";
    $result_jelovnik = $conn->query($sql_jelovnik);

    // Provjeri ima li rezultata za jelovnik
    if ($result_jelovnik->num_rows > 0) {
      // Prolazak kroz rezultate i prikaz informacija o jelovniku
      while ($row_jelovnik = $result_jelovnik->fetch_assoc()) {
        $naziv_jelovnika = $row_jelovnik["naziv"];
        $event_jelovnika= $row_jelovnik["Event"];
        $mjesto_jelovnika = $row_jelovnik["mjesto"];
        $datum_start = $row_jelovnik["datum_start"];
        $datum_kraj = $row_jelovnik["datum_kraj"];
        $koridnate = $row_jelovnik["koridnate"];
      }
    } else {
      $naziv_jelovnika = "Nešto je pošlo po krivu!";
      $mjesto_jelovnika = "Pokušajte se vratiti na početnu stranicu!";
      $datum_start = "";
      $datum_kraj = "";
      $koridnate = "index.php";
    }
  ?>
     
  <div class='container-fluid bgimg-3' style="position: relative;" id='jelovnik'>
    <br><h2 class='text-center jel-naslov' loading='auto' style='font-family: "Lobster", cursive; color: #FFA917; '><?php echo "$naziv_jelovnika"; ?></h2>
    <h4 class='text-center jel-wh w3-large text-white' loading='auto' style='font-family: "Raleway", cursive; color: #FFA917; '><?php echo "$event_jelovnika";?></h4>
    <p class='text-center jel_wh w3-large text-white' loading='auto'><?php echo "$mjesto_jelovnika, $datum_start - $datum_kraj"; ?></p>
    <p class='text-center'><a class='text-center jel_wh w3-large text-white' loading='auto' href='<?php echo "$koridnate"; ?>'>Posjeti nas!</a></p>
    <br>
  </div>

  <?php
    include "spajanje.php";
    
    $sql = "SELECT ponuda_id FROM spoj where jelovnik_id = '$jelovnik_id'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<div class='row justify-content-center mt-5 m-auto' loading='auto'>";
      while ($row = $result->fetch_assoc()) {
        $ponuda_id = $row["ponuda_id"];
        $sql3 = "SELECT * FROM ponuda where id = '$ponuda_id'";
        $result2 = $conn->query($sql3);
        
        if ($result2->num_rows > 0) {
          
          while ($row = $result2->fetch_assoc()) {
            $id = $row["id"];
            $naziv = $row["naziv"];
            $sastojci_hrv = $row["sastojci_hrv"];
            $sastojci_eng = $row["sastojci_eng"];
            $slika_putanja = $row["slika_putanja"];
            echo "<div class='col-lg-3 col-md-6 mb-4'>";
            echo "<div class='card bg-dark text-white'>";
            echo "<img src='$slika_putanja' alt='$naziv' class='card-img-top' style='width: 100%; height: 45%;' loading='auto'>";
            echo "<div class='card-body'>";
            echo "<h3 class='card-title ' style='color: #FFA917;'><b>$naziv</b></h3>";
            echo "<p class='card-text text-white'>$sastojci_hrv</p>";
            echo "<p class='card-text text-white'>$sastojci_eng</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "";
        }
      }
      echo "</div>"; // Zatvaranje reda nakon što se iscrpe ponude
    }
  ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
