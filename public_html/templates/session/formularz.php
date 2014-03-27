{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
<div class="clearfix sub-page">
	<div class="sending-form">
		<ul class="sending-form-nav">
			<li><a class="active" href="#przesylka">Przesyłka</a></li>
			<li><a href="#nadawca-odbiorca">Nadawca/Odbiorca</a></li>
			<li><a href="#uslugi-dodatkowe">Usługi dodatkowe</a></li>
		</ul>

		<form class="sending-form-content" action="#" method="post">
			<div id="sending-form-slider-wrapper">
				<section id="przesylka" class="frame">
					<div class="column-right padding-right">
						<div class="box">
							<h2>Nadaj przesyłkę do Czech</h2>
							<p><img src="img/ups.png" alt="UPS"> UPS po stronie polskiej <br>i&nbsp;GLS po stronie czeskiej</p>
							<h2>Masz problem z przesyłką?</h2>
							<p><img src="http://balikzpolska.cz/wp-content/plugins/wpgform/images/headphones.png" alt="Telefon">Zadzwoń: +48 883 448 818</p>
						</div>
					</div>

					<div class="column-left padding-left">
						<fieldset>
							<legend>Rodzaj</legend>
							<span class="control">
								<label><input  type="radio" name="rodzaj" class="pkg_type" value="1" checked> Paczka</label>
							</span>
							<span class="control">
								<label><input type="radio" name="rodzaj" id="pkg_type_env" class="pkg_type" value="2"> Koperta</label>
							</span>
						</fieldset>

						<fieldset>
							<legend>Rozmiar</legend>
							<div class="control">
								<label>Waga przesyłki:</label>
								<input type="text" id="pkg_weight" name="pkg_weight" value="" placeholder="kg"> kg
							</div>
							<div class="control">
								<label>Wymiary:</label><img class="help" src="/public/img/help.gif" style="vertical-align: top;" alt="Pomoc" onmouseover="ddrivetip('Maksymalne wymiary przesyłek:<br>- długość 120 cm,<br>- szerokość 80cm<br>-wysokość 80 cm,<br>lub suma długości i obwodu do 300 cm<br>Więcej informacji w zakładce <b>Jak pakować<b>');" onmouseout="hideddrivetip();">
                                                                <input type="text" id="pkg_length" name="pkg_length" title="Długość" value="" placeholder="cm"> x
                                                                <input type="text" id="pkg_width" name="pkg_width" title="Szerokość" value="" placeholder="cm"> x
                                                                <input type="text" id="pkg_height" name="pkg_height" title="Wysokość" value="" placeholder="cm"> cm
	                                                              
                                                                <div class="unit-help">
                                                                    <var><span>dł.</span> &nbsp; <span>szer.</span> &nbsp; <span>wys.</span></var>
                                                                </div>
							</div>
                                                        <!--
							<div class="control">
								<label><input type="checkbox" id="Notstand" name="Notstand" value="1"> Niestandardowa przesyłka</label>
								<img class="help" src="img/help.png" alt="Pomoc" onmouseover="ddrivetip('Przesyłka niestandardowa:&lt;br&gt;-Przesyłki o nieregularnych kształtach (elementy wystające, okrągłe kształty)&lt;br&gt;-Paczki, których dł. przekracza 120 cm, szer. 80cm lub wys. 80 cm,bądź suma długości i obwodu przekracza 300 cm.&lt;br&gt;-Paczki o wadze powyżej 32 kg.&lt;br&gt;Dopłata 10 zł netto (12,3 zł brutto)&lt;br&gt;Więcej informacji w zakładce &lt;b&gt;Przesyłki niestandardowe&lt;b&gt;');" onmouseout="hideddrivetip();">
							</div>
                                                        -->
						</fieldset>
						<fieldset>
							<legend>Dokąd</legend>
							<div class="control">
								<select name="kraj" id="kraj">
                                                                    <option value="60" selected>Republika Czeska</option>
                                                                </select>
							</div>
						</fieldset>
					</div>
				</section>

				<div id="nadawca-odbiorca" class="frame">
					<div class="column-left">
						<fieldset>
							<legend>Nadawca</legend>
							<div class="control">
                                                            <p style="margin:0;">
                                                               <label><input type="radio" name="nad_typ" value="0" onclick="nadFirm();" checked> Osoba</label>
                                                               <label><input type="radio" id="nadfirma" name="nad_typ" value="1" onclick="nadFirm();"> Firma</label>
                                                            </p>
                                                            <div id="nad_firma" style="display: none;">
                                                                <input type="text" name="nad_nazwa" rel="require" placeholder="Nazwa firmy" value="" style="width: 300px;">
                                                                <input type="text" name="nad_nip" rel="require" placeholder="NIP" value="" style="width: 300px;">
                                                            </div>
                                                            <input type="text" name="nad_imie" maxlength="21" rel="require" placeholder="Imię" value="" style="width: 300px;">
							</div>
							<div class="control">
								<input type="text" name="nad_nazwisko" maxlength="21" placeholder="Nazwisko" value="" style="width: 300px;">
							</div>
							<div class="control">
                                                            <input type="text" name="nad_ulica" rel="require" placeholder="Ulica" value="" style="width: 142px;">
                                                            <input type="text" name="nad_nrdomu" rel="require" placeholder="Nr domu" value="" style="width: 75px;" maxlength="4">
                                                            <input type="text" name="nad_nrlok" placeholder="Nr lokalu" value="" style="width: 75px;" maxlength="4">
                                                        </div>
							<div class="control">
                                                                <input type="text" name="nad_miasto" rel="require" placeholder="Miasto" value="" style="width: 300px;">
                                                        </div>
							<div class="control">
                                                                <input type="text" name="nad_kod1" rel="require" placeholder="XX" value="" style="width: 40px;" maxlength="2">
                                                                —
                                                                <input type="text" name="nad_kod2" rel="require" placeholder="XXX" value="" style="width: 50px;" maxlength="3">
                                                                <span id="nad_miasto">Kod pocztowy</span>
                                                        </div>
							<div class="control">
                                                            <input type="email" name="nad_email" rel="require" placeholder="Adres e-mail" value="" style="width: 300px;">
                                                        </div>
							<div class="control">
								<input type="email" name="nad_email2" rel="require" placeholder="Powtórz e-mail" value="" style="width: 300px;">
                                                        </div>
							<div class="control">
								<input type="text" name="nad_telef" rel="require" placeholder="Telefon" value="" style="width: 300px;">
							</div>
						</fieldset>
					</div>

					<div class="column-right">
						<fieldset>
							<legend>Odbiorca</legend>
							<div class="control">
								<input type="text" name="odb_imie" maxlength="21" rel="require" placeholder="Imię lub nazwa firmy" value="" style="width: 300px;">
							</div>
							<div class="control">
								<input type="text" name="odb_nazwisko" maxlength="21" placeholder="Nazwisko" value="" style="width: 300px;">
							</div>
							<div class="control">
								<label class="margin-bottom"><input type="checkbox" id="odb_priv" name="odb_priv" value="1"> Odbiorca prywatny</label>
							</div>
							<div class="control">
                                                            <input type="text" name="odb_ulica" rel="require" placeholder="Ulica" value="" style="width: 142px;">
                                                            <input type="text" name="odb_nrdomu" rel="require" placeholder="Nr domu" value="" style="width: 75px;" maxlength="4">
                                                            <input type="text" name="odb_nrlok" placeholder="Nr lokalu" value="" style="width: 75px;" maxlength="4">
							</div>
							<div class="control">
                                                            <p><a href="http://www.psc.cz">Wyszukiwarka kodów pocztowych</a></p>
								<input type="text" name="odb_miasto" rel="require" placeholder="Miasto" value="" style="width: 300px;">
							</div>
							<div class="control">
                                                            <input type="text" name="odb_kod1" rel="require" placeholder="XXX" value="" style="width: 50px;" maxlength="3">
                                                            —
                                                            <input type="text" name="odb_kod2" rel="require" placeholder="XX" value="" style="width: 40px;" maxlength="2">
                                                            <span id="odb_miasto">Kod pocztowy</span>
							</div>
							<div class="control">
								<input type="text" name="odb_telef" rel="require" placeholder="Telefon" value="" style="width: 300px;">
							</div>
						</fieldset>
					</div>
				</div>

				<div id="uslugi-dodatkowe" class="frame">
					<div class="column-left">
						<fieldset>
							<legend>Data nadania przesyłki</legend>
							<div class="control">
                                                            <input type="text" name="data_nad" id="data_nad" value="" placeholder="Możliwie najszybciej" readonly="" style="width: 200px;">
                                                            <img alt="Data…" src="img/calend.png" class="kalendarz">
							</div>
							<div class="control to-sides">
                                                            <label><input type="checkbox" name="Insurance_check" rel="input" value="1"> Dodatkowe ubezpieczenie</label>
                                                            <input type="text" name="Insurance_input" value="" style="text-align: right;"> zł
							</div>
							<div class="control to-sides">
                                                            <label><input type="checkbox" name="COD_check" rel="input" value="1"> Przesyłka pobraniowa</label>
                                                            <input type="text" name="COD_input" value="" style="text-align: right;"> zł
                                                            <input type="text" id="bank-account" name="account-no" value="" placeholder="Numer rachunku bankowego" style="display: none; width: 310px; margin-top: 10px; ">
							</div>
							<div class="control to-sides" id="kurs_cz">
                                                            <label>Wartość po przeliczeniu na KČ</label>
                                                            <input type="text" name="kurs_cz" value="" style="text-align: right;" disabled>
                                                            <input type="hidden" value="{{kurs_cz}}" id="kurs_cz_input" disabled>
              </div>
						</fieldset>
					</div>

					<div class="column-right">
						<p><b>Odbiory paczek odbywają się<br>w godziach od 10 do 18.</b><br>Nie ma możliwości ustalenia<br>konkretnej godziny odbioru.</p>
						<p><b>Dodatkowe ubezpiecznie:</b>
                            <br>UPS - maksymalna wysokość<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ubezpieczenia wynosi 50 000 zł,
                            <!--<br>K-EX - maksymalna wysokość<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ubezpieczenia wynosi 100 000 zł.-->
                    	</p>

					</div>
				</div>
			</div>

			<div id="form-action">
                            {% for courier in couriers %}
				<img src="img/ups_gls.png" alt="UPS GLS">
				<p id="courier_{{courier.id}}"><strong><span class="total-price">{{courier.price}}</span> zł</strong> brutto</p>
				<button type="submit" id="go_c{{courier.id}}">NadajTo <strong>{{courier.name}}</strong></button>
                            {% else %} BRAK
                            {% endfor %}
			</div>
		</form>
	</div>
</div><!--/.clearfix-->
 <form method="GET" id="sendingpayu" action="{{payULink}}">
    <input type="hidden" id="sessionId" name="sessionId" value="">
    <input type="hidden" id="oauth_token" name="oauth_token" value="">
    <input type="hidden" name="showLoginDialog" value="False">
</form>   
{% include 'slider-bottom.php' %}
{% endblock %}