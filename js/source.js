function evrak_sorgulama(){
  var dogrulamakod=document.getElementById("dogrulama-kod").value
  var sayi=document.getElementById("evrak-sayi").value

  evrak_bilgi_al(dogrulamakod,sayi)
}
function populateFields(){
    const urlParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlParams.entries());
    const certificateNumberField = document.getElementById("dogrulama-kod")
    certificateNumberField.value = params["dogrulama-kod"]
  }
async function evrak_bilgi_al(a,b){
}

