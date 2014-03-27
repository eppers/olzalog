        <div id="slider">
            <img src="img/slider_1.png" alt="">
            <img src="img/top1.png" alt="">
            <img src="img/top2.png" alt="">
        </div>  
        <div class="clearfix">
<?php 
  if(file_exists('left_box.php')) include 'left_box.php';
?>
            <article class="ads">
                <a href="#"><img src="img/oszczedzaj.png" alt=""></a>
            </article>
            <article class="ads">
                <a href="#"><img src="img/wysylajOnline.png" alt=""></a>
            </article>
            <article>
                <div class="title">Lokalizacja</div>
                <form>
                    <label for="id">Podaj numer przewozowy przesyłki</label>
                    <input type="text" name="id" id="id">
                    <input type="submit" value="ok" class="tooltip">
                </form>
            </article>
        </div><!--/.clearfix-->
        
<?php include('slider-bottom.php') ?>