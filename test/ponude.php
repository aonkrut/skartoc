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
    include "spajanje.php";
    include "nav.php";
    session_start();
    if (isset($_SESSION['korisnicko_ime'])) {
        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dodaj novu ponudu/jelo</h5>
                            <form id="dodajForma" action="dodaj_novo.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="naziv" class="form-label">Naziv</label>
                                    <input type="text" class="form-control" id="naziv" name="naziv" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sastojci_hrv" class="form-label">Sastojci na hrvatskom</label>
                                    <input type="text" class="form-control" id="sastojci_hrv" name="sastojci_hrv" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sastojci_eng" class="form-label">Sastojci na engleskom</label>
                                    <input type="text" class="form-control" id="sastojci_eng" name="sastojci_eng" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slika_putanja" class="form-label">Slika</label>
                                    <input type="file" name="slika" class="form-control" id="slika" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Dodaj ponudu</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ponude jela</h5>
                            <ul class="list-group" id="ponudeLista">
                                <?php
                                $sql = "SELECT * FROM ponuda";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <img src="<?php echo $row['slika_putanja']; ?>" alt="Slika ponude"
                                                        class="img-thumbnail">
                                                </div>
                                                <div class="col-md-6" id="naziv_<?php echo $row['id']; ?>">
                                                    <?php echo $row['naziv']; ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-sm btn-primary"
                                                        onclick="openEditModal(<?php echo $row['id']; ?>)">Uredi</button>
                                                        <a href="#" class="btn btn-sm btn-danger" onclick="potvrdaBrisnja(<?php echo $row['id']; ?>)">Obriši</a>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal za uređivanje ponude -->
        <div class="modal fade" id="urediModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Uredi ponudu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="urediForma" action="uredi.php" method="post">
                            <!-- Dodaj skriveni input za ID ponude -->
                            <input type="hidden" id="idPonude" name="id">
                            <div class="mb-3">
                                <label for="naziv" class="form-label">Naziv</label>
                                <input type="text" class="form-control" id="nazivPonude" name="naziv" required>
                            </div>
                            <div class="mb-3">
                                <label for="sastojci_hrv" class="form-label">Sastojci na hrvatskom</label>
                                <input type="text" class="form-control" id="sastojci_hrvPonude" name="sastojci_hrv"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="sastojci_eng" class="form-label">Sastojci na engleskom</label>
                                <input type="text" class="form-control" id="sastojci_engPonude" name="sastojci_eng"
                                    required>
                            </div>
                            <!-- Slika se ne može uređivati u ovom modalu -->
                            <button type="submit" class="btn btn-primary">Spremi promjene</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        header("Location: index.php");
    }
    ?>


    <script>
        function openEditModal(id) {

            var xmlhttp = new XMLHttpRequest();


            xmlhttp.onreadystatechange = function () {

                if (xmlhttp.readyState == XMLHttpRequest.DONE) {

                    if (xmlhttp.status == 200) {

                        var response = JSON.parse(xmlhttp.responseText);

                        document.getElementById("idPonude").value = response.id;
                        document.getElementById("nazivPonude").value = response.naziv;
                        document.getElementById("sastojci_hrvPonude").value = response.sastojci_hrv;
                        document.getElementById("sastojci_engPonude").value = response.sastojci_eng;

                        $('#urediModal').modal('show');
                    } else {

                        alert("Greška prilikom dohvaćanja podataka: " + xmlhttp.statusText);
                    }
                }
            };


            xmlhttp.open("GET", "dohvati_ponudu.php?id=" + id, true);


            xmlhttp.send();
        }

    

        // AJAX zahtjev za ažuriranje ponude
        $('#urediForma').submit(function (event) {
            event.preventDefault();

            // Podaci iz forme
            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "uredi.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    // Prikazi poruku o uspješnosti
                    alert(response.message);
                    // Preusmjeri korisnika natrag na stranicu ponuda.php
                    window.location.href = "ponude.php";
                },
                error: function (xhr, status, error) {
                    // U slučaju greške, prikaži odgovarajuću poruku
                    alert("Greška prilikom ažuriranja ponude: " + xhr.responseText);
                }
            });
        });
    
        function potvrdaBrisnja(id) {
    var result = confirm("Jeste li sigurni da želite izbrisati ovu ponudu?");
    if (result) {
        document.querySelector('.btn-danger').disabled = true;

        var timeLeft = 5; 
        var timer = setInterval(function() {
            timeLeft--;
            if (timeLeft <= 0) {
                clearInterval(timer);
                document.querySelector('.btn-danger').disabled = false;
            }
        }, 1000); 

        setTimeout(function() {
            window.location.href = "brisi.php?id=" + id + "&action=obrisi_ponudu";
        }, 2000);
    }
}

    
</script>

</body>

</html>