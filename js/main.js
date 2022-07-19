function moveItemX(itemName, nr){
  var input = document.getElementById('numx' + nr);

  document.getElementById(itemName).style.left = input.value + "px";
};

function moveItemY(itemName,nr){
  var input = document.getElementById('numy' + nr);

  document.getElementById(itemName).style.top = input.value + "px";
};

function openMoveMenu(id){
  document.getElementById("mover" + id).style.bottom = "10px";
};

function closeMoveMenu(id){
  document.getElementById("mover" + id).style.bottom = "-400px";
};

function openMainMenu(){
  var menu = document.getElementById('main-menu');
  menu.style.opacity = 1;
  menu.style.zIndex = 99999999999;
  menu.style.pointerEvents = 'all';
}

function load2(){
  var url = 'inc/chatinside.php';

  var doc = new XMLHttpRequest();

  doc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var text = this.responseText.split("[{;:..:;}]");
      var select = document.getElementById('chatinside');

      select.innerHTML = "";

      for (var i = 0; i < text.length - 1; i = i + 2) {
        if(text[i] !== "" || text[i + 1] !== ""){
          select.innerHTML += '<div><b>'+text[i]+':</b> '+text[i + 1]+'</div>';
        }
      }
    }
  };

    doc.open("GET", url, true);

    doc.send();
}

setInterval(load2, 500);

function loadcompanychat(){
  var url = 'inc/companychat-inside.php';

  var doc = new XMLHttpRequest();

  doc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var text = this.responseText.split("[{;:..:;}]");
      var select = document.getElementById('companychat');

      select.innerHTML = "";

      for (var i = 0; i < text.length - 1; i = i + 3) {
        if(text[i] !== "" || text[i + 1] !== ""){
          select.innerHTML += '<div class="p-2 border-bottom"><b>'+text[i]+':</b> '+text[i + 1]+' <small style="color:#bbb;">'+text[i + 2]+'</small></div>';
        }
      }
    }
  };

    doc.open("GET", url, true);

    doc.send();
}

setInterval(loadcompanychat, 500);
