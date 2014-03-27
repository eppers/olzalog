        <div class="clearfix partners">
            <div class="customers-logos">
            <span>Nasi klienci</span>
            <div class="logos-slider" id="customers-logos" style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; width: 524px;">
                <ul style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1; width: 1000px; left: -742px;">
                    
                     {% for i in 1..16 %}
                          <li style="overflow: hidden; float: left; width: 131px; height: 57px;"><a href="/referencje" data-nr="{{i}}" class="logo" style=" background:url('img/partners/{{i}}.jpg');"><img src="img/partners/{{i}}_hover.jpg" alt="" style="opacity:0.1;"></a></li> 
                      {% endfor %}
                    
                </ul>
            </div>
        </div><!--/.customers-logos-->
        <div class="talk-about-us">
        <span>Opinie</span>
            <p>“Wzorowa współpraca, szybka wysyłka, najlepsze ceny. Polecam.”</p>
            <div class="about-bottom"><strong>Tomasz Sobecki</strong> , Lumen TEC</div>
        </div>
        </div><!--/.partners-->