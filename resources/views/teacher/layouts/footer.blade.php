<hr>
<footer class="main-footer bg-light">
    Copyright &copy; <span id="date"></span> <a href="#" target="_blank" rel="noopener noreferrer">{{__("onomo_jb")}}</a>
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