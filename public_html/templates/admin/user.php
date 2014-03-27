{% extends 'layout.php' %}

{% block page_title %}Edytuj klienta{% endblock %}
{% block content %}
<p class="header">Klient</p>

    <div class="container">
        <form action="/admin/klienci/edytuj" method="POST" id="user-form">
            <div class="mainleft"> 
                <p><input type="text" name="company" placeholder="Firma" value="{{user.company}}" style="width: 258px;"></p>
                <p><input type="text" name="name" rel="require" placeholder="Imię" value="{{user.name}}" style="width: 258px;"></p>
                <p style="margin-bottom: 30px;"><input type="text" name="lname" rel="require" placeholder="Nazwisko" value="{{user.lname}}" style="width: 258px;"></p>
                <p><input type="text" name="addr" placeholder="Adres" value="{{user.addr}}" style="width: 258px;"></p>
                <p><input type="text" name="city" rel="require" placeholder="Miasto" value="{{user.city}}" style="width: 258px;"></p>
                <p><input type="text" name="zip" placeholder="Kod pocztowy" value="{{user.zip}}" style="width: 258px;"></p>
            </div>
            <div class="mainright">
                <p><input type="text" name="addr" placeholder="Email" value="{{user.email}}" style="width: 258px;"></p>
                <p style="margin-bottom:30px;"><input type="text" name="city" rel="require" placeholder="Telefon" value="{{user.phone}}" style="width: 258px;"></p>

                <p><input type="text" name="discount" placeholder="Rabat" value="{{user.discount}}" style="width: 258px;"></p>
            </div>  
            <div class="price-container" style="clear: both; margin-left: 40px;"> 
                <button type="button" class="dark" id="btn-submit" >Wyślij</button><span class="ajax-loader"></span>
            </div>
        </form>
    </div>
<script>
$j('#btn-submit').click(function(){
    $j('#user-form').submit();
})
</script>

{% endblock %}