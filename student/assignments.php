<?php 
include './including/nav.php';
include '../including/sql_connection.php';

echo '<script>document.username="' . $_SESSION['student_username'] . '"</script>';
$username = $_SESSION['student_username'];

$sql = "SELECT * FROM batch_student
INNER JOIN batch ON batch_student.batch_id=batch.batch_id
INNER JOIN course ON batch.course_id=course.course_id
WHERE s_uname='$username'";

$sql2 = "SELECT module.module_id,CONCAT(module.module_id,' : ',module.title)AS module FROM `batch_student`
INNER JOIN batch ON batch_student.batch_id=batch.batch_id
INNER JOIN course ON batch.course_id=course.course_id
INNER JOIN course_module ON course.course_id=course_module.course_id
INNER JOIN module ON course_module.module_id=module.module_id
WHERE batch_student.s_uname='$username'";
?>

  <div class="wrapper">

    <div id="new-content">
      <form>
        <div class="new-content-field">
          <a class="unchecked" id="s_btn" href="#new-content">UPLOAD ASSIGNMENT</a>
          <br><br><br>
          <div class="dropbox">
            <p>DRAG AND DROP YOUR ASSIGNMENT HERE</p>
          </div>
          <div name="batch_id" class="yuz-select" id='bid' label='BATCH' placeholder='Select batch...'>
            <?php
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) 
            {
              echo "<span value='" . $row['batch_id'] . "'>" . $row['batch_id'] . " (" . $row['course_id'] . " : " . $row['title'] . ")" . "</span>";
            }
            ?>
          </div>
          <div name="module_id" class="yuz-select" id='mid' label="MODULE" placeholder='Select module...'>
            <?php
            
            $result = mysqli_query($con, $sql2);
            while($row = mysqli_fetch_assoc($result)) 
            {
              echo "<span value='" . $row['module_id'] . "'>" . $row['module'] . "</span>";
            }
            ?>
          </div>    
          <input id="title" name="title" label='ASSIGNMENT TITLE' type="text" class="textbox2" placeholder="First Chapter" >
        
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
            <th>BATCH</th>
            <th>MODULE</th>
            <th>ASSIGNMENT TITLE</th>
            <th>DATE</th>
            <th></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
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
    this.textContent = "DROP YOUR ASSIGNMENT HERE";
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
  let bid = document.querySelector('#bid');
  let title = document.querySelector('#title');
  document.querySelector('[name=submit]').onclick = function(){
    if(!bid.value){
      showError('Please select a batch!');
      return;
    }
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
      
      request.open('POST','including/assignment-add.php',true);
      formData.append('file', dropbox.files[0]);
      formData.append('batch_id', bid.value);
      formData.append('module_id', mid.value);
      formData.append('title', title.value);
      formData.append('s_uname', document.username);
      request.send(formData);
      request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
          let json = JSON.parse(request.response);
          if(json.error){
            showError(json.error);
          }
          else if(json.success){
            showSuccess(json.success);
            document.search ? load(document.username, document.search) : load(document.username, '');
            dropbox.files = '';
            dropbox.textContent = 'DRAG AND DROP YOUR ASSIGNMENT HERE';
            clearFields();
          }
        }
      };
    }
    else
      showError('Please drag and drop your assignment');
  }


    
  load(document.username,'');
  function load(uname,search){
    sqlQuery('including/assignment-list.php',{uname:uname,search:search},()=>{
      document.querySelectorAll('tbody > tr').forEach(item => item.remove());
      let json = response;
      let tbody = document.querySelector('tbody');
      let columns = ['batch','module','title','date']
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
    item1.onclick = () => {
      let link = e.target.parentElement.object.file;
      let a = document.createElement('a');
      a.href = '../assignments/' + link;
      a.download = link;
      a.click();
    };
    showContext(e, item1);
  }


  let search = document.querySelector('#searchBar');
  search.addEventListener('keydown',(e)=>{
    if(e.keyCode == 13){
      load(document.username,search.value);
    }
  });
  </script>

</body>
</html>
