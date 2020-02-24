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
          <a class="unchecked" id="s_btn" href="#new-content">NEW BATCH</a>
          <input name="batch_id" type="text" class="textbox2" label="BATCH" id='bid' placeholder="eg: (COM150, COM200)" >
          <div name="course_id" id="cid" class="yuz-select" label="COURSE" placeholder='Select course...'>
            <?php
              $sql = 'SELECT * FROM course';
              $result = mysqli_query($con, $sql);
              while($row = mysqli_fetch_assoc($result)) 
              {
                echo "<span value='" . $row['course_id'] . "'>" . $row['course_id'] . ": " . $row['title'] . "</span>";
              }
              ?>
          </div>
          <br><br>
        </div>
      </form>
      <button name="submit" type="button" id="btn-add-content" class="btn-dark">SAVE</button>
    </div>

    <div class='table-content'>
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
    </div>
  </div>

  <div id="slider" class="slider hide">
    <div>
      <h1></h1>
      <h1>EDIT</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>

    <div>
      <input name="ebatch_id" type="text" class="textbox4" label="BATCH" id='ebid' placeholder="eg: (COM150, COM200)" >
      <!--<select name="ecourse_id" class="textbox4" label="COURSE" id='ecid'>
        <?php
          /*$sql = 'SELECT * FROM course';
          $result = mysqli_query($con, $sql);
          while($row = mysqli_fetch_assoc($result)) 
          {
            echo "<option value='" . $row['course_id'] . "'>" . $row['course_id'] . ": " . $row['title'] . "</td>";
          }*/
        ?>
      </select>-->
      <div name="ecourse_id" id="ecid" class="yuz-select" label="COURSE">
        <?php
          $sql = 'SELECT * FROM course';
          $result = mysqli_query($con, $sql);
          while($row = mysqli_fetch_assoc($result)) 
          {
            echo "<span value='" . $row['course_id'] . "'>" . $row['course_id'] . ": " . $row['title'] . "</span>";
          }
        ?>
      </div>
    </div>
    
    <div>
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>
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
    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        batch_id : document.querySelector('[name=batch_id]').value,
        course_id : document.querySelector('[name=course_id]').value,
      };

      sqlQuery('including/batch-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/batch-list.php',document.querySelector('table').lastSearch,['batch_id','course'],['BATCH','COURSE']);
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    document.querySelector('[name=save]').onclick = () => {
      var ob = {
        newbatch_id : document.querySelector('[name=ebatch_id]').value,
        batch_id : document.querySelector('.slider').value,
        course_id : document.querySelector('[name=ecourse_id]').value
      };

      sqlQuery('including/batch-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/batch-list.php',document.querySelector('table').lastSearch,['batch_id','course'],['BATCH','COURSE']);
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
      var ob = {
        batch_id : document.querySelector('.slider').value
      };

      sqlQuery('including/batch-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/batch-list.php',document.querySelector('table').lastSearch,['batch_id','course'],['BATCH','COURSE']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/batch-list.php','',['batch_id','course'],['BATCH','COURSE']);
    
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
      document.querySelector('.slider').value = object.batch_id;
      document.querySelector('[name=ebatch_id]').value = object.batch_id;
      selectInSelect(document.querySelector('[name=ecourse_id]').parentElement, object.course_id);
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
        loadList('including/batch-list.php',this.value,['batch_id','course'],['BATCH','COURSE']);
      }
    }
  </script>
</body>
</html>