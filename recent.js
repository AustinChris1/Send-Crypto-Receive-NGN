const usd = document.getElementById('usdtx')
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "recentTx.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
           let data = xhr.response;
           usd.innerHTML = data
          }   

      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
},1000);

