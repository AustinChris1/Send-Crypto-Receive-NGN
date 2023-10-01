setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "test.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
           let data = xhr.response;
           if(data == 'there was an error Could not resolve host: api.paystack.co' || data == 'there was an error OpenSSL SSL_read: Connection was reset, errno 10054'){
            data = "Network Error";
           }
           if (account_number_div.value.length > 9){
            bank_details.value = data
           }else{
            bank_details.value = ''
           }
          }   

      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}, 500);
