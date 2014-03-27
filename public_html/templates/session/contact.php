{% extends 'layout.php' %}

{% block page_title %}Usługi dodatkowe{% endblock %}
{% block content %}         
        <div class="contact">
            <div class="form-wrapper">
                <h2>Kontakt <span>Masz pytania lub jesteś zainteresowany naszą ofertą</span></h2>
                <div class="clearfix">
                    <div class="call">
                    <img src="img/call.png" alt="">
                    </div><!--/.call-->
                    <div class="or">
                    lub
                    </div><!--/.or-->
                    <div class="form">
                        <h3>Skorzystaj z formularza</h3>
                        {% if RETMSG is defined %}
                            {% if RETMSG == 0 %}<p class="msgok">Twoja wiadomość została wysłana. Dziękujemy!</p>{% endif %}
                            {% if RETMSG == 1 %}<div class="warning"><p><b>Nie wysłano wiadomości!</b><br>Wystąpił błąd podczas wysyłania. Prosimy spróbować ponownie.</p></div>{% endif %}
                            {% if RETMSG == 2 %}<div class="warning"><p><b>Nie wysłano wiadomości!</b><br>Wymagane pola nie zostały uzupełnione.</p></div>{% endif %}
                        {%endif%}
                        <form id="contact-form" action="" method="post">
                            <input type="text" name="name" placeholder="Imię i nazwisko">
                            <input type="email" name="email" placeholder="Email" style="display:inline-block;" required>*
                            <input type="text" name="phone-number" placeholder="Numer telefonu" style="display:inline-block;" required>*
                            <textarea name="content" placeholder="Treść wiadomości"></textarea>
                            <input type="submit" value="Wyślij wiadomość">
                        </form>
                    </div><!--/.form-->
                </div>
            </div>
            <div class="clearfix contact-details">
                <div class="grid-4">
                    <span>Dział obsługi klienta kluczowego</span>
                    <p>
                        Tomasz Ryłko<br>
                        <i>Key account manager</i><br>
                        <a href="mailto:tomek@olzalogistic.com">tomek@olzalogistic.com</a><br>
                        tel.: +48 536 511 471
                    </p>
                </div><!--/.grid-4 1-->
                <div class="grid-4">
                    <span>Biuro PL</span>
                    <p>
                        ul. Stawowa 27<br>
                        43-400 Cieszyn<br>
                        <a href="mailto:info@olzalogistic.com">info@olzalogistic.com</a><br>
                        tel.: +48 536 511 471
                    </p>
                </div><!--/.grid-4 2-->
                <div class="grid-4">
                    <span>Magazyn PL, reklamacje i zamówienia</span>
                    <p>
                        ul. Stawowa 27<br>
                        43-400 Cieszyn<br>
                        <a href="mailto:magazyn@olzalogistic.com">magazyn@olzalogistic.com</a><br>
                        <a href="mailto:reklamacje@olzalogistic.com">reklamacje@olzalogistic.com</a><br>
                        <a href="mailto:zamowienia@olzalogistic.com">zamowienia@olzalogistic.com</a><br>
                        tel.: +48 512 790 260
                    </p><p>
                </p></div>
                <!--/.grid-4 3-->
                <div class="grid-4">
                    <span>Siedziba firmy</span>
                    <p>
                        olzalogistic.com, s.r.o.<br>
                        Protifašistických bojovníků 1329/19,<br>
                        73701 Český Těšín<br>
                        Republika Czeska<br>
                        REGON: 01503057<br>
                        NIP: CZ01503057<br><br>
                    </p><p>
                </p></div><!--/.grid-4 4-->
                <div class="grid-4">
                    <span>Dział tłumaczeń</span>
                    <p>
                        <a href="mailto:tlumaczenie@olzalogistic.com">tlumaczenie@olzalogistic.com</a><br>
                        tel.: +48 662 007 134
                    </p><p>
                </p></div><!--/.grid-4 5-->
                <div class="grid-4">
                    <span>Dział księgowości</span>
                    <p>
                        <a href="mailto:faktury@olzalogistic.com">faktury@olzalogistic.com</a><br>
                        tel.: +48 506 370 783
                    </p><p>
                </p></div><!--/.grid-4 6-->
            </div><!--/.contact-details-->

        </div><!--/.contact-->
{% endblock %}        






























