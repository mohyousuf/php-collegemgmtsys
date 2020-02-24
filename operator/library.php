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
          <a class="unchecked" id="s_btn" href="#new-content">RESERVE BOOK</a>
          <div name="student" id="student" class="yuz-select" label="STUDENT">
            <?php
            $sql = 'SELECT * FROM student';
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) 
            {
              echo "<span value='" . $row['uname'] . "'>" . $row['fname'] . ' ' . $row['lname'] . ' (' . $row['uname'] . ')' . "</span>";
            }
            ?>
          </div>

          <div name="book" id="book" class="yuz-select" label="BOOK">
            <?php
            $sql = 'SELECT * FROM book';
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) 
            {
              echo "<span value='" . $row['isbn'] . "'>" . $row['title'] . ' (' . $row['isbn'] . ')' . "</span>";
            }
            ?>
          </div>

          <br><br>
        </div>
        <button name="submit" type="button" id="btn-add-content" class="btn-dark">RESERVE</button>
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

    <div>
      <input disabled id="ebook" label="BOOK" name="ebook" type="text" class="textbox4" placeholder="978-1-891830-75-4" >
      <input disabled id="estudent" label="STUDENT" name="estudent" type="text" class="textbox4" placeholder="2008" >
      <input disabled id="edate" label="date" name="edate" type="text" class="textbox4" placeholder="250" >
    </div>

    <div>
      <button class="btn-dark" name='delete' style='grid-column-start:1;grid-column-end:3'>DELETE</button>
    </div>
  </div>

  <script src="../including/script.js"></script>
  <script>
    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        isbn : document.querySelector('[name=book]').value,
        uname : document.querySelector('[name=student]').value
      };

      //console.log(ob);
      sqlQuery('including/library-borrow.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/borrow-list.php','',['book','student','date'],['BOOK','BORROWED/RESERVED STUDENT','BORROWED/RESERVED DATE',]);
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
        isbn : document.querySelector('.slider').value.isbn,
        s_uname : document.querySelector('.slider').value.s_uname,
      };

      sqlQuery('including/reservation-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);          
          loadList('including/borrow-list.php','',['book','student','date'],['BOOK','BORROWED/RESERVED STUDENT','BORROWED/RESERVED DATE',]);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/borrow-list.php','',['book','student','date'],['BOOK','BORROWED/RESERVED STUDENT','BORROWED/RESERVED DATE',]);
    

    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      item1.textContent = 'Edit';
      item1.onclick = () => item1Click(this.object);
      showContext(e, item1);
    }
    
    function item1Click(object){
      document.querySelector('.slider').value = object;
      document.querySelector('[name=ebook]').value = object.book;
      document.querySelector('[name=estudent]').value = object.student;
      document.querySelector('[name=edate]').value = object.date;
      showSlider1();
    }

    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/borrow-list.php',this.value,['book','student','date'],['BOOK','BORROWED/RESERVED STUDENT','BORROWED/RESERVED DATE',]);
      }
    }
  </script>
</body>
</html>