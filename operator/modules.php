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
      <form id="theForm" method="POST">
        <div class="new-content-field">
          <a class="unchecked" id="s_btn" href="#new-content">NEW MODULE</a>
          <input id='mid' label='ID' name="module_id" type="text" class="textbox2" placeholder="M950" >
          <input id='tit' label='TITLE' name="title" type="text" class="textbox2" placeholder="Introduction to AngularJS" >
          <br><br>
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
      <input id='emid' label='ID' name="emodule_id" type="text" class="textbox4" placeholder="M950" >
      <input id='etit' label='TITLE' name="etitle" type="text" class="textbox4" placeholder="Introduction to AngularJS" >
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
        module_id : document.querySelector('[name=module_id]').value,
        title : document.querySelector('[name=title]').value,
      };

      sqlQuery('including/module-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/module-list.php',document.querySelector('table').lastSearch,['module_id','title'],['ID','TITLE']);
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
        newmodule_id : document.querySelector('[name=emodule_id]').value,
        module_id : document.querySelector('.slider').value,
        title : document.querySelector('[name=etitle]').value
      };

      sqlQuery('including/module-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/module-list.php',document.querySelector('table').lastSearch,['module_id','title'],['ID','TITLE']);
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
        module_id : document.querySelector('.slider').value
      };

      sqlQuery('including/module-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/module-list.php',document.querySelector('table').lastSearch,['module_id','title'],['ID','TITLE']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/module-list.php','',['module_id','title'],['ID','TITLE']);
    
    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      item1.textContent = 'Edit';
      item1.onclick = () => item1Click(this.object);
      showContext(e, item1);
    }
    
    function item1Click(object){
      document.querySelector('.slider').value = object.module_id;
      document.querySelector('[name=emodule_id]').value = object.module_id;
      document.querySelector('[name=etitle]').value = object.title;
      showSlider1();
    }

    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/module-list.php',this.value,['module_id','title'],['ID','TITLE']);
      }
    }
  </script>
</body>
</html>