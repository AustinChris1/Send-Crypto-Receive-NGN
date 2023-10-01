let add
const address = document.getElementById("address");
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "address.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            add = xhr.response;
            address.value = add;
            
          }
      }
    }
    xhr.send();
}, 2000)

const yo = document.getElementById("yo");
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "toTxts/address.php", true);
    xhr.onload = ()=>{
          if(xhr.status === 200){
            // yo.innerHTML = add;
         }
         else{
            yo.innerHTML = "Error Exit!";
         }
      }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("address="+add);
}, 2200);


