<?php session_start();?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" aria-label="Fourth navbar example">
    <div class="container-fluid">
    <h1 class="d-flex align-items-center fs-4 text-white mb-0">
      <a href="index.php"><img src="slike/lgo1.svg" width="38" height="30" class="me-3" alt="Škartoc"></a>
    </h1>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php" style="font-family: 'Raleway', cursive;" >Početna</a>
          </li>
          <?php 
            include "spajanje.php";
            $sql = "SELECT * FROM jelovnik where aktivan = '1'";  
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              ?>
               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" aria-current="page" href="#" style="font-family: 'Raleway', cursive;" data-bs-toggle="dropdown" aria-expanded="true" >Jelovnici</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown01">
                  <?php
                  while ($row = $result->fetch_assoc()) {
                    $naziv = $row["naziv"];
                    $mjesto = $row["mjesto"];
                    $id = $row["id"];
                    echo "<li><a class='dropdown-item' href='jelovnik.php?id=$id'>$naziv, $mjesto</a></li>";
                  }?>
                </ul>
              </li>

              
             <?php
            
            }

          ?>
       
          <?php  
          
          if (isset($_SESSION['korisnicko_ime'])) {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" aria-current="page" href="#" style="font-family: 'Raleway', cursive;" data-bs-toggle="dropdown" aria-expanded="false" >Admin</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown01">
                  <li><a class="dropdown-item" href="ponude.php">Jela</a></li>
                  <li><a class="dropdown-item" href="jelovnici.php">Jelovnici</a></li>
                </ul>
              </li>
            <li class="nav-item">
              <a class="nav-link " href="odjava.php" style="font-family: 'Raleway', cursive; ">Odjava</a>
            </li>
            <?php
          } else{
          ?>
          
          <li class="nav-item">
            <a class="nav-link" href="prijava.php" style="font-family:'Raleway', cursive">Prijava</a>

          </li>
          <?php
          }?>
    
        </ul>
      </div>
    </div>
  </nav>