const form = document.getElementById("form"),
usdt = document.getElementById("usdt").value,
ngn = document.getElementById('ngn').value,
address_div = document.getElementById("address"),
address = document.getElementById("address").value,
account_number_div = document.getElementById("account_number"),
account_number = document.getElementById("account_number").value,
bank_code_div = document.getElementById("bank_code").value,
bank_code = document.getElementById("bank_code").value,
email = document.getElementById("email").value,
bank_details = document.getElementById("bank_details"),
btnCopy = document.getElementById("btninput"),
baseAddress = document.getElementById("baseAddress");

function myFunction() {
  var copyText = document.getElementById("baseAddress");
  copyText.select();
  document.execCommand("Copy");
navigator.clipboard.writeText(copyText.value);

  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied";
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}

account_number_div.addEventListener('keyup', function() {
  if (this.value.length > 9) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "eg.php", true);
    xhr.onload = ()=>{
        let data = xhr.response
          if(xhr.status === 200){
         }
         else{
            alert("Error Exit!");
         }
      }
    let formData = new FormData(form);
    xhr.send(formData);
  }
});
    setInterval(() => {
  
      if(bank_details.value.length == 0){
        cpy_text_div.style.display = "none"
      }else{
        cpy_text_div.style.display = "flex"
      }
    }, 200);


