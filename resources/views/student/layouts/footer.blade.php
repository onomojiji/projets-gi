<hr>
<footer class="py-5 bg-light text-center">
    Copyright &copy; <a href="http://onomojb.000webhostapp.com" target="_blank" rel="noopener noreferrer">{{__("onomo_jb")}}</a>
    <span id="date"></span>
    Tous droits reservés.
</footer>

<script>
  var today = new Date();
  var date = today.getFullYear()
  if(date==2022){
    document.getElementById("date").innerHTML=2022
  }else{
    document.getElementById("date").innerHTML="2022 - " + date;
  }

</script>