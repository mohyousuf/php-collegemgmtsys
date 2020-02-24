<?php 
include './including/nav.php';
?>

  <div class="wrapper">
    <div class="tile-wrapper">
      <ul class="tile-container">
        <li>
          <div>
            <i class="fas fa-user-graduate"></i>
          </div>
          <p class="tile-number" id="totalstudents"></p>
          <p class="tile-text">total students</p>
          <a class="tile-view-more" href="students.php">VIEW MORE</a>
        </li>
        <li>
          <div>
            <i class="fas fa-user-tie"></i> 
          </div>
          <p class="tile-number" id="totallect"></p>
          <p class="tile-text">total lecturers</p>
          <a class="tile-view-more" href="lecturers.php">VIEW MORE</a>
        </li>
        <li>
          <div>
            <i class="far fa-list-alt"></i> </div>
          <p class="tile-number" id="totalcourses"></p>
          <p class="tile-text">total courses</p>
          <a class="tile-view-more" href="courses.php">VIEW MORE</a>
        </li>
        <li>
          <div>
            <i class="fas fa-calendar-alt"></i>
          </div>
          <p class="tile-number" id="totalclasses"></p>
          <p class="tile-text">total classes</p>
          <a class="tile-view-more" href="class-schedules.php">VIEW MORE</a>
        </li>
        <li>
          <div>
            <i class="fas fa-book"></i> </div>
          <p class="tile-number" id="totalbooks"></p>
          <p class="tile-text">total books</p>
          <a class="tile-view-more" href="books.php">VIEW MORE</a>
        </li>
        <li>
          <div>
            <i class="fas fa-users"></i> </div>
          <p class="tile-number" id="totalbatches"></p>
          <p class="tile-text">total batches</p>
          <a class="tile-view-more" href="batches.php">VIEW MORE</a>
        </li>
        <li>
          <div>
            <i class="fas fa-star-half-alt"></i> </div>
          <p class="tile-number" id="totalresults"></p>
          <p class="tile-text">total results</p>
          <a class="tile-view-more" href="results.php">VIEW MORE</a>
        </li>
        <li>
          <div>
            <i class="fas fa-capsules"></i> </div>
          <p class="tile-number" id="totalmodules"></p>
          <p class="tile-text">total modules</p>
          <a class="tile-view-more" href="modules.php">VIEW MORE</a>
        </li>
      </ul>
    </div>
    <br><br><br><br>

    <div class="home-wrapper">
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
  <script src="../including/script.js"></script>
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

$sql = 'select * from student;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalstudents").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from lecturer;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totallect").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from course;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalcourses").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from schedule;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalclasses").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from book;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalbooks").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from student;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalstudents").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from batch;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalbatches").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from module;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalmodules").textContent = "' . mysqli_num_rows($result) . '"
</script>';

$sql = 'select * from grade;';
$result = mysqli_query($con, $sql);
echo '<script>
document.querySelector("#totalresults").textContent = "' . mysqli_num_rows($result) . '"
</script>';

?>