<?php
    session_start();

    require_once 'connect.php';

    $product = mysqli_query($connect, "SELECT * FROM `towary` WHERE `kierunek` IS NULL");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie</title>
    <link rel="stylesheet" href="dsn.css">

    <style>
    a {
      text-decoration: none;
      color: #fff
    }
</style>
</head>
<body>
    <header>
        <h1></h1>
        <nav>
            <ul>
                <li><a href="#">=</a></li>
            </ul>
        </nav>
  </header>

  <div class="window"> 1
    <div class="options">
      <select id="language">
        <option value="pl">PL</option>
        <option value="en">EN</option>
        <!-- Add more language options as needed -->
      </select>
    </div>
    <h1>Zarządzanie:</h1>
    <div class="content">
      <div class="window-container">
        <div class="left-window">
          <h1>Towar:</h1>
          <form action="addproduct.php" method="post" >
            <label for="title" style=" font-family: cursive;">Nazwa towaru:</label>
            <input type="text" id="title" name="title" placeholder="Wpisz tu nazwa towaru" required
            oninvalid="this.setCustomValidity('Proszę wpisać tytuł towaru!')"
            oninput="this.setCustomValidity('')">
          
            <div id="imageContainer">
              <p id="chooseText" style=" font-family: cursive;">Wybierz zdjęcie:</p> 
              <button type="button" id="chooseButton" onclick="chooseImage()">wybierz zdj.</button>
              <img id="preview" name="image" src="#" alt="Preview" style="display: none;">
            </div>
            <img id="preview" src="#" name="image" alt="Preview" style="display: none;">

            <label for="description" style="font-family: cursive;">Opis towaru:</label>
            <textarea name="description" id='dsc' placeholder="Tu opisz swój towar" style="border: 1px solid black" required
            oninvalid="this.setCustomValidity('Proszę opisać swój towar!')"
            oninput="this.setCustomValidity('')"></textarea>

            <div class="form-row">
              <div class="left-column">
                <label for="ilosc">Ilość:</label>
                <input type="number" id="ilosc" placeholder="Wprowadź ilość" min=1  name="ilosc" required
                oninvalid="this.setCustomValidity('Proszę wpisać ilość!')"
                oninput="this.setCustomValidity('')">
              </div>

              <span class="separator">|</span>

              <div class="right-column">
                <label for="cena">Cena:</label>
                <input type="number" id="cena" placeholder="Wprowadź cena" name="cena" min=1 required
                oninvalid="this.setCustomValidity('Proszę wpisać cena!')"
                oninput="this.setCustomValidity('')">
              </div>
            </div>

            <div class="buttons">
              <button  class="clear-button" style="border: 1px solid black; background:grey; color: #fff; font-size:20px" onclick="clearInputs()">Wyczyść</button>
              <button class="add-button" id="dodaj-form" style="border: 1px solid black; background:grey; color: #fff;font-size:20px">Dodaj</button>
            </div>
          </form>

          <br>
          <div class="opcja" style="border-top: 1px solid black;">
          <h1 style="border-bottom:none">[Opcje wskazania datę opłaty produktu <br>- <br><br> przepraszamy w tej chwili ta opcja jest nieaktualna]</h1>
          </div>
        </div>
        <div class="right-window">
          <h1>Zmiana stanu towaru:</h1>
          <div class="form-row">
            
          </div>

          <div class="form-row row">
            <?php 
              while($pt = mysqli_fetch_assoc($product)){ 
              ?>
              <br>
              <div class="column">
                <label class="text-label"><?=$pt['tytul'] ?></label>
              </div>
              <div class="column">
                <button class="button"style=" background: green; color: #fff; text-decoration:none"><a href="agree.php?id=<?= $pt['ID'] ?>">V</a></button>
              </div>
              <div class="column">
                <button class="button" style="background: red; color: #fff"><a href="denied.php?id=<?= $pt['ID']  ?>">-</a></button>
              </div>
              <br>
              <?php } ?>
          </div>
        </div>

        
        </div>
      </div>
  </div> 

</body>
<script>
function chooseImage() {
  var fileInput = document.createElement('input');
  fileInput.type = 'file';
  fileInput.accept = '.jpg';
  fileInput.onchange = previewImage;
  fileInput.click();
}

function previewImage(event) {
  var file = event.target.files[0];
  var reader = new FileReader();

  reader.onload = function(e) {
    var imgElement = document.getElementById('preview');
    imgElement.src = e.target.result;
    imgElement.style.display = 'inline';
  };

  reader.readAsDataURL(file);
}

//----------

function clearInputs() {
  document.getElementById('ilosc').value = '';
  document.getElementById('cena').value = ''; 
  document.getElementById('preview').value = '';
  document.getElementById('dsc').value = '';
  document.getElementById('title').value = '';
}
//--------


</script>
</html>