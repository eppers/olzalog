{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}         
    <div class="clearfix sub-page">
{% include 'left_box.php' %}
            <section class="content">
                <h3>Jak działamy?</h3>
                <img src="/public/img/olza-schemat-dzialania.jpg" alt="Jak działamy">
                <ol>
                    <li>Klient z Polski wysyła do nas pod polski adres przesyłkę zbiorczą, zawierającą
                    dowolną liczbę przesyłek detalicznych (zapakowane w osobne paczki produkty
                    zamówione przez czeskich, ew. słowackich, klientów – tzw. przesyłki detaliczne),
                    przykładowo w poniedziałek.</li>
                    <li>We wtorek (w zależności od sposobu wysłania przesyłki zbiorczej) odbieramy
                    przesyłkę zbiorczą pod polskim adresem.</li>
                    <li>Następnie w tym samym dniu przewozimy przesyłką zbiorczą do Republiki Czeskiej.</li>
                    <li>Po rozpakowaniu przesyłki zbiorczej nadajemy poszczególne przesyłki detaliczne
                    najpóźniej w następnym dniu roboczym od odebrania przesyłki zbiorczej (wtorek
                    lub środa).</li>
                    <li>W następnym dniu roboczym (środa lub czwartek) przesyłka detaliczna dociera do
                    czeskiego klienta.</li>
                </ol>
                <p class="quote">„OlzaLogistic zajmuje się pośrednictwem w przesyłkach oraz prowadzi działania wspierające sprzedaż towarów naszych Klientów w celu uzyskania jak największego wolumenu sprzedaży – a co za tym idzie – liczby wysyłanych paczek. Nie działamy na zasadzie przedstawiciela handlowego. Te fakty oraz symbioza wykonywanych czynności sprawia, iż nasza współpraca przynosi obopólne korzyści. Stawiamy na długofalową współpracę na zasadach fair play. Nie tolerujemy oszustów i nieprofesjonalnego podejścia do pracy.”<br>
                <span>Szymon Ciahotny, właściciel</span></p>
                <a href="/kontakt"><img src="/public/img/jak-dzialamy-zapytanie.png" alt="Wyślij zapytanie"></a>
            </section>
        </div><!--/.clearfix-->
        
{% include 'slider-bottom.php' %}
{% endblock %}