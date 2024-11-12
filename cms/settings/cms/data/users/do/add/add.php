<?php ?>

<form method="post" action="/settings/cms/data/users/do/add/base_add.php" id="form_user_add">
    <div id="form_add">
        <div id="inputy">
<input type="text" placeholder="login" name="login" id="log_add" autocomplete="off" class="add_in" required>
<input type="text" placeholder="password" name="password" id="pass_add" autocomplete="off" class="add_in" required>
<input type="text" placeholder="e-mail" name="email" id="mail_add" autocomplete="off" class="add_in" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
</div>
<div id="prev">
    <h1>Poziom uprawnień:</h1>
bloger:<input type="radio" name="prevl" value="1" id="v1"><br>
edytor:<input type="radio" name="prevl" value="2" id="v2"><br>
admin:<input type="radio" name="prevl" value="3" id="v3"><br>
</div>
<div id="buttony">
<input type="submit" class="add_button" value="Dodaj urzytkownika" id="add_sub">
<input type="reset" class="add_button" value="Reset" id="res">
</div>
</div>
<div id="error"></div><div id="success"></div>
</form>

<script type="text/javascript">
   $("#form_user_add").submit(function(){
      $.ajax({
         url:"/settings/cms/data/users/do/add/base_add.php",
         type:"POST",
         data:$("#form_user_add").serialize(),
         cache: false,
         success: function(back){
            document.getElementById("error").innerHTML=back;
            document.getElementById("success").innerHTML="";
            $("#form_user_add")[0].reset();
            if(back == "użytkownik został dodany"){
               document.getElementById("error").innerHTML="";
               document.getElementById("success").innerHTML=back;
            };
         }
      });
      return false;
   });
   $("#res").click(function(){
    document.getElementById("error").innerHTML="";
    document.getElementById("success").innerHTML="";
   });
</script>
<?php ?>