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
          <a class="unchecked" id="s_btn" href="#new-content">NEW BOOK</a>
          <input id="isbn" label="ISBN" name="isbn" type="text" class="textbox2" placeholder="978-1-891830-75-4" >
          <input id="title" label="TITLE" name="title" type="text" class="textbox2" placeholder="The Dark Knight Rises" >
          <input id="year" label="YEAR" name="year" type="text" class="textbox2" placeholder="2008" >
          <input id="author" label="AUTHOR" name="author" type="text" class="textbox2" placeholder="Christopher Nolan" >
          <input id="qty" label="QUANTITY" name="qty" type="text" class="textbox2" placeholder="250" >
          <br><br>
        </div>
        <button name="submit" type="button" id="btn-add-content" class="btn-dark">SAVE</button>
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
      <input id="eisbn" label="ISBN" name="eisbn" type="text" class="textbox4" placeholder="978-1-891830-75-4" >
      <input id="etitle" label="TITLE" name="etitle" type="text" class="textbox4" placeholder="The Dark Knight Rises" >
      <input id="eyear" label="YEAR" name="eyear" type="text" class="textbox4" placeholder="2008" >
      <input id="eauthor" label="AUTHOR" name="eauthor" type="text" class="textbox4" placeholder="Christopher Nolan" >
      <input id="eqty" label="QUANTITY" name="eqty" type="text" class="textbox4" placeholder="250" >
    </div>

    <div>
      <button class="btn-dark" name='delete'>DELETE</button>
      <button class="btn-light" name='save'>SAVE</button>
    </div>
  </div>

  <div id="slider2" class="slider hide">
    <div>
      <h1></h1>
      <h1>BORROWERS</h1>
      <i class="far fa-times-circle editclose"></i>
    </div>
    <div class="schedule-card-dark-container">

    </div>
    
  </div>


  <script src="../including/script.js"></script>
  <script>
    document.querySelector('[name=submit]').onclick = () => {
      var ob = {
        isbn : document.querySelector('[name=isbn]').value,
        title : document.querySelector('[name=title]').value,
        year : document.querySelector('[name=year]').value,
        author : document.querySelector('[name=author]').value,
        qty : document.querySelector('[name=qty]').value
      };

      //console.log(ob);
      sqlQuery('including/book-add.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/book-list.php',document.querySelector('table').lastSearch,['isbn','title','author','year','qty'],['ISBN','TITLE','AUTHOR','YEAR','QUANTITY']);
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
        isbn : document.querySelector('.slider').value,
        newisbn : document.querySelector('[name=eisbn]').value,
        title : document.querySelector('[name=etitle]').value,
        author : document.querySelector('[name=eauthor]').value,
        year : document.querySelector('[name=eyear]').value,
        qty : document.querySelector('[name=eqty]').value
      };

      sqlQuery('including/book-update.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);
          loadList('including/book-list.php',document.querySelector('table').lastSearch,['isbn','title','author','year','qty'],['ISBN','TITLE','AUTHOR','YEAR','QUANTITY']);
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
        isbn : document.querySelector('.slider').value
      };

      sqlQuery('including/book-delete.php', ob, ()=>{
        if(response.success)
        {
          showSuccess(response.success);          
          loadList('including/book-list.php',document.querySelector('table').lastSearch,['isbn','title','author','year','qty'],['ISBN','TITLE','AUTHOR','YEAR','QUANTITY']);
          hideSliders();
          clearFields();
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };

    loadList('including/book-list.php','',['isbn','title','author','year','qty'],['ISBN','TITLE','AUTHOR','YEAR','QUANTITY']);

    function rowClick(e){
      e.preventDefault();
      let item1 = document.createElement('div');
      let item2 = document.createElement('div');
      item1.textContent = 'Edit';
      item2.textContent = 'View Borrowers';
      item1.onclick = () => item1Click(this.object);
      item2.onclick = () => item2Click(this.object);
      showContext(e, item1, item2);
    }
    
    function item1Click(object){
      document.querySelector('.slider').value = object.isbn;
      document.querySelector('[name=eisbn]').value = object.isbn;
      document.querySelector('[name=etitle]').value = object.title;
      document.querySelector('[name=eauthor]').value = object.author;
      document.querySelector('[name=eyear]').value = object.year;
      document.querySelector('[name=eqty]').value = object.qty;
      showSlider1();
    }
    
    function item2Click(object){
      sqlQuery('including/borrow-list.php', {isbn : object.isbn}, ()=> {
        document.querySelectorAll('#slider2 .schedule-card-dark').forEach(item => item.remove());

        for(let i=0; i< Object.keys(response).length; i++){
          let card = document.createElement('div');
          card.setAttribute('class','schedule-card-dark borrow-list');

          let uname = document.createElement('div');
          uname.className = 'day';
          uname.textContent = response[i].s_uname;
          let date = document.createElement('div');
          date.className = 'time';
          date.textContent = response[i].date;

          card.appendChild(uname);
          card.appendChild(date);

          document.querySelector('#slider2 .schedule-card-dark-container').appendChild(card);
        }
      });
      showSlider2();
    }

    document.querySelector('#searchBar').onkeydown = searchQuery;
    function searchQuery(e)
    {
      if(e.keyCode == 13){
        loadList('including/book-list.php',this.value,['isbn','title','author','year','qty'],['ISBN','TITLE','AUTHOR','YEAR','QUANTITY']);
      }
    }
  </script>
</body>
</html>