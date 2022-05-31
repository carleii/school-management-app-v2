// let form = document.getElementById("uploadLevel");
// let chatBox = document.querySelector(".chat-box");
// let xhr = new XMLHttpRequest();

// form.addEventListener("submit", function (e){
//     e.preventDefault();
//     xhr.onreadystatechange = function () {
//         console.log(this);
//         if (this.readyState == 4 && this.status == 200){
//             let answer = this.response;
//             if(answer == 1){
//                 alert("Successfully uploaded");
//             }
//         }else if (this.response == 4 && this.status == 404){
//             alert("Erreur 404:/");
//         }
//     }
//     let data = new FormData(form);
//     xhr.open("POST", "uploadLevel.php",true);
//     xhr.responseType= "text";
//     xhr.send(data);

// })

// setInterval(() =>{
//     let xhr = new XMLHttpRequest();
//     xhr.onload = ()=>{
//         if (this.readyState == 4 && this.status == 200){
//             if(xhr.status === 200){
//             let data = xhr.response;
//             console.log(data);
//             chatBox.innerHTML = data;
//           }
//         }else if (this.response == 4 && this.status == 404){
//             alert("Erreur 404:/");
//         }
//     }
//     xhr.open("POST", "getLevel.php", true);
//     // xhr.responseType= "document";
//     xhr.send();
// }, 5000);
