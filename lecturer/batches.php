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
    <div>
      <h1></h1>
      <h1>STUDENTS</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>
    <div class="schedule-card-dark-container">

    </div>
  </div>


  <script src="../including/script.js"></script>
  <script>

    loadList('../operator/including/batch-list.php','',['batch_id','course'],['BATCH','COURSE']);
    
    function rowClick(e){
      e.preventDefault();
      let item2 = document.createElement('div');
      item2.textContent = 'View Students';
      item2.onclick = () => item2Click(this.object);
      showContext(e, item2);
    }
        
    function item2Click(object){
      showSlider2();
      document.querySelectorAll('#slider2 .schedule-card-dark').forEach(item => item.remove());
      if(!object.students){
        return;
      }
      for(let i=0; i < Object.keys(object.students).length; i++){
        let card = document.createElement('div');
        card.setAttribute('class','schedule-card-dark borrow-list');

        let name = document.createElement('div');
        name.className = 'day';
        name.textContent = object.students[i].fname + ' ' + object.students[i].lname;
        let s_uname = document.createElement('div');
        s_uname.className = 'batch';
        s_uname.textContent = object.students[i].s_uname;
        let email = document.createElement('div');
        email.className = 'time';
        email.textContent = object.students[i].email;

        card.object = object.students[i];
        card.appendChild(s_uname);
        card.appendChild(name);
        card.appendChild(email);
        card.oncontextmenu = studentContext;

        document.querySelector('#slider2 .schedule-card-dark-container').appendChild(card);
      }
    }

    function studentContext(e){
      e.preventDefault();
      let item = document.createElement('div');
      item.textContent = 'Send Email';
      item.onclick = () => itemClick(this.object);
      showContext(e, item);
    }

    function itemClick(object){
      location.assign('mailto:' + object.email);
    }



    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('..operator/including/batch-list.php',this.value,['batch_id','course'],['BATCH','COURSE']);
      }
    }
  </script>
</body>
</html>