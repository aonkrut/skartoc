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

    // HTML header
    echo '<div class="container mt-5">';
    echo '<h2 class="d-inline">Popis jelovnika</h2>';?>
    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#dodajJelovnikModal">
            Dodaj jelovnik
        </button>

        <!-- Modal -->
        <div class="modal fade" id="dodajJelovnikModal" tabindex="-1" aria-labelledby="dodajJelovnikModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dodajJelovnikModalLabel">Dodaj novi jelovnik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Forma za dodavanje jelovnika -->
                        <form action="dodaj_jelovnik.php" method="POST">
                            <div class="mb-3">
                                <label for="naziv" class="form-label">Naziv</label>
                                <input type="text" class="form-control" id="naziv" name="naziv" required>
                            </div>
                            <div class="mb-3">
                                <label for="event" class="form-label">Event</label>
                                <input type="text" class="form-control" id="event" name="event" required>
                            </div>
                            <div class="mb-3">
                                <label for="mjesto" class="form-label">Mjesto</label>
                                <input type="text" class="form-control" id="mjesto" name="mjesto" required>
                            </div>
                            <div class="mb-3">
                                <label for="koridnate" class="form-label">Koordinate</label>
                                <input type="text" class="form-control" id="koridnate" name="koridnate" required>
                            </div>
                            <div class="mb-3">
                                <label for="datum_start" class="form-label">Datum početka</label>
                                <input type="date" class="form-control" id="datum_start" name="datum_start" required>
                            </div>
                            <div class="mb-3">
                                <label for="datum_kraj" class="form-label">Datum završetka</label>
                                <input type="date" class="form-control" id="datum_kraj" name="datum_kraj" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Spremi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php
   // echo '<a href="dodaj_jelovnik.php" class="btn btn-primary m-3">Dodaj jelovnik</a>';
   
    // Forma za pretraživanje jelovnika po nazivu
    echo '<form action="" method="GET" class="mb-3">';
    echo '<div class="input-group">';
    echo '<input type="text" class="form-control" placeholder="Pretraži jelovnike..." name="search">';
    echo '<button class="btn btn-outline-secondary" type="submit">Pretraži</button>';
    echo '</div>';
    echo '</form>';

    // Popis jelovnika
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Naziv</th>';
    echo '<th>Event</th>';
    echo '<th>Opcije</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // SQL upit za dohvaćanje jelovnika iz baze
    $sql = "SELECT * FROM jelovnik";

    // Ako je poslan upit pretraživanja po nazivu
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql .= " WHERE naziv LIKE '%$search%'";
    }

    $result = $conn->query($sql);

    // Provjera jesu li pronađeni jelovnici
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['naziv'] . '</td>';
            echo '<td>' . $row['Event'] . '</td>';
            echo '<td>';
            echo '<a href="pregled_jelovnici.php?id=' . $row['id'] . '" class="btn btn-primary">Uredi</a>';
            echo ' ';
            echo '<form action="postavi_aktivnost.php" method="post" style="display:inline;">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            
            if ($row['aktivan'] == 1) {
                echo '<button type="submit" class="btn btn-success">Aktivan</button>';
            } else {
                echo '<button type="submit" class="btn btn-warning">Neaktivan</button>';
            }
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="3">Nema dostupnih jelovnika.</td></tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    ?>
</body>
</html>