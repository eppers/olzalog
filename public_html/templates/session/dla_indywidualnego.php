{% extends 'layout.php' %}

{% block page_title %}Dla klienta indywidualnego{% endblock %}
{% block content %}          
    <div class="clearfix sub-page">
{% include 'left_box.php' %}
            <section class="content">
                <h3>Dla klienta indywidualnego</h3>
                <p>
                  Wychodząc naprzeciw Państwa oczekiwaniom, postanowiliśmy zautomatyzować nasz system zamawiania przesyłek kurierskich do Czech. Zmiana ta pozwoliła na uzyskanie najkorzystniejszej oferty wśród firm świadczących usługi tego typu na terenie Polski. Dzięki automatycznemu systemowi zlecania przesyłek, mogą Państwo samodzielnie, bez podpisywania umowy zlecić dostarczenie przesyłki z Polski do Czech. Całość systemu została zaprojektowana w sposób umożliwiający samodzielne, szybkie oraz intuicyjne zlecenie międzynarodowej przesyłki kurierskiej.<br>
                <br>
                  Po złożeniu zamówienia, zostanie wygenerowany list przewozowy na konto e-mail, podane w formularzu. W wiadomości mailowej znajduje się dokładna instrukcja o naklejeniu listu przewozowego oraz dodatkowych informacjach o przesyłce.<br>
                <br>
                  Przesyłki na terenie Polski obsługiwane są przez firmę kurierską UPS, która dostarcza paczki do naszego magazynu w Cieszynie. Następnym etapem jest odbiór przesyłki z naszego magazynu, przez firmę kurierską GLS, która dostarczy przesyłkę do Państwa odbiorcy na terenie Czech.<br>
                <br>
                  Całość dostawy to tylko 3 dni robocze, a dzięki automatycznemu wygenerowaniu numerów trackingowych przesyłek, mogą je Państwo śledzić na stronach kurierów. 
                </p>
                  <a href="/formularz" title="Jak działamy"><img src="/public/img/nadajpaczke.png"></a>
            </section>
        </div><!--/.clearfix-->
        
{% include 'slider-bottom.php' %}
{% endblock %}