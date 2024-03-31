// Loading window.

window.onload = function () {

// Testing the first button.

 let test = document.getElementById("test");
 let btn = document.getElementById("btn");
 btn.onclick = function() {

// Conditional for the text of the second button.

  if (test.innerHTML != "Thank you very much, and goodbye!") {
   test.innerHTML = "Thank you very much, and goodbye!";
  } else {
   test.innerHTML = "Hello people!";
  }
 }
 
// Testing the third button.
 
 let test0 = document.getElementById("test0");
 let btn0 = document.getElementById("btn0");
 btn0.onclick = function () {
  if (test0.innerHTML != 'Alors, qu\'est-ce que tu fait maintenant ?') {
   test0.innerHTML = "Alors, qu\'est-ce que tu fait maintenant ?";
  } else {
   test0.innerHTML = "Integer 10 is equal to string 10.0: " + (10 == '10.0');
  }
 }
 
// Testing the first button.
 
 let flexBtn = document.getElementById("flex-btn");
 flexBtn.onclick = function () {
  if (document.getElementById("sololearn").innerHTML == "Sololearn") {
   document.getElementById("sololearn").innerHTML = "Google Mail";
   document.getElementById('sololearn').setAttribute('href', 'https://mail.google.com/mail/u/0/#inbox');
   document.getElementById("duolingo").innerHTML = "Duden";
   document.getElementById('duolingo').setAttribute('href', 'https://www.duden.de');
   document.getElementById("yt").innerHTML = "Facebook Messenger";
   document.getElementById('yt').setAttribute('href', 'https://www.facebook.com/messages');
   document.getElementById("gt").innerHTML = "Google Meet";
   document.getElementById('gt').setAttribute('href', 'https://meet.google.com/');
   document.getElementById("invis").setAttribute('class','item');
   document.getElementById("gdrive").innerHTML = "Google Drive";
  } else {
   document.getElementById("sololearn").innerHTML = "Sololearn";
   document.getElementById('sololearn').setAttribute('href', 'https://www.sololearn.com/');
   document.getElementById("duolingo").innerHTML = "Duolingo";
   document.getElementById('duolingo').setAttribute('href', 'https://www.duolingo.com/learn');
   document.getElementById("yt").innerHTML = "YouTube";
   document.getElementById('yt').setAttribute('href', 'https://youtu.be/');
   document.getElementById("gt").innerHTML = "Google Translate";
   document.getElementById('gt').setAttribute('href', 'https://translate.google.com/');
   document.getElementById("invis").setAttribute('class','');
   document.getElementById("gdrive").innerHTML = "";
  }
 }
 
}