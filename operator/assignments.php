<?php 
include './including/nav.php';
include '../including/sql_connection.php';
?>
  
  <div class="message-wrapper">

  </div>

  <div class="wrapper">
    
    <div class='table-content'>
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
      <table>
        <thead>
          <tr>
            <th>BATCH</th>
            <th>MODULE</th>
            <th>ASSIGNMENT TITLE</th>
            <th>STUDENT</th>
            <th>DATE</th>
            <th></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <div id="slider" class="slider hide">
    <div>
      <h1></h1>
      <h1>EDIT</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>

    <div>
      <input disabled id="ebatch" name="ebatch" label='BATCH' type="text" class="textbox4" placeholder="C99" >
      <input disabled id="emodule" name="emodule" label='MODULE' type="text" class="textbox4" placeholder="Computer Science" >
      <input disabled id="etitle" name="etitle" label='TITLE'  type="text" class="textbox4" placeholder="36" >
      <input disabled id="estudent" name="estudent" label='STUDENT'  type="text" class="textbox4" placeholder="36" >
      <input disabled id="edate" label="DATE" name="edate" type="text" class="textbox4" placeholder="Seperate each module by ',' (comma)    example: M660,M700,M1040" >

    </div>

    <div>
      <button class="btn-dark" name='delete' style='grid-column-start:1;grid-column-end:3'>DELETE</button>
    </div>
  </div>

  <script src='../including/script.js'></script>
  <script>

  load('');
  function load(search){
    sqlQuery('including/assignment-list.php',{search:search},()=>{
      document.querySelectorAll('tbody > tr').forEach(item => item.remove());
      let json = response;
      let tbody = document.querySelector('tbody');
      let columns = ['batch','module','title','student','date']
      for(var row of json){
        document.search = search;
        var tr = document.createElement('tr');
        for(let i=0; i < columns.length; i++){
            var td = document.createElement('td');
            td.textContent = row[columns[i]];
            tr.appendChild(td);
            tr.object = row;
            tr.oncontextmenu = rowClick;
        }
        var td = document.createElement('td');
        let button = document.createElement('button');
        button.textContent = 'DOWNLOAD';
        button.onclick = download;
        td.appendChild(button);
        tr.appendChild(td);
        tr.object = row;
        tbody.appendChild(tr);
      }
    });
  }

  function download(){
    let link = this.parentElement.parentElement.object.file;
    let a = document.createElement('a');
    a.href = '../assignments/' + link;
    a.download = link;
    a.click();
  }

  function rowClick(e){
    e.preventDefault();
    let item1 = document.createElement('div');
    item1.textContent = 'Download';
    let item2 = document.createElement('div');
    item2.textContent = 'Edit';

    item1.onclick = () => {
      let link = e.target.parentElement.object.file;
      let a = document.createElement('a');
      a.href = '../assignments/' + link;
      a.download = link;
      a.click();
    };

    item2.onclick = () => item2Click(this.object);
    showContext(e, item2, item1);
  }

  function item2Click(object){
    document.querySelector('#slider').value = object;
    document.querySelector('[name=ebatch]').value = object.batch;
    document.querySelector('[name=emodule]').value = object.module;
    document.querySelector('[name=estudent]').value = object.student;
    document.querySelector('[name=etitle]').value = object.title;
    document.querySelector('[name=edate]').value = object.date;
    showSlider1();
  }

  document.querySelector('[name=delete]').onclick = () => {
    var ob = {
        batch_id : document.querySelector('#slider').value.batch_id,
        s_uname : document.querySelector('#slider').value.s_uname,
        module_id : document.querySelector('#slider').value.module_id,
        title : document.querySelector('#slider').value.title
      };

      sqlQuery('including/assignment-delete.php', ob, ()=>{
      if(response.success)
      {
        showSuccess(response.success);
        document.search ? load(document.search) : load('');
        hideSliders();
        clearFields();
      }
      else if(response.error)
      {
        showError(response.error);
      }
    });
  }

  let search = document.querySelector('#searchBar');
  search.addEventListener('keydown',(e)=>{
    if(e.keyCode == 13){
      load(search.value);
    }
  });
  </script>

</body>
</html>
