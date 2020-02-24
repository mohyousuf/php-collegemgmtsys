<?php 
include './including/nav.php';
?>
  
  <!--<div class="context">
    <div>Jeff</div>
    <div>Hardy</div>
  </div>
  -->

  <div class="wrapper">
  
    <div class="message-wrapper">
      <!--<div class="error">
        Please enter a valid email address!
      </div>-->
    </div>
  
    <div id="new-content">
      <form>
        <div class="new-content-field">
          <a class="unchecked" id="s_btn" href="#new-content">NEW STUDENT</a>
          <input id="fname" label="FIRST NAME" name="fname" type="text" class="textbox2" placeholder="John" >
          <input id="lname" label="LAST NAME" name="lname" type="text" class="textbox2" placeholder="Doe" >
          <input id="dob" label="DATE OF BIRTH" name="dob" type="date" class="textbox2" placeholder="Date of Birth" >
          <input id="address" label="ADDRESS" name="address" type="text" class="textbox2" placeholder="No. 7, Prince Street, Colombo 04" >
          <input id="email" label="EMAIL" name="email" type="email" class="textbox2" placeholder="example@cms.com" >
          <input id="phone" label="PHONE" name="phone" type="text" class="textbox2" placeholder="+94 70 123 4567" >
          <input id="uname" label="USERNAME" name="uname" type="text" class="textbox2" placeholder="yuziferr" >
          <input id="pass" label="PASSWORD" name="pass" type="password" class="textbox2" placeholder="Preferably a strong password" >
          <input id="batch" label="BATCH" name="batch" type="text" class="textbox2" placeholder="Seperate by ',' (comma) to add multiple batches">
          <br>
          <br>
        </div>
        <button name="submit" type="button" id="btn-add-content" class="btn-dark">SAVE</button>
      </form>
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
    <div >
      <input id="efname" label="FIRST NAME" name="efname" type="text" class="textbox4" placeholder="John">
      <input id="elname" label="LAST NAME"  name="elname" type="text" class="textbox4" placeholder="Doe">
      <input id="edob" label="DATE OF BIRTH"  name="edob" type="date" class="textbox4" placeholder="Date of Birth">
      <input id="eaddress" label="ADDRESS"  name="eaddress" type="text" class="textbox4" placeholder="No. 7, Prince Street, Colombo 04">
      <input id="eemail" label="EMAIL"  name="eemail" type="email" class="textbox4" placeholder="example@cms.com">
      <input id="ephone" label="PHONE"  name="ephone" type="text" class="textbox4" placeholder="+94 70 123 4567">
      <input id="euname" label="USERNAME"  name="euname" type="text" class="textbox4" placeholder="yuziferr">
      <input id="epass" label="PASSWORD"  name="epass" type="password" class="textbox4" placeholder="Preferably a strong password">
      <input id="ebatch" label="BATCH"  name="ebatch" type="text" class="textbox4" placeholder="Seperate by ',' (comma) to add multiple batches">
    </div>
    <div>
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>
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
        batch : document.querySelector('[name=batch]').value
      };
      //console.log(ob);
      sqlQuery('including/student-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/student-list.php',document.querySelector('table').lastSearch,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
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
        batch : document.querySelector('[name=ebatch]').value
      };

      sqlQuery('including/student-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/student-list.php',document.querySelector('table').lastSearch,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
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

      sqlQuery('including/student-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/student-list.php',document.querySelector('table').lastSearch,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/student-list.php','',['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
    
    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      let item2 = document.createElement('div');
      item1.textContent = 'Edit';
      item2.textContent = 'Send Email';
      item1.onclick = () => item1Click(this.object);
      item2.onclick = () => item2Click(this.object);
      showContext(e, item1, item2);
    }

    function item1Click(object){
      document.querySelector('#slider').classList.remove('hide');
      document.querySelector('.slider').value = object.uname;
      document.querySelector('[name=efname]').value = object.fname;
      document.querySelector('[name=elname]').value = object.lname;
      document.querySelector('[name=edob]').value = object.dob;
      document.querySelector('[name=eaddress]').value = object.address;
      document.querySelector('[name=eemail]').value = object.email;
      document.querySelector('[name=ephone]').value = object.phone;
      document.querySelector('[name=euname]').value = object.uname;
      document.querySelector('[name=epass]').value = object.pass;
      document.querySelector('[name=ebatch]').value = object.batch.join(',');
    }

    function item2Click(object){
      location.assign('mailto:' + object.email);
    }



    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/student-list.php',this.value,['uname','fname','lname','email'],['Username','First Name','Last Name','E-Mail']);
      }
    }
  </script>
</body>
</html>