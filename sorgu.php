<?php
// değişken tanimlama
/* $dogrulama_kod = $_GET["kod"];
$evraksayi = $_GET["sayi"]; */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evrak_kayitlari";
$dogrulamakodu = $_POST["kod"];
$evraksayi = $_POST["sayi"];

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// bağlantıyı test et
function htmldonus(){
    header("Location:error.html");
    exit;
}
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
} 
$sorgu ="SELECT * FROM evraklar";
$result=mysqli_query($conn,$sorgu);

if ($conn->connect_error>0){
    die("<b>Sorgu Hatası:<b/>".$conn->error);
}
$dosyayol="";
function sorgulama($result,$dosyayol,$dogrulamakodu,$evraksayi){

if (mysqli_num_rows($result)>0){
    while ($row=mysqli_fetch_assoc($result)){
        if ($row["dogrulama_kod"]==$dogrulamakodu && $row["sayi"]==$evraksayi){
            $dosyayol="dolu";
            return $row;
            /* echo "Doğrulama Kodu:".$row["dogrulama_kod"]."<br>";
            echo "Evrak Sayısı:".$row["sayi"]."<br>";
            echo "Evrak Tarihi".$row["tarih"]."<br>";
            echo "İmzacı Bilgileri:".$row["imzaci"]."<br>";
            echo "Ünvan:".$row["unvan"]."<br>";
            echo "İmza Tarihi:".$row["imza_tarih"]."<br>";
            
            break; */
        }
    }
    if ($dosyayol==""){
        htmldonus();
    }
}
else{
    htmldonus();
}
}
$sorgusonuc=sorgulama($result,$dosyayol,$dogrulamakodu,$evraksayi);
function pdffile($sorgusonuc){
    $file = "evrak_sistemi/".$sorgusonuc["il"]."/".$sorgusonuc["ilce"]."/".$sorgusonuc["mahalle_koy"]."/".$sorgusonuc["sayi"].".pdf";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: 0");
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Length: ' . filesize($file));
    header('Pragma: public');
    flush();
    readfile($file);
    die();
}
function eypfile($sorgusonuc){
    $file = "evrak_sistemi/".$sorgusonuc["il"]."/".$sorgusonuc["ilce"]."/".$sorgusonuc["mahalle_koy"]."/".$sorgusonuc["sayi"].".eyp";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: 0");
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Length: ' . filesize($file));
    header('Pragma: public');
    flush();
    readfile($file);
    die();
}


if (isset($_POST['pdfindir'])){
   pdffile($sorgusonuc);
}
else if (isset($_POST['eypfile'])){
    eypfile($sorgusonuc);
}

?>
<html>
    <head>
    <link rel="stylesheet" href="css/web.css">
    </head>
        <body style="width: 100%">
            <div style="width: auto;height: auto" id="divvv">
            <dl id="bilgiler">
                <dt id="baslik">Evrak Bilgileri</dt>
                <dt class="altsatir"><br>
                Doğrulama Kodu:  <br><?php echo $sorgusonuc["dogrulama_kod"] ?>
                </dt>
                <dt class="altsatir"><br>
                Evrak Sayısı:  <br><?php echo $sorgusonuc["sayi"] ?>
                </dt>
                <dt class="altsatir"><br>
                Evrak Tarihi:  <br><?php echo $sorgusonuc["tarih"] ?>
                </dt>
                <dt class="altsatir">  <br>                  
                İmzacı Bilgileri: <br> <?php echo $sorgusonuc["imzaci"] ?>
                </dt>
                <dt class="altsatir">  <br>                  
                Ünvan:  <br><?php echo $sorgusonuc["unvan"] ?>
                </dt>
                <dt class="altsatir">   <br>                 
                İmza Tarihi:  <br><?php echo $sorgusonuc["imza_tarih"] ?>
                </dt>
                <form action="" method="POST">
                <input type="submit" name="pdfindir" value="Üstyazı"></input>
                <input type="submit" name="eypfile" value="EYP"></input>
                </form>
                <br>
                <br><br><br>    
                <img src="logo.jpg" alt=""width="15%">
            </dl>
            </div>
        </body>
</html>
