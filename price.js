let stuff
let price


const dollar = document.getElementById("usdt");
const naira = document.getElementById("ngn");
// setInterval(() =>{
//   usdt.addEventListener('keyup', updateValue);
// },200)

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "txt/file.txt", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            stuff = xhr.responseText;
            stuff = parseFloat(stuff)
            // price = usdt * stuff;
            // ngn.value = price;
            // alert(price);

         }
      }
    }
    xhr.send();
}, 300)

  dollar.addEventListener('keyup', ()=>{
    price = parseFloat(dollar.value * stuff)
    // alert(typeof(price));
    naira.value = price;
  })


  naira.addEventListener('keyup', ()=>{
    price = parseFloat(naira.value / stuff)
    price = price.toFixed(2)
    dollar.value = price
  })
//   setInterval(() =>{
//     let xhr = new XMLHttpRequest();
//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//             price = parseFloat(naira.value / stuff)
//             price = price.toFixed(2)
//             dollar.value = price
//                  }
//       }
//     }
//     xhr.send();
// }, 400)
// setInterval(() =>{
//   let xhr = new XMLHttpRequest();
//   xhr.onload = ()=>{
//     if(xhr.readyState === XMLHttpRequest.DONE){
//         if(xhr.status === 200){
//           price = parseFloat(dollar.value * stuff)
//           // alert(typeof(price));
//           naira.value = price;
//                      }
//     }
//   }
//   xhr.send();
// }, 400)
