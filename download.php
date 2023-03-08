<?php

if (isset($_POST['pdfindir'])){
    echo 'pdfindir="'.$_POST['pdfindir'];
}
else{
    echo "eypfile=" . $_POST['eypfile'];
}
?>
