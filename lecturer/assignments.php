<?php 
include './including/nav.php';
include '../including/sql_connection.php';
echo '<script>document.username="' . $_SESSION['lecturer_username'] . '"</script>';
?>

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

  <script src='../including/script.js'></script>
  <script>

  load('');
  function load(search){
    sqlQuery('../operator/including/assignment-list.php',{search:search},()=>{
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
      load(search.value);
    }
  });
  </script>

</body>
</html>
