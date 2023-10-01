let data

const box = document.getElementById("box");
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "base.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            data = xhr.response;
            box.value = data;

         }
      }
    }
    xhr.send();
}, 2000)

// const box = document.getElementById("box");

const hey = document.getElementById("hey");
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "toTxts/base.php", true);
    xhr.onload = ()=>{
          if(xhr.status === 200){
            // hey.innerHTML = data;
         }
         else{
            hey.innerHTML = "Error Exit!";
         }
      }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("data="+data);
}, 2200);




