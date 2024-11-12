document.addEventListener("DOMContentLoaded", function() {
const but = document.querySelector("#start");
but.addEventListener("click", umiesc)//do eventu nie daje się nawiasów bo wykona tą funkcje odrazu
var tab = [
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0]
];//tablica 2 wymiarowa (jedno wymiarowa to var tab = [0,0,0,0,0,0,0,0];)

function umiesc(){
 var ile = document.getElementById("ile").value;
 if(ile < 1 || ile>64){
    document.getElementById("warning").style.visibility="inherit";
 }else{
 $("#menu").fadeOut(30);
$("table").fadeIn();
$("#left").fadeIn();
document.getElementById("wynik").innerHTML=ile;
 for(let bomba=0; bomba<ile; bomba++){
    x = Math.floor/*zaokrąglanie*/(Math.random()*8+1);/*+1 żeby bomb nie było na rogach*/
    y = Math.floor(Math.random()*8+1);
    if(tab[x][y]!=-1){
        tab[x][y]=-1;
        if(tab[x-1][y-1]!=-1) tab[x-1][y-1]++;
        if(tab[x-1][y]!=-1) tab[x-1][y]++;
        if(tab[x-1][y+1]!=-1) tab[x-1][y+1]++;
        if(tab[x][y-1]!=-1) tab[x][y-1]++;
        if(tab[x][y+1]!=-1) tab[x][y+1]++;
        if(tab[x+1][y-1]!=-1) tab[x+1][y-1]++;
        if(tab[x+1][y]!=-1) tab[x+1][y]++;
        if(tab[x+1][y+1]!=-1) tab[x+1][y+1]++;
    }else if(tab[x][y]==-1){
        bomba--;//że gdy wylosuje to samo pole to nadal będzie tyle samo bomb
    }};
    console.log(tab);

var pole = document.querySelectorAll("td");
var a = 0;//kolumny
var c = 0;//wiersze
var d = 0;//wybrane pole
for(let i = 0; i<pole.length; i++){
    let b = pole[d];
    b.setAttribute("id", a);
    b.setAttribute("class", c);
    c = c + 1;
    if(c>9){
        a = a + 1;
        c = 0;
    };
    d = d + 1;
};//dodawanie class i id do td
}};
    d = 0;
    var pole = document.querySelectorAll("td");
for(let i = 0; i<pole.length; i++){
    let b = pole[d];
    b.addEventListener("click", spr);
    b.addEventListener("contextmenu", rc);
    d = d + 1;
};

var r = 100;
function spr(){
let k = this.getAttribute("id")*1;
let w = this.getAttribute("class")*1;
let wartosc = tab[k][w];
this.removeAttribute("class");
this.setAttribute("id", r);
let id = ""+r;
document.getElementById(id).innerHTML=wartosc;
if(wartosc>=0){
    document.getElementById(id).style.backgroundColor="#00ff00";
    document.getElementById(id).style.color="black";
}else{
    document.getElementById(id).style.backgroundColor="#ff0000"
    document.getElementById(id).innerHTML="X"
    var g = 0;
    for(let i = 0; i<pole.length; i++){
    let b = pole[g];
    b.removeAttribute("id");
    b.removeAttribute("class");
    r = r+1;
    g = g+1;
};//pentla usuwania znaczników
    g = 0;
    a = 0;
    c = 0;
    for(let i = 0; i<pole.length; i++){
        let b = pole[g];
        b.setAttribute("id", a);
    b.setAttribute("class", c);
    c = c + 1;
    if(c>9){
        a = a + 1;
        c = 0;
    };
        g = g+1;
    };//pentla renazywania
    g = 0;
    var a = 0;
    var c = 0;
    var bomb = 500;
    var bombtxt = ""+bomb;
    var ggspr = 0;
    var ggile = 0;
    var ile = document.getElementById("ile").value;
    for(let i = 0; i<pole.length; i++){
        let gspr = tab[a][c];
        if(gspr == -1){
            let ggid= ""+c;
            let gg = document.getElementsByClassName(ggid);
            for(let i = 0; i<pole.length; i++){
                let ggb = gg[ggspr];
                let ggsprid = ggb.getAttribute("id");
                if(ggsprid == a){
                    ggb.removeAttribute("class");
                    ggb.setAttribute("id", bombtxt);
                    document.getElementById(bombtxt).innerHTML="X";
                    document.getElementById(bombtxt).style.backgroundColor="#ff0000";
                    bomb = bomb + 1;
                    bombtxt = ""+bomb;
                    ggspr = 0;
                    ggile = ggile + 1;
                    if(ggile == ile){
                        setTimeout(lose, 500);
                    }
                    break;
                };
                ggspr = ggspr + 1;
            };
        };
        c = c+1;
        if(c>9){
            a = a + 1;
            c = 0;
        };
            g = g+1;
    };

    //pentla odkrywania X

};
r = r+1;
};
function lose(){
    $("table").fadeOut(2000);
    $("#left").fadeOut(2000);
    setTimeout(over, 2000);
};
function over(){
    $("#gameover").fadeIn(2000);
    setTimeout(resetbuton, 2000);
};
function resetbuton(){
    $("#reset").fadeIn(2000);
};
document.getElementById("reset").addEventListener("click", reset);
function reset(){
    document.location.reload();
};
var ekran = 0;
function rc(e){    
var g = 0;
var kolorn = 0;
e.preventDefault();

for(let i = 0; i<pole.length; i++){
let b = pole[g];
const kolorb = window.getComputedStyle(b);
let bgkolor = kolorb.getPropertyValue("background-color");
kolorspr = "rgb(0, 0, 255)";
kolortxt = ""+bgkolor;
if(kolorspr==kolortxt){kolorn = kolorn + 1}; 
g = g+1;
};//pętla sprawdzania kolorów;
var ile = document.getElementById("ile").value;
var wyswietl = ile*1;
let limit = ile;
let limitspr = kolorn;
if(limitspr > limit){
    const od = window.getComputedStyle(this);
    let odk = od.getPropertyValue("background-color");
    let odtxt = ""+odk;
    let odsprtxt = "rgb(0, 0, 255)";
    if(odtxt==odsprtxt){
        this.style.backgroundColor="#000000"
        this.innerHTML="";
    }else{alert("przekroczono limit znaczników")};
}else{
    const kolorb = window.getComputedStyle(this);
    let bgkolor = kolorb.getPropertyValue("background-color"); 
    kolorspr = "rgb(0, 0, 255)";
    kolortxt = ""+bgkolor;   
if(kolorspr == kolortxt){
    this.style.backgroundColor="#000000"
    this.innerHTML="";
    let kk = this.getAttribute("id");
    let wk = this.getAttribute("class");
    wartosck = tab[kk][wk];
    if(wartosck == -1){
        ekran = ekran + 1;
        wyswietl = wyswietl + ekran;
        //document.getElementById("wynik").innerHTML=wyswietl;
    };//odklikiwanie + odklikiwanie X
}else{
var ile = document.getElementById("ile").value;
g = 0;
    for(let i = 0; i<pole.length; i++){
    let b = pole[g];
    b.removeAttribute("id");
    b.removeAttribute("class");
    r = r+1;
    g = g+1;
};//pentla usuwania znaczników
    g = 0;
    a = 0;
    c = 0;
    for(let i = 0; i<pole.length; i++){
        let b = pole[g];
        b.setAttribute("id", a);
    b.setAttribute("class", c);
    c = c + 1;
    if(c>9){
        a = a + 1;
        c = 0;
    };
        g = g+1;
    };//pentla renazywania
    g = 0;
let k = this.getAttribute("id");
let w = this.getAttribute("class");
this.style.backgroundColor="#0000ff"
this.innerHTML="||";
this.setAttribute("id", k);
this.setAttribute("class", w);
let wartosc = tab[k][w];
if(wartosc == -1){
ekran = ekran - 1;
wyswietl = wyswietl + ekran;
//document.getElementById("wynik").innerHTML=wyswietl;
if(wyswietl==0){win()};
};//sprawdzanie poprawnosci znacznika
};//odklikoiwanie i znaczniki;
}};
function win(){
    $("table").fadeOut(2000);
    $("#left").fadeOut(2000);
    setTimeout(win2, 2000);
};
function win2(){
    $("#win").fadeIn(2000);
    setTimeout(win3, 2000);
};
function win3(){
    $("#reset2").fadeIn(2000);
}
$("#reset2").click(function(){
    document.location.reload();
});
});