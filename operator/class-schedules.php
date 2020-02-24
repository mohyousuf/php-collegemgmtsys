<?php 
include './including/nav.php';
?>
  
  <div class="wrapper">
  
    <div class="message-wrapper">
      <!--<div class="error">
        Please enter a valid email address!
      </div>-->
    </div>
  
    <div id="new-content">
      <form>
        <div class="new-content-field">
          <a class="unchecked" id="s_btn" href="#new-content">NEW CLASS SCHEDULE</a>
          <div class="yuz-select" name="batch_id" id='bid' label='BATCH'>
            <?php
              $sql = 'SELECT * FROM batch';
              $result = mysqli_query($con, $sql);
              while($row = mysqli_fetch_assoc($result)) 
              {
                echo "<span value='" . $row['batch_id'] . "'>" . $row['batch_id'] . "</span>";
              }
            ?>
          </div>

          <div class="yuz-select" name="l_uname" id='uname' label='LECTURER'>
            <?php
              $sql = 'SELECT * FROM lecturer';
              $result = mysqli_query($con, $sql);
              while($row = mysqli_fetch_assoc($result)) 
              {
                echo "<span value='" . $row['uname'] . "'>" . $row['fname'] . " " . $row['lname'] . " (" . $row['uname'] . ")" . "</span>";
              }
            ?>
          </div>

          <div class="yuz-select" name="day" id='day' label='DAY'>
            <span>Monday</span>
            <span>Tuesday</span>
            <span>Wednesday</span>
            <span>Thursday</span>
            <span>Friday</span>
            <span>Saturday</span>
            <span>Sunday</span>
          </div>

          <input name="time" type="time" class="textbox2" id='time' label="TIME">
          
          <br><br>
        </div>
        <button name="submit" type="button" id="btn-add-content" class="btn-dark">SAVE</button>
      </form>
    </div>
  
    
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

  <div id="slider" class="slider hide">
    <div>
      <h1></h1>
      <h1>EDIT</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>

    <div>
        <div class="yuz-select" name="ebatch_id" id='ebid' label='BATCH'>
        <?php
          $sql = 'SELECT * FROM batch';
          $result = mysqli_query($con, $sql);
          while($row = mysqli_fetch_assoc($result)) 
          {
            echo "<span value='" . $row['batch_id'] . "'>" . $row['batch_id'] . "</span>";
          }
        ?>
        </div>
          
        <div class="yuz-select" name="el_uname" id='euname' label='LECTURER'>
        <?php
          $sql = 'SELECT * FROM lecturer';
          $result = mysqli_query($con, $sql);
          while($row = mysqli_fetch_assoc($result)) 
          {
            echo "<span value='" . $row['uname'] . "'>" . $row['fname'] . " " . $row['lname'] . " (" . $row['uname'] . ")" . "</span>";
          }
        ?>
        </div>

        <div class="yuz-select" name="eday" id='eday' label='DAY'>
          <span value="Monday">Monday</span>
          <span value="Tuesday">Tuesday</span>
          <span value="Wednesday">Wednesday</span>
          <span value="Thursday">Thursday</span>
          <span value="Friday">Friday</span>
          <span value="Saturday">Saturday</span>
          <span value="Sunday">Sunday</span>
        </div>

        <input name="etime" type="time" class="textbox4" id='etime' label="TIME">
      </div>

      <div>
        <button class="btn-dark" name='delete'>DELETE</button>
        <button class="btn-light" name='save'>SAVE</button>
      </div>

  </div>

  <div id="slider2" class="slider hide">
    <div class="slider-controls">
      <h1></h1>  
      <h1>STUDENTS</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>

    <div class="schedule-card-dark-container">

    </div>
  </div>


  <script src="../including/script.js"></script>
  <script>

    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        batch_id : document.querySelector('[name=batch_id]').value,
        l_uname : document.querySelector('[name=l_uname]').value,
        day : document.querySelector('[name=day]').value,
        time : document.querySelector('[name=time]').value    
      };

      sqlQuery('including/schedule-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadCard('including/schedule-list.php',document.lastSearch);
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    document.querySelector('[name=save]').onclick = () => {
      let slider = document.querySelector('.slider');
      var ob = {
        batch_id : slider.object.batch_id,
        l_uname : slider.object.l_uname,
        day : slider.object.day,
        time : slider.object.time,
        newbatch_id : document.querySelector('[name=ebatch_id]').value,
        newl_uname : document.querySelector('[name=el_uname]').value,
        newday : document.querySelector('[name=eday]').value,
        newtime : document.querySelector('[name=etime').value
      };

      sqlQuery('including/schedule-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadCard('including/schedule-list.php',document.lastSearch);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    document.querySelector('[name=delete]').onclick = () => {
      let slider = document.querySelector('.slider');
      var ob = {
        batch_id : slider.object.batch_id,
        l_uname : slider.object.l_uname,
        day : slider.object.day,
        time : slider.object.time
      };

      sqlQuery('including/schedule-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadCard('including/schedule-list.php',document.lastSearch);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadCard('including/schedule-list.php','');
    
    function leftClick(){
      item2Click(this.object);
    }

    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      let item2 = document.createElement('div');
      item1.textContent = 'Edit';
      item2.textContent = 'View Students';
      item1.onclick = () => item1Click(this.object);
      item2.onclick = () => item2Click(this.object);
      showContext(e, item1, item2);
    }
    
    function item1Click(object){
      document.querySelector('.slider').object = object;
      selectInSelect(document.querySelector('[name=ebatch_id]').parentElement, object.batch_id);
      selectInSelect(document.querySelector('[name=el_uname]').parentElement, object.l_uname);
      selectInSelect(document.querySelector('[name=eday]').parentElement, object.day);
      document.querySelector('[name=etime]').value = object.time;
      showSlider1();
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
        loadCard('including/schedule-list.php',this.value);
      }
    }
  </script>
</body>
</html>
