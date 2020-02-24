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
          <a class="unchecked" id="s_btn" href="#new-content">NEW ANNOUNCEMENT</a>
          <br><br>
          <input name="title" id='tit' label='TITLE' type="text" class="textbox2" placeholder="Title" >
          <textarea name="msg" id="msg" label='MESSAGE' placeholder="Title" class="textbox2" maxlength='900' cols="30" rows="7" style='resize:none'></textarea>
        </div>
      </form>
      <button name="submit" type="submit" id="btn-add-content" class="btn-dark">SAVE</button>
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
      <input name="etitle" id='etit' label='TITLE' type="text" class="textbox4" placeholder="Title" >
      <textarea name="emsg" id="emsg" label='MESSAGE' placeholder="Title" class="textbox4" maxlength='1000' cols="30" rows="7" style='resize:none'></textarea>

    </div>

    <div>        
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>
    </div>    
  </div>

  <script src="../including/script.js"></script>
  <script>
    let style = document.createElement('style');
    style.innerHTML = 'th:first-child{min-width:200px}td{padding: 15px}';
    document.head.appendChild(style);

    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        title : document.querySelector('[name=title]').value,
        msg : document.querySelector('[name=msg]').value,
      };

      sqlQuery('including/announ-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/announ-list.php',document.querySelector('table').lastSearch,['title','msg'],['TITLE','MESSAGE']);
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
        id : document.querySelector('.slider').value,
        title : document.querySelector('[name=etitle]').value,
        msg : document.querySelector('[name=emsg]').value,
      };

      sqlQuery('including/announ-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/announ-list.php',document.querySelector('table').lastSearch,['title','msg'],['TITLE','MESSAGE']);
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
        id : document.querySelector('.slider').value
      };

      sqlQuery('including/announ-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/announ-list.php',document.querySelector('table').lastSearch,['title','msg'],['TITLE','MESSAGE']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/announ-list.php','',['title','msg'],['TITLE','MESSAGE']);
    
    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      item1.textContent = 'Edit';
      item1.onclick = () => item1Click(this.object);
      showContext(e, item1);
    }
    
    function item1Click(object){
      document.querySelector('.slider').value = object.id;
      document.querySelector('[name=etitle]').value = object.title;
      document.querySelector('[name=emsg]').value = object.msg;
      showSlider1();
    }

    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/announ-list.php',this.value,['title','msg'],['TITLE','MESSAGE']);
      }
    }
  </script>
</body>
</html>