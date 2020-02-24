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
          <a class="unchecked" id="s_btn" href="#new-content">NEW LECTURER</a>
          <input id="fname" placeholder="John" name="fname" type="text" class="textbox2" label="FIRST NAME" >
          <input id="lname" placeholder="Doe" name="lname" type="text" class="textbox2" label="LAST NAME" >
          <input id="dob" Name="dob" type="date" class="textbox2" label="DATE OF BIRTH" >
          <input id="address" placeholder="No. 7, Prince Street, Colombo 07" name="address" type="text" class="textbox2" label="ADDRESS" >
          <input id="email" placeholder="example@cms.com" name="email" type="email" class="textbox2" label="EMAIL" >
          <input id="phone" placeholder="+94 70 123 4567" name="phone" type="text" class="textbox2" label="PHONE" >
          <input id="uname" placeholder="yuziferr" name="uname" type="text" class="textbox2" label="USERNAME" >
          <input id="pass" placeholder="Preferably a strong password!" name="pass" type="password" class="textbox2" label="PASSWORD" >
          <br><br>
        </div>
        <button name="submit" type="button" id="btn-add-content" class="btn-dark">SAVE</button>
      </form>
    </div>

    <div class='table-content'>
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
    </div>
  </div>

  <div id="slider" class="slider hide">
    <div class="slider-controls">
      <h1></h1>
      <h1>EDIT</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>

    <div>
      <input id="efname" placeholder="John" name="efname" type="text" class="textbox4" label="FIRST NAME">
      <input id="elname" placeholder="Doe" name="elname" type="text" class="textbox4" label="LAST NAME">
      <input id="edob" name="edob" type="date" class="textbox4" label="DATE OF BIRTH">
      <input id="eaddress" placeholder="No. 7, Prince Street, Colombo 07" name="eaddress" type="text" class="textbox4" label="ADDRESS">
      <input id="eemail" placeholder="example@cms.com" name="eemail" type="email" class="textbox4" label="EMAIL">
      <input id="ephone" placeholder="+94 70 123 4567" name="ephone" type="text" class="textbox4" label="PHONE">
      <input id="euname" placeholder="yuziferr" name="euname" type="text" class="textbox4" label="USERNAME">
      <input id="epass" placeholder="Preferably a strong password!" name="epass" type="password" class="textbox4" label="PASSWORD">
    </div>
    <div>
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>
    </div>
  </div>

  <div id="slider2" class="slider hide">
    <div>
      <h1></h1>
      <h1>CLASS SCHEDULES</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>
    
    <div>
      <div class="schedule-card-dark-container">
        <div class="schedule-card-dark">
          <span class="batch">COM100</span>
          <span class="day">Monday</span>
          <span class="time">02:50</span>
        </div>
      </div>
    </div>
  </div>


  <script src="../including/script.js"></script>
  <script>
    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        fname : document.querySelector('[name=fname]').value,
        lname : document.querySelector('[name=lname]').value,
        dob : document.querySelector('[name=dob]').value,
        address : document.querySelector('[name=address]').value,
        email : document.querySelector('[name=email]').value,
        phone : document.querySelector('[name=phone]').value,
        uname : document.querySelector('[name=uname]').value,
        pass : document.querySelector('[name=pass]').value,        
      };

      sqlQuery('including/lecturer-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/lecturer-list.php',document.querySelector('table').lastSearch,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
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
        fname : document.querySelector('[name=efname]').value,
        lname : document.querySelector('[name=elname]').value,
        dob : document.querySelector('[name=edob]').value,
        address : document.querySelector('[name=eaddress]').value,
        email : document.querySelector('[name=eemail]').value,
        phone : document.querySelector('[name=ephone]').value,
        newuname : document.querySelector('[name=euname]').value,
        uname : document.querySelector('.slider').value,
        pass : document.querySelector('[name=epass]').value,
      };

      sqlQuery('including/lecturer-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/lecturer-list.php',document.querySelector('table').lastSearch,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
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
        uname : document.querySelector('.slider').value
      };

      sqlQuery('including/lecturer-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/lecturer-list.php',document.querySelector('table').lastSearch,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/lecturer-list.php','',['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
    
    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      let item2 = document.createElement('div');
      let item3 = document.createElement('div');
      item1.textContent = 'Edit';
      item2.textContent = 'Class Schedules';
      item3.textContent = 'Send Email';
      item1.onclick = () => item1Click(this.object);
      item2.onclick = () => item2Click(this.object);
      item3.onclick = () => item3Click(this.object);
      showContext(e, item1, item2, item3);
    }

    function item1Click(object){
      showSlider1();
      document.querySelector('.slider').value = object.uname;
      document.querySelector('[name=efname]').value = object.fname;
      document.querySelector('[name=elname]').value = object.lname;
      document.querySelector('[name=edob]').value = object.dob;
      document.querySelector('[name=eaddress]').value = object.address;
      document.querySelector('[name=eemail]').value = object.email;
      document.querySelector('[name=ephone]').value = object.phone;
      document.querySelector('[name=euname]').value = object.uname;
      document.querySelector('[name=epass]').value = object.pass;
    }
    
    function item3Click(object){
      location.assign('mailto:' + object.email);
    }

    function item2Click(object){
      document.querySelectorAll('#slider2 .schedule-card-dark').forEach(item => item.remove());
      if(object.schedule)
      {
        for(let i=0; i< Object.keys(object.schedule).length; i++){
          let card = document.createElement('div');
          card.className = 'schedule-card-dark';
          let batch = document.createElement('div');
          batch.className = 'batch';
          batch.textContent = object.schedule[i].batch_id;
          let day = document.createElement('div');
          day.className = 'day';
          day.textContent = object.schedule[i].day;
          let time = document.createElement('div');
          time.className = 'time';
          time.textContent = object.schedule[i].time;

          card.appendChild(batch);
          card.appendChild(day);
          card.appendChild(time);

          document.querySelector('#slider2 .schedule-card-dark-container').appendChild(card);
        }
      }
      showSlider2();
    }

    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/lecturer-list.php',this.value,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
      }
    }
  </script>

</body>
</html>

