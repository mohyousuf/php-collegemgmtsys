<?php 
include './including/nav.php';
echo '<script>document.username="' . $_SESSION['student_username'] . '"</script>';
?>
  
  <div class="wrapper">
  
    <div class="schedule-container">
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
      
      <!--<div class="schedule-card">
        <span class="schedule-card-batch">COM100</span>
        <span class="schedule-card-lect">Andrea Iannone</span>
        <div class="schedule-card-footer">
          <span class="schedule-card-day">Monday</span>
          <span class="schedule-card-time">02:50</span>
        </div>
      </div>
    </div>-->

  </div>

  <script src='../including/script.js'></script>
  <script>
  load(document.username,'');
  function load(uname,search){
    sqlQuery('including/schedule-list.php',{uname:uname,search:search},()=>{
      document.querySelectorAll('.schedule-card').forEach(item => item.remove());
      let json = response;
      console.log(json);
      let wrapper = document.querySelector('.schedule-container');
      for(var row of json){
        var card = document.createElement('div');
        card.className = 'schedule-card';
        card.style.cursor = 'default';
        var batch = document.createElement('span');
        batch.className = 'schedule-card-batch';
        batch.textContent = row['batch_id'];
        var lecturer = document.createElement('span');
        lecturer.className = 'schedule-card-lect'
        lecturer.textContent = row['lecturer'];
        var footer = document.createElement('div');
        footer.className = 'schedule-card-footer';
        var day = document.createElement('span');
        day.className = 'schedule-card-day';
        day.textContent = row['day'];
        var time = document.createElement('span');
        time.className = 'schedule-card-time';
        time.textContent = row['time'];
        
        card.appendChild(batch);
        card.appendChild(lecturer);
        card.appendChild(footer);
        footer.appendChild(day);
        footer.appendChild(time);
        wrapper.appendChild(card);
      }
    });
  }

  let search = document.querySelector('#searchBar');
  search.addEventListener('keydown',(e)=>{
    if(e.keyCode == 13){
      load(document.username,search.value);
    }
  });
  </script>
</body>
</html>
