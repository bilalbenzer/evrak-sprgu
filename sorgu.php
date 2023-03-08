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
$sorgu ="SELECT dogrulama_kodu, evrak_sayisi, evrak_eyp FROM evraklar";
$result=mysqli_query($conn,$sorgu);

if ($conn->connect_error>0){
    die("<b>Sorgu Hatası:<b/>".$conn->error);
}
$dosyayol="";
if (mysqli_num_rows($result)>0){
    while ($row=mysqli_fetch_assoc($result)){
        if ($row["dogrulama_kodu"]==$dogrulamakodu && $row["evrak_sayisi"]==$evraksayi){
            $dosyayol= $row["evrak_eyp"];
            break;
        }
    }
    if ($dosyayol==""){
        htmldonus();
    }
}
else{
}
?>
