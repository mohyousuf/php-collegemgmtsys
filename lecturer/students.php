<?php 
include './including/nav.php';
echo '<script>document.username="' . $_SESSION['lecturer_username'] . '"</script>';
?>
  
  <div class="wrapper">

    <div class='table-content'>
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
    </div>
  </div>
  
  <script src="../including/script.js"></script>
  <script>

    loadList('../operator/including/student-list.php','',['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
    
    function rowClick(e){
      e.preventDefault();
      let item2 = document.createElement('div');
      item2.textContent = 'Send Email';
      item2.onclick = () => item2Click(this.object);
      showContext(e, item2);
    }

    function item2Click(object){
      location.assign('mailto:' + object.email);
    }



    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('../operator/including/student-list.php',this.value,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
      }
    }
  </script>
</body>
</html>