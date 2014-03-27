{% extends 'layout.php' %}

{% block page_title %}Szczegóły{% endblock %}
{% block content %}
	<p class="header">Konfig</p>

  <div class="container">
{% if info is defined %}<p>{{info}}</p>{% endif %}
<form action="" method="POST">
      <table class="cennik" cellpadding="0" cellspacing="0" border="0" style="width: auto;">
          <tbody>
              <tr>
                  <td>Kurs cz</td><td><input type="text" name="kurs_cz" value="{{config.kurs_cz}}"></td>
              </tr>
          </tbody>
      </table>
        <button type="submit" value="zapisz">Zapisz</button>
</form>        
  </div>


{% endblock %}