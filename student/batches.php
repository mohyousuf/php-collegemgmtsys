<?php 
include './including/nav.php';
echo '<script>document.username="' . $_SESSION['student_username'] . '"</script>';
?>
  
  <div class="wrapper">
    <div class='table-content'>
      <input type="search" id="searchBar" class="textbox3" placeholder='Search....'>
      <table>
        <thead>
          <tr>
            <th>BATCH</th>
            <th>COURSE</th>
            <th>DURATION</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <script src='../including/script.js'></script>
  
  <script>
  load(document.username,'');
  function load(uname,search){
    sqlQuery('including/batch-list.php',{uname:uname,search:search},()=>{
      document.querySelectorAll('tbody > tr').forEach(item => item.remove());
      let json = response;
      let tbody = document.querySelector('tbody');
      let columns = ['batch_id','course','duration']
      for(var row of json){
          var tr = document.createElement('tr');
          for(let i=0; i < columns.length; i++){
              var td = document.createElement('td');
              td.textContent = row[columns[i]];
              tr.appendChild(td);
          }
          tr.object = row;
          tbody.appendChild(tr);
      }
    });
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
