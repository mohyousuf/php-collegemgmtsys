<?php 
include './including/nav.php';
echo '<script>document.username="' . $_SESSION['lecturer_username'] . '"</script>';
?>
  
  <div class="wrapper">

    <div class='table-content'>
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
    </div>
  </div>

  <div id="slider2" class="slider hide">
    <div class="slider-controls">
      <h1></h1>  
      <h1>MODULES</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>
    <div class="schedule-card-dark-container">

    </div>
    
  </div>


  <script src="../including/script.js"></script>
  <script>
    loadList('../operator/including/course-list.php','',['course_id','title','duration'],['ID','TITLE','DURATION']);

    function rowClick(e){      
      e.preventDefault();
      let item2 = document.createElement('div');
      item2.textContent = 'View Modules';
      item2.onclick = () => item2Click(this.object);
      showContext(e, item2);
    }

    function itemLoad(object)
    {
      let modules = Array();
      document.querySelectorAll('#slider2 .schedule-card-dark').forEach(item => item.remove());
      for(let i=0; i< Object.keys(object.module).length; i++){
        modules.push(object.module[i].module_id);

        let card = document.createElement('div');
        card.setAttribute('class','schedule-card-dark borrow-list');

        let title = document.createElement('div');
        title.className = 'day';
        title.textContent = object.module[i].title;
        let module_id = document.createElement('div');
        module_id.className = 'time';
        module_id.textContent = object.module[i].module_id;

        card.appendChild(title);
        card.appendChild(module_id);

        document.querySelector('#slider2 .schedule-card-dark-container').appendChild(card);

      }
    }
    
    function item2Click(object){
      itemLoad(object);
      showSlider2();
    }

    
    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('../operator/including/course-list.php',this.value,['course_id','title','duration'],['ID','TITLE','DURATION']);
      }
    }
  </script>
</body>
</html>