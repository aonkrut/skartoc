<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Škartoc ljubavi</title>
    <meta charset="UTF-8">
    <meta name="description"
        content="Škartoc ljubavi - Prvi street food truck u Međimurju koji pruža ukusne burgere i gastronomska iskustva. Posjetite nas i uživajte u vrhunskim jelima.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="slike/lgo2.svg" type="image/icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="keywords"
        content="Škartoc ljubavi,Škartoc Ljubavi, Ljubav, Škartoc, street food, Međimurje, burgeri, gastronomija, food truck, catering, catering u Međimurju, firme, pričesti, ketering, hrana, privatne zabave, ljubav, vjenčanja, street food Međimurje, mobilni catering, gourmet hrana, festivali, događaji, team building, događaj organizacija, Škartoc ljubavi, street food Međimurje, kako naručiti catering, događaj organizacija Međimurje, cijene cateringa, Škartoc ljubavi menu, gdje pronaći Škartoc ljubavi, street food truck najam, catering za zabave, catering za 500 ljudi, catering za događaje, catering za vjenčanja, hrana za firme, street food catering, najam food trucka za evente, gourmet burgeri, street food festivali, catering usluge Međimurje, najam food trucka za zabave, hrana za privatne evente, ketering, krstitke hrana, kvalitetna hrana, premium burgeri, prilagođeni meni, vege hrana ">
    <meta name="author" content="Ivica Šipuš">
    <meta name="robots" content="index, follow">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        /* Stilovi za kontejner koji će sadržavati formu s informacijama o jelovniku i ponude */
.container {
    display: flex; /* Koristimo Flexbox */
    justify-content: space-between; /* Poravnanje elemenata s lijeve i desne strane */
}

/* Stilovi za formu s informacijama o jelovniku */
.container form:first-child {
    flex-basis: 60%; /* Postavljanje širine na 45% kako bi se formi s informacijama o jelovniku dala više prostora */
}

/* Stilovi za formu s ponudama */
.container form:last-child {
    flex-basis: 45%; /* Postavljanje širine na 45% kako bi se formi s ponudama dala više prostora */
}

    </style>
</head>
<body>
<?php
    // Uključivanje datoteke za spajanje na bazu i navigacijskog izbornika
    include "spajanje.php";
    include "nav.php";

    // Provjera sesije, ako korisnik nije prijavljen, preusmjeri na početnu stranicu
    session_start();
    if (!isset($_SESSION['korisnicko_ime'])) {
        header("Location: index.php");
        exit();
    }

    // Provjeri je li poslan ID jelovnika
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo '<div class="container mt-5">';
        echo '<p class="text-danger">Nije pronađen ID jelovnika.</p>';
        echo '</div>';
        exit();
    }

    $jelovnik_id = $_GET['id'];

    // SQL upit za dohvaćanje podataka o jelovniku
    $sql_jelovnik = "SELECT * FROM jelovnik WHERE id = $jelovnik_id";
    $result_jelovnik = $conn->query($sql_jelovnik);

    // Provjera postoji li jelovnik s tim ID-om
    if ($result_jelovnik->num_rows == 0) {
        echo '<div class="container mt-5">';
        echo '<p class="text-danger">Nije pronađen jelovnik s ID-om ' . $jelovnik_id . '.</p>';
        echo '</div>';
        exit();
    }

    $row_jelovnik = $result_jelovnik->fetch_assoc();
    ?>
