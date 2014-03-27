{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}        <div id="slider">
            <img src="/public/img/slider_1.png" alt="">
            <img src="/public/img/top1.png" alt="">
            <img src="/public/img/top2.png" alt="">
        </div>  
        <div class="clearfix">

{% include 'left_box.php' %}

            <article class="ads" style="width: 261px;">
                <a href="/dla_biznesu"><img src="/public/img/oszczedzaj.png" alt=""></a>
            </article>
            <article class="ads" style="width: 241px;">
                <a href="/formularz"><img src="/public/img/wysylajOnline.png" alt=""></a>
            </article>
            <article>
                <div class="title">Lokalizacja</div>
                <form method="get" action="http://wwwapps.ups.com/WebTracking/track?track=yes&trackNums=" id="lokalizacja">
                    <label for="id">Podaj numer przewozowy przesyłki</label>
                    <input type="text" name="id" id="id">
                    <input type="submit" value="ok" class="">
                </form>
            </article>
        </div><!--/.clearfix-->
        
{% include 'slider-bottom.php' %}
{% endblock %}