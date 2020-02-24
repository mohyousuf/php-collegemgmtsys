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
          <a class="unchecked" id="s_btn" href="#new-content">NEW COURSE</a>
          <input id="cid" name="course_id" label='ID' type="text" class="textbox2" placeholder="C99" >
          <input id="tit" name="title" label='TITLE' type="text" class="textbox2" placeholder="Computer Science" >
          <input id="dur" name="duration"  label='DURATION' type="text" class="textbox2" placeholder="36" >
          <input id="moduleid" label="MODULES" name="module" type="text" class="textbox2" placeholder="Seperate each module by ',' (comma)   example: M660,M700,M1040" >
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
      <input id="ecid" name="ecourse_id" label='ID' type="text" class="textbox4" placeholder="C99" >
      <input id="etit" name="etitle" label='TITLE' type="text" class="textbox4" placeholder="Computer Science" >
      <input id="edur" name="eduration" label='DURATION'  type="text" class="textbox4" placeholder="36" >
      <input id="emoduleid" label="MODULE ID(s)" name="emodule" type="text" class="textbox4" placeholder="Seperate each module by ',' (comma)    example: M660,M700,M1040" >

    </div>

    <div>
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>
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
    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        course_id : document.querySelector('[name=course_id]').value,
        title : document.querySelector('[name=title]').value,
        duration : document.querySelector('[name=duration]').value,
        module : document.querySelector('[name=module]').value
      };

      sqlQuery('including/course-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/course-list.php',document.querySelector('table').lastSearch,['course_id','title','duration'],['ID','TITLE','DURATION']);
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
        course_id : document.querySelector('.slider').value,
        newcourse_id : document.querySelector('[name=ecourse_id]').value,
        title : document.querySelector('[name=etitle]').value,
        duration : document.querySelector('[name=eduration]').value,
        module : document.querySelector('[name=emodule]').value
      };

      sqlQuery('including/course-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/course-list.php',document.querySelector('table').lastSearch,['course_id','title','duration'],['ID','TITLE','DURATION']);
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
        course_id : document.querySelector('.slider').value
      };

      sqlQuery('including/course-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/course-list.php',document.querySelector('table').lastSearch,['course_id','title','duration'],['ID','TITLE','DURATION']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/course-list.php','',['course_id','title','duration'],['ID','TITLE','DURATION']);

    function rowClick(e){      
      e.preventDefault();
      let item1 = document.createElement('div');
      let item2 = document.createElement('div');
      item1.textContent = 'Edit';
      item2.textContent = 'View Modules';
      item1.onclick = () => item1Click(this.object);
      item2.onclick = () => item2Click(this.object);
      showContext(e, item1, item2);
    }

    function itemLoad(object)
    {
      document.querySelector('.slider').value = object.course_id;
      document.querySelector('[name=ecourse_id]').value = object.course_id;
      document.querySelector('[name=etitle]').value = object.title;
      document.querySelector('[name=eduration]').value = object.duration;

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
      document.querySelector('[name=emodule]').value = modules.join(',')
    }

    function item1Click(object){
      itemLoad(object);
      showSlider1();
    }
    
    function item2Click(object){
      itemLoad(object);
      showSlider2();
    }

    
    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/course-list.php',this.value,['course_id','title','duration'],['ID','TITLE','DURATION']);
      }
    }
  </script>
</body>
</html>