<h2 class="m-1" style='font-family: "Lobster", cursive; '> Pregled jelovnika: <?php echo $row_jelovnik['naziv']; ?></h2>
<br>
   
    <h3>Pregled osnovnih informacijama</h3>
        <!-- Forma za uređivanje podataka o jelovniku--> 
        <div class="container m-3">
        <form action="uredi_jelovnik.php?id=<?php echo $jelovnik_id; ?>" method="post">
        
        <input type="hidden" name="id" value="<?php echo $jelovnik_id; ?>">
            <div class="mb-3">
                <label for="naziv" class="form-label">Naziv</label>
                <input type="text" class="form-control" id="naziv" name="naziv" value="<?php echo $row_jelovnik['naziv']; ?>">
            </div>
            <div class="mb-3">
                <label for="event" class="form-label">Event</label>
                <input type="text" class="form-control" id="event" name="event" value="<?php echo $row_jelovnik['Event']; ?>">
            </div>
            <div class="mb-3">
                <label for="mjesto" class="form-label">Mjesto</label>
                <input type="text" class="form-control" id="mjesto" name="mjesto" value="<?php echo $row_jelovnik['mjesto']; ?>">
            </div>
            <div class="mb-3">
                <label for="koridnate" class="form-label">Koridnate</label>
                <input type="text" class="form-control" id="koridnate" name="koridnate" value="<?php echo $row_jelovnik['koridnate']; ?>">
            </div>
            <div class="mb-3">
                <label for="datum_start" class="form-label">Datum početka</label>
                <input type="date" class="form-control" id="datum_start" name="datum_start" value="<?php echo $row_jelovnik['datum_start']; ?>">
            </div>
            <div class="mb-3">
                <label for="datum_kraj" class="form-label">Datum završetka</label>
                <input type="date" class="form-control" id="datum_kraj" name="datum_kraj" value="<?php echo $row_jelovnik['datum_kraj']; ?>">
            </div>
            <div class="mb-3">
                <label for="aktivan" class="form-label">Aktivan</label>
                <select class="form-select" id="aktivan" name="aktivan">
                    <option value="1" <?php if ($row_jelovnik['aktivan'] == 1) echo 'selected'; ?>>Da</option>
                    <option value="0" <?php if ($row_jelovnik['aktivan'] == 0) echo 'selected'; ?>>Ne</option>
                </select>
            </div>



            <button type="submit" class="btn btn-primary">Spremi promjene</button>
        </form>

        <hr>
        <div class="m-3">
        <h3>Dodaj novu ponudu</h3>
        
        <form id="dodajPonuduForma" method="post">
            <input type="hidden" name="jelovnik_id" value="<?php echo $jelovnik_id; ?>">
            <div class="mb-3">
                <label for="ponuda_id" class="form-label">Odaberi ponudu</label>
                <select class="form-select" id="ponuda_id" name="ponuda_id">
                    <?php
                    // SQL upit za dohvaćanje svih ponuda
                    $sql_sve_ponude = "SELECT * FROM ponuda";
                    $result_sve_ponude = $conn->query($sql_sve_ponude);

                    if ($result_sve_ponude->num_rows > 0) {
                        while ($row_sve_ponude = $result_sve_ponude->fetch_assoc()) {
                            echo '<option value="' . $row_sve_ponude['id'] . '">' . $row_sve_ponude['naziv'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nema dostupnih ponuda</option>';
                    }
                    ?>
                </select>
            </div>
          
            <!-- Dodajte ostala polja za dodavanje nove ponude -->

            <button type="button" class="btn btn-primary" onclick="dodajPonudu()">Dodaj ponudu</button>
        </form>
        <!-- Prikaz pridruženih ponuda -->
        <h3>Pridružene ponude</h3>
        <ul class="list-group" id="ponudeLista">
            <?php
            // SQL upit za dohvaćanje pridruženih ponuda
            $sql_ponude = "SELECT ponuda.* FROM ponuda INNER JOIN spoj ON ponuda.id = spoj.ponuda_id WHERE spoj.jelovnik_id = $jelovnik_id";
            $result_ponude = $conn->query($sql_ponude);

            if ($result_ponude->num_rows > 0) {
                while ($row_ponuda = $result_ponude->fetch_assoc()) {
            ?>
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <img src="<?php echo $row_ponuda['slika_putanja']; ?>" alt="Slika ponude" class="img-thumbnail" style="width: 100px; width:160px;" >
                            </div>
                            <div class="col-md-6" id="naziv_<?php echo $row_ponuda['id']; ?>">
                                <p><?php echo $row_ponuda['naziv']; ?></p>
                                <p><?php echo $row_ponuda['sastojci_hrv']; ?></p>
                                <p><?php echo $row_ponuda['sastojci_eng'];?></p>
                            </div>
                            <div class="col-md-3">
                                <!-- Dodajte gumb za uklanjanje ponude -->
                                <button class="btn btn-danger" onclick="ukloniPonudu(<?php echo $row_ponuda['id']; ?>)">Ukloni</button>
                            </div>
                        </div>
                    </li>
            <?php
                }
            } else {
                echo "Nema dostupnih ponuda.";
            }
            ?>
        </ul>

        <hr>
        </div> 


        
    <script>
        // JavaScript funkcija za uklanjanje ponude
        function ukloniPonudu(ponuda_id) {
            // Slanje AJAX zahtjeva za uklanjanje ponude
            $.ajax({
                type: "POST",
                url: "ukloni_ponudu_iz_spoja.php",
                data: {
                    jelovnik_id: <?php echo $jelovnik_id; ?>,
                    ponuda_id: ponuda_id
                },
                success: function(response) {
                    // Ažuriranje HTML-a nakon uspješnog uklanjanja ponude
                    $('#naziv_' + ponuda_id).parent().parent().remove();
                },
                error: function(xhr, status, error) {
                    // Prikaz poruke u slučaju greške
                    alert("Greška prilikom uklanjanja ponude: " + xhr.responseText);
                }
            });
        }

        function dodajPonudu() {
        var jelovnik_id = <?php echo $jelovnik_id; ?>;
        var ponuda_id = $('#ponuda_id').val();

        // Slanje AJAX zahtjeva za dodavanje ponude u spoj
        $.ajax({
            type: "POST",
            url: "dodaj_ponudu_u_spoj.php",
            data: {
                jelovnik_id: jelovnik_id,
                ponuda_id: ponuda_id
            },
            success: function(response) {
                // Ažuriranje HTML-a nakon uspješnog dodavanja ponude u spoj
                if (response.message!=undefined){
                alert(response.message); }
                else {
                    alert("Ponuda je uspješno dodana u spoj.");
                }
                // Osvježi stranicu da bi se prikazale promjene
                location.reload();
            },
            error: function(xhr, status, error) {
                // Prikaz poruke u slučaju greške
                alert("Greška prilikom dodavanja ponude u spoj: " + xhr.responseText);
            }
        });
    }
    </script>

</body>
</html>