<?php 
include './including/nav.php';
echo '<script>document.username="' . $_SESSION['student_username'] . '"</script>';
?>

  <div class="wrapper">
    <div class="tile-wrapper">
      <ul class="tile-container">
        <li>
          <div class="icon-red">
            <i class="fas fa-user-graduate"></i>
          </div>
          <p class="tile-number" id="totalbatches"></p>
          <p class="tile-text">total batches</p>
          <a class="tile-view-more" href="batches.php">VIEW MORE</a>
        </li>
        <li>
          <div class="icon-blue">
            <i class="fas fa-user-tie"></i> 
          </div>
          <p class="tile-number" id="totalmodules"></p>
          <p class="tile-text">total modules</p>
          <a class="tile-view-more" href="modules.php">VIEW MORE</a>
        </li>
        <li>
          <div class="icon-yel">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <p class="tile-number" id="totalclasses"></p>
          <p class="tile-text">total classes</p>
          <a class="tile-view-more" href="class-schedule.php">VIEW MORE</a>
        </li>
        <li>
          <div class="icon-grey">
            <i class="fas fa-book"></i> </div>
          <p class="tile-number" id="totalbooks"></p>
          <p class="tile-text">my books</p>
          <a class="tile-view-more" href="my-books.php">VIEW MORE</a>
        </li>
        <li>
          <div class="icon-red">
            <i class="fas fa-user-graduate"></i>
          </div>
          <p class="tile-number" id="inlibrary"></p>
          <p class="tile-text">books in library</p>
          <a class="tile-view-more" href="library.php">VIEW MORE</a>
        </li>
        <li>
          <div class="icon-blue">
            <i class="fas fa-user-tie"></i> 
          </div>
          <p class="tile-number" id="totalresults"></p>
          <p class="tile-text">my results</p>
          <a class="tile-view-more" href="results.php">VIEW MORE</a>
        </li>
        <li>
          <div class="icon-yel">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <p class="tile-number" id="myassignments"></p>
          <p class="tile-text">my assignments</p>
          <a class="tile-view-more" href="assignments.php">VIEW MORE</a>
        </li>
        <li>
          <div class="icon-yel">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <p class="tile-number" id="totalmaterials"></p>
          <p class="tile-text">total materials</p>
          <a class="tile-view-more" href="materials.php">VIEW MORE</a>
        </li>
      </ul>
    </div>
    <br><br><br><br>
    <div class='home-wrapper'>
      <div class="announcements">
        <h1>ANNOUNCEMENTS</h1>
        <ul class="card">
          <!--<li>
            <p class="card-header">Arrested!</p>
            <p class="card-text">Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem</p>
          </li>
          <li>
            <p class="card-header">Arrested!</p>
            <p class="card-text">Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem</p>
          </li>
          <li>
            <p class="card-header">Arrested!</p>
            <p class="card-text">Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem</p>
          </li>
          <li>
            <p class="card-header">Arrested!</p>
            <p class="card-text">Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem Lorem ipsum lorem</p>
          </li>
          -->

          <?php
            $sql = 'select * from announcement;';
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
              echo '<li>';
                echo '<p class="card-header">' . $row['title'] . '</p>';
                echo '<p class="card-text">' . $row['msg'] . '</p>';
              echo '</li>';
            }
          ?>

        </ul>
      </div>
            
      <div class="news-wrapper">
        <h1>WORLD NEWS</h1>
      </div>
    </div>
  </div>
  <script src='../including/script.js'></script>
  <script>
    loadNews();

    function loadNews() {
      var link = 'https://newsapi.org/v2/everything?domains=wsj.com,nytimes.com&apiKey=43b1972a2baa40ac972cce65b14b5f54';
      var oReq = new XMLHttpRequest();
      oReq.open("GET", link);
      oReq.send();

      oReq.onload = function () {
        var result = JSON.parse(oReq.response);
        result = result['articles'];
        console.log(result);

        for (var i=0; i < 5; i++) {
          let title = result[i].title;
          let desc = result[i].description;
          let source = result[i].source['name'];
          let link = result[i].url;
          addNews(title, desc, source, link);
        }

        function addNews(title, desc, source, link) {
          let _wrapper = document.querySelector('.news-wrapper');
          let _card = document.createElement('div');
          let _news_content = document.createElement('div');
          let _title = document.createElement('div');
          let _desc = document.createElement('div');
          let _source = document.createElement('div');

          _card.setAttribute('class', 'news-card');
          _news_content.setAttribute('class', 'news-content');
          _title.setAttribute('class', 'news-title');
          _title.textContent = title;
          _desc.setAttribute('class', 'news-desc');
          _desc.textContent = desc;
          _source.setAttribute('class', 'news-source');
          _source.textContent = source;
          _card.link = link;
          _card.addEventListener('click', openNews);

          _card.appendChild(_news_content);
          _news_content.appendChild(_title);
          _news_content.appendChild(_desc);
          _card.appendChild(_news_content);
          _card.appendChild(_source);
          _wrapper.appendChild(_card);
        }

        function openNews() {
          window.open(this.link, '_blank');
        }
      }
    }

  </script>
</body>

</html>

<?php
$uname  = $_SESSION['student_username'];

$sql = "select * from batch_student WHERE s_uname='$uname';";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalbatches").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = "SELECT * FROM course_module JOIN batch ON course_module.course_id=batch.course_id JOIN batch_student ON batch.batch_id=batch_student.batch_id WHERE batch_student.s_uname='$uname';";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalmodules").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = "SELECT * FROM schedule JOIN batch ON schedule.batch_id=batch.batch_id JOIN batch_student ON batch.batch_id=batch_student.batch_id WHERE batch_student.s_uname='$uname';";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalclasses").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = "select * from student_book WHERE s_uname='$uname';";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalbooks").textContent = "' . mysqli_num_rows($result) . '"
</script>';



$sql = "select * from assignment WHERE s_uname='$uname';";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#myassignments").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = "SELECT * FROM grade WHERE s_uname='$uname';";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalresults").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = "SELECT * FROM book";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#inlibrary").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = "SELECT * FROM material
JOIN course_module ON material.module_id=course_module.module_id
JOIN module ON material.module_id=module.module_id
JOIN batch ON course_module.course_id=batch.course_id
JOIN batch_student ON batch.batch_id=batch_student.batch_id
WHERE batch_student.s_uname='$uname'";
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalmaterials").textContent = "' . mysqli_num_rows($result) . '"
</script>';


?>