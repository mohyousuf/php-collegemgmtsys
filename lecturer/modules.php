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

    loadList('../operator/including/module-list.php','',['module_id','title'],['ID','TITLE']);

    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('../operator/including/module-list.php',this.value,['module_id','title'],['ID','TITLE']);
      }
    }

    function rowClick(){}
  </script>
</body>
</html>