{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
<div class="clearfix sub-page">
{% include 'wysylka_box.php' %}
     <section class="content">
	<h2>Jak przygotować przesyłkę</h2>
	<div class="textcontent">
		<ol>
                    <li>Paczka powinna być zapakowana w karton o bryle prostopadłościanu.</li>
                    <li>Wytrzymałość i twardość opakowania zewnętrznego powinna być dostosowana do wagi i charakteru towaru znajdującego się w paczce.
                    <img src="/public/img/parcel.png"></li>
                    <li>Środek kartonu powinien być wypełniony w pełni przez zapakowany towar. Wolna przestrzeń powinna być wypełniona materiałami amortyzującymi takimi jak folia bąbelkowa lub styropian.</li>
                    <li>Wypełnienie paczki powinno uniemożliwić przesuwanie się towaru wewnątrz kartonu.</li>
                    <li>Towar powinien być poprzegradzany tekturowymi przegródkami lub zapakowany w mniejsze opakowania, umieszczone w głównym kartonie.</li>
                    <li>Należy zabezpieczyć górną i dolną część opakowania usztywniając go dodatkowymi przekładkami, uniemożliwiając jego zgniecenie.</li>
                    <li>W przypadku towarów, których specyfikacja wymaga dodatkowego oznaczenia należy nakleić oznakowania: „nie rzucać”, „góra-dół”</li>
                    <li>Z opakowania zewnętrznego należy usunąć wszelkie stare oznaczenia, listy przewozowe, naklejki itp.</li>
                    <li>Gotowa paczka powinna być oklejona listem przewozowym wygenerowanym przez system NadajTo.pl !</li>
		</ol>
                <p>Skorzystaj z doradcy ds. pakowania udostępnionego na stronie UPS, aby zapoznać się szczegółowo z metodami bezpiecznego pakowania przesyłek: <a href="">http://www.ups.com/packaging/?loc=pl_PL</a></p>
                <p>Poradnik pakowania UPS: <a href="http://kurier-online.pl/download/poradnik_pakowania.pdf" title="Poradnik pakowania UPS">Kliknij, aby zobaczyć poradnik pakowania UPS</a></p>
                <p>Jak przygotować przesyłkę: <a href="http://www.ups.com/content/pl/pl/resources/ship/packaging/guidelines/how_to.html" itle="Jak przygotować przesyłkę">Jak przygotowac wysyłkę</a></p>
                
                <h3>Wymiary przesyłek:</h3>
                
                <ol>
                <li>Maksymalne wymiary przesyłek:</li> 
                            <ul>
                                <li>długość: 120 cm</li>

                                <li>szerokość: 80 cm</li>

                                <li>wysokość 80 cm</li>

                                <li>lub suma długości i obwodu do 300 cm</li>
                            </ul>
                        </li>

                        <li>Paczki, których waga rzeczywista nie jest większa niż 32 kg,</li>

                        <li>Przesyłki, w których średnia waga paczki w przesyłce nie przekracza 32 kg</li>
                    </ol>
                    <h3>Wzór na ustalenie sumy długości i obwodu:</h3>

                    <p class="black">1x długość+ (2*wysokość + 2*szerokość)<br>
                        Długość jest liczona jako najdłuższy bok paczki.
                    </p>
                    <img src="/public/img/niestandardowy.png" alt="niestandardowe elementy">

	</div>
    </section>
</div><!--/.clearfix-->    
{% endblock %}