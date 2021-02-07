function color(){
var block = document.querySelector('.scroll_fix');
var block_top = document.querySelector('#page_header_cont');
var paragraphs = document.querySelectorAll(".left_label");
var titleaudio = document.querySelector(".top_audio_player_title");
var dialog = document.querySelector(".im-page-wrapper");
var news = document.querySelector("#page_body");

block.style.backgroundImage = 'url("https://pp.userapi.com/c858028/v858028666/2a64/Ol_bFZ7PRAQ.jpg")';
block.style.backgroundAttachment = 'fixed';
block.style.backgroundSize = 'cover';
block.style.backgroundRepeat = 'no-repeat';
block_top.style.backgroundColor = 'rgb(1 87 130)';
block_top.style.borderBottom = 'rgb(1 87 130)';
titleaudio.style.color = 'black';
dialog.style.opacity = '0.9';
news.style.opacity = '0.9';

for (var i = 0, length = paragraphs.length; i < length; i++) {
paragraphs[i].style.color = 'white';
}

}
color();

function clickButton(){
var as='<div id="drop" class="ds_wrap"><div class="content_wrap"><div id="start" class="click"><span class="start_b" onclick = "StartTIME()">Начать</span> <span class="stop_b" onclick = "StartStop()">Пауза</span></div> <div><div id="timerid" class="timerId">0:00</div></div>';
var div = document.createElement("div");
div.innerHTML = as;
document.getElementsByTagName('html')[0].append(div);
document.querySelector('.ds_wrap').style.width = "142px";
document.querySelector('.ds_wrap').style.height = "auto";
document.querySelector('.ds_wrap').style.background = "#fffdfc";
document.querySelector('.ds_wrap').style.position = "fixed";
document.querySelector('.ds_wrap').style.left = "0%";
document.querySelector('.ds_wrap').style.top = "20%";
document.querySelector('.ds_wrap').style.border = "1px solid #d8d5d5";
document.querySelector('.ds_wrap').style.borderRadius = "4px";
document.querySelector('.ds_wrap').style.zIndex = "10000";
document.querySelector('.ds_wrap').style.opacity = "0.8";
document.querySelector('.click').style.width = "100%";
document.querySelector('.click').style.display = "block";
document.querySelector('.click').style.verticalAlign = "baseline";
document.querySelector('.click').style.lineHeight = "4.4";
document.querySelector('.click').style.textAlign = "center";
document.querySelector('.click').style.cursor = "pointer";
document.querySelector('.timerId').style.textAlign = "center";
document.querySelector('.timerId').style.paddingBottom = "9px";
document.querySelector('.start_b').style.backgroundColor = "#70c570";
document.querySelector('.start_b').style.padding = "3px";
document.querySelector('.start_b').style.borderRadius = "3px";
document.querySelector('.start_b').style.marginRight = "13px";
document.querySelector('.stop_b').style.backgroundColor = "#ff250e";
document.querySelector('.stop_b').style.padding = "3px";
document.querySelector('.stop_b').style.borderRadius = "3px";
}
clickButton();
var secs, now, timer,
    mins = 0


window.onload = () => {
  StartStop();
}


var base = 60;
var clocktimer, dateObj, dh, dm, ds, ms;
var readout = '';
var h = 1,
  m = 1,
  tm = 1,
  s = 0,
  ts = 0,
  ms = 0,
  init = 0;

//функция для старта секундомера
function StartTIME() {
  var cdateObj = new Date();
  var t = (cdateObj.getTime() - dateObj.getTime()) - (s * 1000);
  if (t > 999) {
    s++;
  }
  if (s >= (m * base)) {
    ts = 0;
    m++;
  } else {
    ts = parseInt((ms / 100) + s);
    if (ts >= base) {
      ts = ts - ((m - 1) * base);
    }
  }
  if (m > (h * base)) {
    tm = 1;
    h++;
  } else {
    tm = parseInt((ms / 100) + m);
    if (tm >= base) {
      tm = tm - ((h - 1) * base);
    }
  }
  ms = Math.round(t / 10);
  if (ms > 99) {
    ms = 0;
  }
  if (ms == 0) {
    ms = '00';
  }
  if (ms > 0 && ms <= 9) {
    ms = '0' + ms;
  }
  if (ts > 0) {
    ds = ts;
    if (ts < 10) {
      ds = '0' + ts;
    }
  } else {
    ds = '00';
  }
  dm = tm - 1;
  if (dm > 0) {
    if (dm < 10) {
      dm = '0' + dm;
    }
  } else {
    dm = '00';
  }
  dh = h - 1;
  if (dh > 0) {
    if (dh < 10) {
      dh = '0' + dh;
    }
  } else {
    dh = '00';
  }
  readout = dh + ':' + dm + ':' + ds;
  document.getElementById('timerid').innerHTML = readout;
  clocktimer = setTimeout("StartTIME()", 1);
}

function StartStop() {
  if (init == 0) {
    dateObj = new Date();
    StartTIME();
    init = 1;
  } else {
    clearTimeout(clocktimer);
 
  }
}



dragElement(document.getElementById(("drop")));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
