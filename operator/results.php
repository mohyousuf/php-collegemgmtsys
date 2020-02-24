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
          <a class="unchecked" id="s_btn" href="#new-content">NEW RESULT</a>
          <div name="batch_id" class="yuz-select" id='bid' label='BATCH' placeholder='Select batch...'></div>
          <div name="module_id" class="yuz-select" id='mid' label="MODULE" placeholder='Select module...'></div>    
          <div name="s_uname" class="yuz-select" id='uname' label="STUDENT" placeholder='Select student...'></div>    
          <div name="grade" class="yuz-select" id='grade' label="GRADE">
            <span>Distinction</span>
            <span>Merit</span>
            <span>Pass</span>
            <span>Fail</span>
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
      
      
      <input name="ebatch_id" type="text" class="textbox4" disabled id='ebid' label='BATCH' placeholder='BATCH'>
      <input name="emodule_id" type="text" class="textbox4" disabled id='emid' label="MODULE" placeholder='example: M296'>
      <input name="es_uname" type="text" class="textbox4" disabled id='euname' label="STUDENT" placeholder='yuziferr'>
      <div name="egrade" class="yuz-select" label="GRADE" placeholder='Merit' id="egrade" label="GRADE">
        <span>Distinction</span>
        <span>Merit</span>
        <span>Pass</span>
        <span>Fail</span>
      </div>    
      <!--<select name="egrade" class="textbox4" label="GRADE" placeholder='Merit' id="egrade">
        <option value="Distinction">Distinction</option>
        <option value="Merit">Merit</option>
        <option value="Pass">Pass</option>
        <option value="Fail">Fail</option>
      </select>-->
    </div>

    <div>
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>

    </div>
  </div>


  <script src="../including/script.js"></script>
  <script>
    sqlQuery('including/batch-list.php', {search: ''}, ()=>{
      let batchList = response;
      //console.log(batchList);
      let batch = document.querySelector('[name=batch_id]');
      
      for(let x=0; x < Object.keys(batchList).length; x++){
        var option = document.createElement('span');
        option.innerHTML = batchList[x].batch_id + ' (' + batchList[x].course + ')';
        option.setAttribute('value',batchList[x].batch_id);
        batch.appendChild(option);
        if(x == Object.keys(batchList).length-1){ loadModules(batch.value); loadStudents(batch.value); }
      }

      batch.parentElement.oninput = () => {
        loadModules(batch.value);
        loadStudents(batch.value);
      };
    });
    
    var loadModules = batch => {
      sqlQuery('including/module-list-by-batch.php', {batch : batch}, ()=>{
        if(response){
          let moduleList = response;
          let module = document.querySelector('[name=module_id]');
          let moduleItems = document.querySelectorAll('[name=module_id] ~ span');
  
          moduleItems.forEach(item => {
            item.remove();
          })

          selectRefresh(module.parentElement);
          for(let x=0; x < Object.keys(moduleList).length; x++){
            var option = document.createElement('span');
            option.innerHTML = moduleList[x].module_id + ' : ' + moduleList[x].title;
            option.setAttribute('value',moduleList[x].module_id);
            module.parentElement.appendChild(option);
          }
        }
      });
    };

    var loadStudents = batch => {
      sqlQuery('including/student-list.php', {search : ''}, ()=>{
        let studentList = response;
        let s_uname = document.querySelector('[name=s_uname]');
        let s_unameItems = document.querySelectorAll('[name=s_uname] ~ span');
        
        s_unameItems.forEach(item => {
          item.remove();
        })

        selectRefresh(s_uname.parentElement);
        for(let i=0; i < Object.keys(studentList).length; i++){
          studentList[i].batch = studentList[i].batch.filter(item => item.toLowerCase() == batch.toLowerCase());
          if(studentList[i].batch.length > 0){
            var option = document.createElement('span');
            option.innerHTML = studentList[i].fname + ' ' + studentList[i].lname + ' (' + studentList[i].uname + ')' ;
            option.setAttribute('value',studentList[i].uname);
            s_uname.parentElement.appendChild(option);
          }
        }
      });
    };

    
    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        batch_id : document.querySelector('[name=batch_id]').value,
        module_id : document.querySelector('[name=module_id]').value,
        s_uname : document.querySelector('[name=s_uname]').value,
        grade : document.querySelector('[name=grade]').value,
      };

      sqlQuery('including/grade-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/grade-list.php',document.querySelector('table').lastSearch,['batch_id','module','student','grade'],['BATCH','MODULE','STUDENT','GRADE']);
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
        batch_id : document.querySelector('.slider').value.batch_id,
        module_id : document.querySelector('.slider').value.module_id,
        s_uname : document.querySelector('.slider').value.s_uname,
        grade : document.querySelector('[name=egrade]').value
      };

      sqlQuery('including/grade-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/grade-list.php',document.querySelector('table').lastSearch,['batch_id','module','student','grade'],['BATCH','MODULE','STUDENT','GRADE']);
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
        batch_id : document.querySelector('.slider').value.batch_id,
        module_id : document.querySelector('.slider').value.module_id,
        s_uname : document.querySelector('.slider').value.s_uname
      };

      sqlQuery('including/grade-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/grade-list.php',document.querySelector('table').lastSearch,['batch_id','module','student','grade'],['BATCH','MODULE','STUDENT','GRADE']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/grade-list.php','',['batch_id','module','student','grade'],['BATCH','MODULE','STUDENT','GRADE']);
    
    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      item1.textContent = 'Edit';
      item1.onclick = () => item1Click(this.object);
      showContext(e, item1);
    }
    
    function item1Click(object){
      document.querySelector('.slider').value = object;
      document.querySelector('[name=ebatch_id]').value = object.batch_id;
      document.querySelector('[name=emodule_id]').value = object.module_id;
      document.querySelector('[name=es_uname]').value = object.s_uname;
      selectInSelect(document.querySelector('[name=egrade]').parentElement,object.grade);
      showSlider1();
    }

    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/grade-list.php',this.value,['batch_id','module','student','grade'],['BATCH','MODULE','STUDENT','GRADE']);
      }
    }

  </script>
</body>
</html>
