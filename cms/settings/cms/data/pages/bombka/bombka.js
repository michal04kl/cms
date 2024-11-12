$(document).ready(function(){
  document.getElementById("zmiana").value="#ff0000";
  document.getElementById("zmiana").style.backgroundColor= "#ff0000";

      $("#zmiana").change(function(){
        var kolor = $(this).val();
      document.getElementById("bombka").style.backgroundColor=kolor;
      document.getElementById("zmiana").style.backgroundColor=kolor;
    });//zmiana koloru bombki

    var x = 0;
    var n = 1;
    const p = document.getElementById("bombka");

    $("#bombka").mousedown(function(){x=1;
      n = n+1;
    const k = document.createElement('div');//stworzenie kopii bombki
    k.setAttribute("id", "kopia"+n);
    k.setAttribute("class", "b2");
    const pob = window.getComputedStyle(p);
    let cssText = pob.cssText;
    if (!cssText){
      cssText = Array.from(pob).reduce((str, property) => {
        return `${str}${property}:${pob.getPropertyValue(property)};`;
      }, ''); 
    };
    k.style.cssText = cssText;//nadanie stylów kopii
    k.style.position="absolute";
    document.body.appendChild(k);//dopisanie do DOM kopii
    $("#kopia"+n).mouseup(function(){x=0});
    $(document).mousemove(function(event){
     if(x==1){
    $("#kopia"+n).css({left: event.pageX-25+"px",
                      top: event.pageY-25+"px"})}})              
                    });//pozycja kopii

                    
                    $(document).on("mousedown", ".b2", function(){//sprawdzenie DOM pod kątem nowych obiektów i odczytanie id obiektu
                      var id = $(this).attr("id");
                      id = "#"+id;
                      var y = 0
                    $(id).mousedown(function(){
                      y = 1;
                      $(id).mouseup(function(){y=0});
                      $(id).mousemove(function(event){
                        if(y==1){//zmiana miejsca kopii
                      $(id).css({left: event.pageX-25+"px",
                                 top: event.pageY-25+"px"})}})})});
                    
                                 $(document).on("dblclick", ".b2", function(){
                                  var wybrane = $(this).attr("id");
                                  wyb = "#"+wybrane;
                                  wybrane = ""+wybrane;
                                  document.getElementById(wybrane).style.boxShadow="0px 0px 20px 10px #00ff00";//zaznaczenie bombki
                                  document.getElementById(wybrane).setAttribute("class", "wybrane");
                                  document.getElementById('del').onclick = spr;
                                  var s = 0;
                                  $(wyb).click(function(){
                                  document.getElementById(wybrane).style.boxShadow = "none";//odznaczenie bombki
                                  document.getElementById(wybrane).setAttribute("class", "b2");
                                  s = 1});
                                  $("#zmiana").change(function(){
                                    var kolor2 = $(this).val();
                                    var kolor3 = document.querySelectorAll(".wybrane");
                                    for(let i = 0; i < kolor3.length; i++){
                                      kolor3[i].style.backgroundColor=kolor2;
                                      kolor3[i].style.boxShadow = "none";
                                      kolor3[i].setAttribute("class", "b2")};
                                  })//zmiana koloru kopii

                                  function spr(){
                                    if(s==0){
                                      var shadow = document.querySelectorAll(".wybrane");
                                      for(let i = 0; i < shadow.length; i++){
                                        shadow[i].style.boxShadow="0px 0px 20px 10px #ff0000";};
                                      document.getElementById("del").style.display="none";
                                      document.getElementById("wyb").style.display="flex";
                                      $("#tak").click(function(){
                                        var usun = document.querySelectorAll(".wybrane");
                                          for(let i = 0; i < usun.length; i++){
                                            usun[i].style.display="none";};
                                        document.getElementById("del").style.removeProperty('display');
                                        document.getElementById("wyb").style.display="none"; 
                                        });
                                      $("#nie").click(function(){
                                        document.getElementById(wybrane).style.boxShadow = "none";
                                        document.getElementById("del").style.removeProperty('display');
                                        document.getElementById(wybrane).setAttribute("class", "b2");
                                        document.getElementById("wyb").style.display="none";
                                        s = 1;
                                      });//panel z usuwaniem kopii
                                  }else if(s==1){
                                    return}}});

                                 $("#all").click(function(){
                                    document.getElementById("obraz").style.backgroundImage="url('choinkax.png')";
                                    document.getElementById("obraz").style.boxShadow="0px 0px 20px 10px #ff0000";
                                    document.getElementById("all").style.display="none";
                                    document.getElementById("wyb3").style.display="flex";
                                  $("#tak_all").click(function(){
                                    document.location.reload();
                                  });
                                  $("#nie_all").click(function(){
                                    document.getElementById("obraz").style.backgroundImage="url('choinka.png')";
                                    document.getElementById("obraz").style.boxShadow="none";
                                    document.getElementById("all").style.removeProperty('display');
                                    document.getElementById("wyb3").style.display="none";
                                  });//panel z usuwaniem wszystkiego
                                  });

  $("#info").click(function(){
    $("#help").fadeToggle("slow");
  });
  });