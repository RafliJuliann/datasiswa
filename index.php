<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style> 
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    .box {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        width: 80%;
        max-width: 600px;
    }

    h1 {
        color: #333;
        text-align: center;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-top: 10px;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button[type="submit"],
    button[type="reset"] {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 10px;
    }

    button[type="submit"]:hover,
    button[type="reset"]:hover {
        background-color: #45a049;
    }

    p {
        color: red;
        margin: 10px 0;
    }

    .hapus {
        color: #f44336;
        text-decoration: none;
        margin-top: 10px;
        display: inline-block;
    }

    .hapus:hover {
        text-decoration: underline;
    }
</style>
    <div class="box">
    <h1>Data Siswa Kelas 10</h1>
    <form method="post" action="" >
        <label for="Siswa">Nama Siswa</label>
        <input type="text" name="siswa" id="siswa" placeholder="Input Nama">
        <label for="NIS">NIS</label>
        <input type="number" name="nis" id="nis" placeholder="Input NIS">
        <label for="Rayon">Rayon</label>
        <input type="text" name="rayon" id="rayon" placeholder="Input Rayon">
        <button type="submit" name="kirim" style="margin-top:10px;">Kirim</button>
        <button type="submit" name="reset" style="margin-top:30px;">Reset</button>
    </form>

    <?php
    // RESET BUTTON
    session_start();
    if(isset($_POST['reset'])){
        session_unset();
        header('Location: '. $_SERVER['PHP_SELF']);
        exit;
    }
    // HAPUS SATU BUAH DATA
    if(isset($_GET['hapus'])){
        $index = $_GET['hapus'];
        unset($_SESSION['dataSiswa'][$index]);
    }
    // IF ARRAY MULTIDIMENSION NOT FOUND THEN MADE FIRST
   if(!isset($_SESSION['dataSiswa'])){
    $_SESSION['dataSiswa'] = array();
    }

    // IF ARRAY FOUND, THEN MADE ARRAY FROM USER INPUT DATA
    if(isset($_POST['kirim'])){
    if(@$_POST['siswa'] && @$_POST['nis'] && @$_POST['rayon']){
        $data = [
            'siswa' => $_POST['siswa'],
            'nis' => $_POST['nis'],
            'rayon' => $_POST['rayon']
        ];
        array_push($_SESSION['dataSiswa'], $data);
        header('Location: '. $_SERVER['PHP_SELF']);
        exit;
    }else{
        echo "<p>Lengkapi Data</p>";
    }
}
if(!empty($_SESSION['dataSiswa'])){
foreach($_SESSION['dataSiswa'] as $index=> $value){
    echo "Nama Siswa :". $value['siswa'] . "<br>";
    echo "NIS : " . $value['nis']."<br>";
    echo "Rayon : " .  $value ['rayon']. "<br>";
    echo '<a href="?hapus=' . $index . '" class="hapus">HAPUS</a>' . "<br>";
}
}
    ?>
    </div>
</body>
</html>