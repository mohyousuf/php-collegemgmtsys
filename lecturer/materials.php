<?php 
include './including/nav.php';
include '../including/sql_connection.php';

echo '<script>document.username="' . $_SESSION['lecturer_username'] . '"</script>';
$sql = "SELECT * FROM module";
?>

  <div class="wrapper">

    <div id="new-content">
      <form>
        <div class="new-content-field">
          <a class="unchecked" id="s_btn" href="#new-content">UPLOAD MATERIAL</a>
          <br><br><br>
          <div class="dropbox">
            <p>DRAG AND DROP THE MATERIAL HERE</p>
          </div>
          <input id="title" name="title" label='TITLE' type="text" class="textbox2" placeholder="Assignment Brief II" >
          <div name="module_id" class="yuz-select" id='mid' label='MODULE' placeholder='Select the module that you want to assign this material to...'>
            <?php
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) 
            {
              echo "<span value='" . $row['module_id'] . "'>" . $row['module_id'] . " : " . $row['title'] . "</span>";
            }
            ?>
          </div>
          <br>
        </div>
      </form>
      <button name="submit" type="button" id="btn-add-content" class="btn-dark">UPLOAD</button>
    </div>
    
    <div class='table-content'>
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
      <table>
        <thead>
          <tr>
            <th>MATERIAL</th>
            <th>ASSIGNED MODULE</th>
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
      <input id='etitle' label='TITLE' name="etitle" type="text" class="textbox4" placeholder="" >
      <div class="yuz-select" name="emid" id='emid' label='ASSIGNED MODULE'>
      <?php
        $sql = 'SELECT * FROM module';
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)) 
        {
        echo "<span value='" . $row['module_id'] . "'>" . $row['module_id'] . " " . $row['title'] . "</span>";
        }
      ?>
      </div>
    </div>

    <div>
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>
    </div>
  </div>

  <script src='../including/script.js'></script>
  <script>
  let dropbox;

  dropbox = document.querySelector(".dropbox");
  dropbox.addEventListener("dragenter", dragenter, false);
  dropbox.addEventListener("dragover", dragover, false);
  dropbox.addEventListener("drop", drop, false);
  function dragenter(e) {
    e.stopPropagation();
    e.preventDefault();
  }
  function dragover(e) {
    e.stopPropagation();
    e.preventDefault();
    this.textContent = "DROP THE MATERIAL HERE";
    this.classList.add('drag');
  }

  function drop(e) {
    e.stopPropagation();
    e.preventDefault();
    this.classList.remove('drag');
    var file = e.dataTransfer.files;
    if(file[0].type == ''){
      alert('Invalid');
      return;
    }
    dropbox.textContent = e.dataTransfer.files[0].name;
    dropbox.files = e.dataTransfer.files;
  }

  let mid = document.querySelector('#mid');
  let title = document.querySelector('#title');
  document.querySelector('[name=submit]').onclick = function(){
    if(!mid.value){
      showError('Please select a module!');
      return;
    }
    if(!title.value){
      showError('Please enter a title!');
      return;
    }
    if(dropbox.files){
      let request = new XMLHttpRequest();
      let formData = new FormData();
      
      request.open('POST','../operator/including/material-add.php',true);
      formData.append('file', dropbox.files[0]);
      formData.append('module_id', mid.value);
      formData.append('title', title.value);
      request.send(formData);
      request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
          let json = JSON.parse(request.response);
          if(json.error){
            showError(json.error);
          }
          else if(json.success){
            showSuccess("Material uploaded");
            document.search ? load(document.search) : load('');
            dropbox.files = '';
            dropbox.textContent = 'DRAG AND DROP THE MATERIAL HERE';
            clearFields();
          }
        }
      };
    }
    else
      showError('Please drag and drop the material');
  }


    
  load('');
  function load(search){
    sqlQuery('../operator/including/material-list.php',{search:search},()=>{
      document.querySelectorAll('tbody > tr').forEach(item => item.remove());
      let json = response;
      let tbody = document.querySelector('tbody');
      let columns = ['title','module'];
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
    a.href = '../materials/' + link;
    a.download = link;
    a.click();
  }

  function rowClick(e){
    e.preventDefault();
    let item1 = document.createElement('div');
    item1.textContent = 'Download';
    let item2 = document.createElement('div');
    item2.textContent = 'Edit';
    item2.onclick = ()=> item2Click(this.object);

    item1.onclick = () => {
      let link = e.target.parentElement.object.file;
      let a = document.createElement('a');
      a.href = '../materials/' + link;
      a.download = link;
      a.click();
    };
    showContext(e, item2, item1);
  }

  function item2Click(object){
    showSlider1();
    document.querySelector('#slider').value = object;
    selectInSelect(document.querySelector('#emid').parentElement, object.module_id);
    document.querySelector('#etitle').value = object.title;
  }

  let search = document.querySelector('#searchBar');
  search.addEventListener('keydown',(e)=>{
    if(e.keyCode == 13){
      load(search.value);
    }
  });

  document.querySelector('[name=save]').onclick = () => {
      var ob = {
        id : document.querySelector('#slider').value.id,
        module_id : document.querySelector('[name=emid]').value,
        title : document.querySelector('[name=etitle]').value
      };

      sqlQuery('../operator/including/material-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          hideSliders();
          clearFields();
          document.search ? load(document.search) : load('');
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    document.querySelector('[name=delete]').onclick = () => {
      var ob = {
        id : document.querySelector('#slider').value.id
      };

      sqlQuery('../operator/including/material-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          hideSliders();
          clearFields();
          document.search ? load(document.search) : load('');
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

  </script>

</body>
</html>
