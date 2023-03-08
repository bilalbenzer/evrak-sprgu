function populateFields(){
    const urlParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlParams.entries());
    if (params["dogrulamakod"]==undefined && params["evraksayi"]==undefined){
    }
    else{
    document.getElementById("dogrulamakod").value=params["dogrulamakod"]

    document.getElementById("evraksayi").value=params["evraksayi"]

  }
}



