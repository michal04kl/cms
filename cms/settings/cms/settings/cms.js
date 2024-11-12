$(document).ready(function(){
   /*if(localStorage.safebutton != NULL){
      delete localStorage.safebutton;
   };*/
 $("#out").click(function(){
    $.get("./settings/logout/logout.php");
    document.location.reload();
    document.location.replace("/index.php");
 });//usun ciastk
 //wybór opcji:
 var n = 0;
 $("h5").click(function wyb(){
   var h5 = this.getAttribute("id");
   document.getElementById("ekran").innerHTML="";
   document.getElementById("ekran").style.border="none";
   document.getElementById("ekran").style.boxShadow="none";
   document.getElementById("ekran").style.backgroundColor="";
   if(h5 != "edit"){//pokaż przycisk zapisu
      document.getElementById("safe").style.display="none";
   }else{
      document.getElementById("safe").style.display="none";
      localStorage.safebutton = "edit"; 
   };
   if(localStorage.h5spr == h5 && n!=0){//odznaczanie opcji
      document.getElementById(localStorage.h5spr).style.color="";
      document.getElementById(localStorage.h5spr).style.backgroundColor="";
      document.querySelector(localStorage.optspr).style.display="none";
      delete localStorage.h5spr;
      delete localStorage.optspr;
      n = 0;
      return;  
   };   
   if(n == 0){//wyróżnienie opcji
   localStorage.h5spr = h5;//zapisane do pamięci wartości h5
   document.getElementById(h5).style.color="#294566";
   document.getElementById(h5).style.backgroundColor="#00C9CC";
   var opt = "#"+h5+"_op.option";
   document.querySelector(opt).style.display="initial";
   localStorage.optspr = opt;//zapisanie do pamięci wartości opt
   n = 1;
   ustawienie(h5, opt);
   }else{//usuwanie poprzedniego wyróżnienia opcji i zaznaczanie nowej
      var h5old = localStorage.h5spr;
      var optold = localStorage.optspr;
      document.getElementById(h5old).style.color="";
      document.getElementById(h5old).style.backgroundColor="";
      document.querySelector(optold).style.display="none";
      n = 0;
      delete localStorage.h5spr;
      delete localStorage.optspr;
      localStorage.h5spr = h5;
   document.getElementById(h5).style.color="#294566";
   document.getElementById(h5).style.backgroundColor="#00C9CC";
   var opt = "#"+h5+"_op.option";
   document.querySelector(opt).style.display="initial";
   localStorage.optspr = opt;
   n = 1;
   ustawienie(h5, opt);
   };

   if(h5 == "show" || h5 == "edit" || h5=="things"){//wyświetlanie na jakiej stronie pracujemy
      let text = this.getAttribute("t");
      document.getElementById("napis").innerHTML=text+"<b id='page'></b>";
      document.getElementById("page").innerHTML="Nie wybrano";
   }else{
      document.getElementById("napis").innerHTML="";
//      document.getElementById("page").innerHTML="";
   };
 });

 function ustawienie(h5, opt){   //ustawianie opcji
    const ust = document.getElementById(h5).getBoundingClientRect();
   const ust2 = document.body.getBoundingClientRect();
   var top = ((ust.top/ust2.height)*100)+"%";
   var left = ((ust.right/ust2.width)*100)+"%";
   document.querySelector(opt).style.top=top;
   document.querySelector(opt).style.left=left; 
   localStorage.resh5 = h5;
   localStorage.resopt = opt; 
};

window.onresize = function(){//aktualizacja miejsc opcji po zmianie ekranu
ustawienie(localStorage.resh5, localStorage.resopt);
};

/*window.onscroll = function(){//aktualizacja miejsca opcji po skrolowaniu
   let body = document.querySelector("body").getBoundingClientRect();
   document.getElementById("left").height=body.height+window.scrollY+"px";
   document.querySelector("header").width=body.width+window.scrollX+"px";
   let sh5 = localStorage.resh5-scrollY;
   let sopt = localStorage.resopt-scrollY;
   ustawienie(sh5, sopt);
};*/

//opcje
//podgląd
$("#index").click(function(){
document.getElementById("page").innerHTML="Strona główna";
wstaw("/index.php");
});
$("#login").click(function(){
   document.getElementById("page").innerHTML="Strona logowania";
   wstaw("/settings/login/login.php");
})

function wstaw(co){//load na ekran
document.getElementById("ekran").innerHTML='<iframe src='+co+' allow="fullscreen" width=100% height=100%  id="look" />';
document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000;";
};

//użytkownicy
$("#user").click(function(){
document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; min-height:80%; height:max-content; background-color: #BAD6EB; max-height:'';";
$("#ekran").load("/settings/cms/data/users/users.php");
document.getElementById("napis").innerHTML="<b>Użytkownicy:</b>";
});//rozpisanie tabeli

//dodawanie kontentu
$("#things").click(function(){
   document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; height: 80%; max-height: max-content; min-height:'';  background-color: #023981;";
   $("#ekran").load("/settings/cms/data/add/add.php");
});

//edycja strony
$("#edit").click(function(){
   document.getElementById("napis").innerHTML="<b>Edycja strony głównej</b>";
   document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; height: 80%; max-height: max-content; min-height:'';";
   document.getElementById("ekran").innerHTML='<iframe src="/settings/cms/data/manager/body.php" allow="fullscreen" width=100% height=100% style="pointer-events: none;"/>';
});

 //opcje
 //przycisk zapisu
 $("h3").click(function(){
   let sspr = $(this).attr("id");
   if(sspr == "us_prev"){
      document.getElementById("safe").style.display="inherit"; 
   }else{
      document.getElementById("safe").style.display="none";
   };
 });
 //załadowanie użytkowników
 $("#us_show").click(function(){
   $("#ekran").load("/settings/cms/data/users/users.php");
   document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; min-height:80%; height:max-content; background-color: #BAD6EB; max-height:'';";
   document.getElementById("napis").innerHTML="<b>Użytkownicy:</b>";
 });
 //dodanie użytkowników
 $("#us_add").click(function(){
   $("#ekran").load("/settings/cms/data/users/do/add/add.php");
   document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; height: 80%; max-height: max-content; min-height:'';";
   document.getElementById("napis").innerHTML="";
 });
 //usuwanie użytkowników
 $("#us_del").click(function(){
   document.getElementById("us_opt_wyb").setAttribute("value", "");
   document.getElementById("us_opt_wyb").setAttribute("value", "del");
      $.ajax({
         url:"/settings/cms/data/users/edit.php",
         type:"POST",
         data:$("#user_from").serialize(),
         cache: false,
         success:function(callback){
            if(callback=="nie wybrano żadnych kont"){alert(callback)}else if(callback == "błąd - konto do usunięcia ma taką samą nazwę jak użytkownik na którym jesteś zalogowany"){
               alert(callback);
               return false;
            }else{
               let text = "Czy napewno chcesz usunąć: "+callback;
               if(confirm(text)==false){//confirm
                  return false;
               }else{//usuń
                  $.ajax({
                     url:"/settings/cms/data/users/do/del/del.php",
                     type:"POST",
                     data:$("#user_from").serialize(),
                     cache: false,
                     success:function(odp){
                      alert(odp);
                      $("#ekran").load("/settings/cms/data/users/users.php");
                     } 
                  });
               };
            };
         }
      });
});
//edycja uprawnień
$("#us_prev").click(function(){
   document.getElementById("us_opt_wyb").setAttribute("value", "");
   document.getElementById("us_opt_wyb").setAttribute("value", "prev");
   $.ajax({
      url:"/settings/cms/data/users/edit.php",
      type:"POST",
      data:$("#user_from").serialize(),
      cache: false,
      success:function(callback){
         if(callback == "nie wybrano żadnych kont"){
            document.getElementById("safe").style.display="none";
            alert(callback);
            return false;
         }else if(callback == "błąd - nie możesz zmienić poziomu uprawnień konta na którym jesteś zalogowany"){
            document.getElementById("safe").style.display="none";
            alert(callback);
            return false;
         }else{
            $.ajax({
               url:"/settings/cms/data/users/do/previl/prev.php",
               type:"POST",
               data:$("#user_from").serialize(),
               cache: false,
               success:function(page){
                  document.getElementById("ekran").innerHTML=page;
                  document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; height: 80%; max-height: max-content; min-height:'';";
                  document.querySelector("form").style="justify-content: space-evenly; background-color: #000321;";
                  localStorage.safebutton = "prev"; 
               }  
            }); 
         };
      }});   
});
 //dodawanie i edycja kontentu
 $("#link").click(function(){
   $.ajax({
      url:"/settings/cms/edit/add.php",
      success:function(bar){
         if(bar == "błąd - żadna strona ani artykuł nie został dodany"){
         alert(bar);
         return false;            
         }else{
            document.getElementById("ekran").innerHTML=bar;
            $(".lbpg").click(function(){
               var id = this.getAttribute("id");
               var name = $("#"+id).text();
               $.ajax({
                  url:"/settings/cms/edit/edit.php",
                  type:"POST",
                  data:{"id":id,"name":name},
                  success:function(chosen){
                     document.getElementById("ekran").innerHTML=chosen;
                  }
               });
            });
         };
      }
   });
 });
 //edycja tytułów
 $("#title").click(function(){
   $("#ekran").load("/settings/cms/edit/title.php");
 });
//opcje safe buttona
$("#safe").click(function(){
   if(localStorage.safebutton == "prev"){//uprawnienia
   $.ajax({
      url:"/settings/cms/data/users/do/previl/base_prev.php",
      type:"POST",
      data:$("#chc_form").serialize(),
      caches: false,
      success:function(){
         delete localStorage.safebutton;
         $("#ekran").load("/settings/cms/data/users/do/previl/previl_show.php");
         document.getElementById("napis").innerHTML="Użytkownicy i ich poziomy uprawnień:";
         document.getElementById("safe").style.display="none";
      }
   });
};
});
});
