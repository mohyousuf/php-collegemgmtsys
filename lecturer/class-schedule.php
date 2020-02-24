<?php 
include './including/nav.php';
echo '<script>document.username="' . $_SESSION['lecturer_username'] . '"</script>';
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
          <span class="schedule-card-luname">andre29</span>;
        </div>
      </div>-->
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
        var batch = document.createElement('span');
        batch.className = 'schedule-card-batch';
        batch.textContent = row['batch_id'];
        var day = document.createElement('span');
        day.className = 'schedule-card-lect'
        day.textContent = row['day'];
        var footer = document.createElement('div');
        footer.className = 'schedule-card-footer';
        var time = document.createElement('span');
        time.className = 'schedule-card-day';
        time.textContent = row['time'];
        
        card.students = row['students'];
        card.onclick = printStudents;
        card.oncontextmenu = rightClick;
        card.appendChild(batch);
        card.appendChild(day);
        card.appendChild(footer);
        footer.appendChild(time);
        wrapper.appendChild(card);
      }
    });
  }

  function rightClick(e){
    e.preventDefault();
    let item1 = document.createElement('div');
    item1.textContent = 'View Students';
    item1.students = this.students;
    item1.onclick = printStudents;
    showContext(e, item1);
  }

  function printStudents(){
    showSlider2();
    console.log(this);
    document.querySelectorAll('#slider2 .schedule-card-dark').forEach(item => item.remove());
    if(this.students){
      for(let i=0; i< Object.keys(this.students).length; i++){
        let card = document.createElement('div');
        card.setAttribute('class','schedule-card-dark borrow-list');

        let name = document.createElement('div');
        name.className = 'day';
        name.textContent = this.students[i].fname + ' ' + this.students[i].lname;
        let s_uname = document.createElement('div');
        s_uname.className = 'batch';
        s_uname.textContent = this.students[i].uname;
        let email = document.createElement('div');
        email.className = 'time';
        email.textContent = this.students[i].email;

        card.appendChild(s_uname);
        card.appendChild(name);
        card.appendChild(email);
        document.querySelector('#slider2 .schedule-card-dark-container').appendChild(card);
      }
    }
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


