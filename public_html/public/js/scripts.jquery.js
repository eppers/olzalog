
$(document).ready(function() {
    $(".ajax-loader").hide();
    $("input[name=nad_nazwa]").prop('disabled', true);
    $("input[name=nad_nip]").prop('disabled', true);  
    $("input[name=odb_nazwa]").prop('disabled', true);
    $("input[name=odb_nip]").prop('disabled', true); 
    
    $("input[name=rodzaj]").click(function(){
        $("input#pkg_weight").val('').prop('readonly', false);
        $("input#pkg_length").val('').prop('readonly', false);
        $("input#pkg_width").val('').prop('readonly', false);
        $("input#pkg_height").val('').prop('readonly', false);
    });
    
    $("input#pkg_type_env").click(function(){
        $("input#pkg_weight").val(1).prop('readonly', true);
        $("input#pkg_length").val(35).prop('readonly', true);
        $("input#pkg_width").val(25).prop('readonly', true);
        $("input#pkg_height").val(5).prop('readonly', true);
    }); 
    
    $('form#lokalizacja').submit(function(e) {
       e.preventDefault();
       var action = $(this).attr('action');
       var raw_text =  $(this).find('input[type=text]').val();
       var return_text = raw_text.replace(/[^a-zA-Z0-9 _]/g,'').toUpperCase();
       
       location.href = action+return_text;
    });
    
    $("#dialog").dialog({
      autoOpen: false,
      modal: true
    });
    
    $('#kurs_cz').hide();
    
    $('#form-action button').click(function(e) {
        e.preventDefault();
    });
   
    $('.nadajto').attr('top','-100px');
    
    $('#tabbed li a').click(function(){
        var clas = $(this).closest('li').attr('class'),
             top = '0px';
        switch (clas) {
            case '1': top = '-100px'; break;
            case '2': top = '0px'; break;
            case '3': top = '-130px'; break;
        }
        $('.nadajto').css('top',top);
    });
    
    $('input[name=COD_input]').keyup(function(){
      var kurs_cz = parseFloat($('#kurs_cz_input').val()),
          wartosc = parseFloat($(this).val())/kurs_cz;
      $('input[name=kurs_cz]').val(wartosc.toFixed(0));
    });
    
    $('input[name=COD_check]').click(function(){
        $('#kurs_cz').toggle();
        $('#bank-account').toggle();
        if(!$j(this).prop('checked')) {
            $j('input[name=COD_input]').val('');
        }
    });
    
    $('input[name=nad_imie]').keyup(function(){
        $('.formError').remove();
        var allowed = 22;
        
        var lname = $(this).closest('fieldset').find('input[name*=_nazwisko]');
        var nameAllowed = allowed-lname.val().length;
        var thisVal = $(this).val();
        //var sum = $(this).val().length+lname.val().length;
        if(thisVal.length>=nameAllowed) { 
            $(this).addClass('error'); 
            formError('Przekraczasz 22 znaków dla sumy imienia i nazwiska.',$(this));
            $(this).val(thisVal.substr(0,nameAllowed));
        }
    });
    
    $('input[name=nad_nazwisko]').keyup(function(){
        $('.formError').remove();
        var allowed = 22;
        
        var lname = $(this).closest('fieldset').find('input[name*=_imie]');
        var nameAllowed = allowed-lname.val().length;
        var thisVal = $(this).val();
        //var sum = $(this).val().length+lname.val().length;
        if(thisVal.length>=nameAllowed) { 
            $(this).addClass('error'); 
            formError('Przekraczasz 22 znaków dla sumy imienia i nazwiska.',$(this));
            $(this).val(thisVal.substr(0,nameAllowed));
        }
    });

    $('.sending-form').find('input[type=checkbox]').click(function(){
       checkboxChange();
    });
    
    $('#przesylka input[type=text]').keyup(function(){
       checkboxChange();
    });
    
    $('#przesylka input[type=radio]').click(function(){
       checkboxChange();
    });
    
    $('#nadawca-odbiorca input[name*=kod1]').keyup(function(){
       if($(this).val().length == 2) $(this).closest('div').find('input[name*=kod2]').focus();
    });
    
    $('#uslugi-dodatkowe input[type=text]').keyup(function() {
        var checkbox = $(this).closest('div').find('input[type=checkbox]');
        if($.trim($(this).val()).length > 0 && checkbox.prop('checked')===true) checkboxChange();
    });
    
    $('#go_c1').bind('mouseover',function(e) {
        ddrivetip('Nie wszystkie potrzebne pola zostały uzupełnione.');
        e.preventDefault();
        });
    $('#go_c1').bind('mouseout',function(e) {
        hideddrivetip();
        e.preventDefault();        
    });
    
    
    $.datepicker.regional['pl'] = {
        closeText: 'Zamknij',
        prevText: '&#x3c;Poprzedni',
        nextText: 'Następny&#x3e;',
        currentText: 'Dziś',
        monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec',
        'Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
        monthNamesShort: ['Sty','Lu','Mar','Kw','Maj','Cze',
        'Lip','Sie','Wrz','Pa','Lis','Gru'],
        dayNames: ['Niedziela','Poniedzialek','Wtorek','Środa','Czwartek','Piątek','Sobota'],
        dayNamesShort: ['Nie','Pn','Wt','Śr','Czw','Pt','So'],
        dayNamesMin: ['N','Pn','Wt','Śr','Cz','Pt','So'],
        weekHeader: 'Tydz',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['pl']);
    
    $("#data_nad").datepicker({ 
        minDate: 0
    });
    $(".kalendarz").click(function() { 
        var d = new Date();
        var h = d.getHours();
        if(h>=12) $('#data_nad').datepicker('option', 'minDate', '1');
        $("#data_nad").datepicker( "show" );
    });
    
    $('body').find('input').keypress(function(){
       if($(this).hasClass('error')) $(this).removeClass('error');
    });
    
    
    $('.sending-form').find('input[type=text]').change(function(){
        
        if(checkFields()===true && $('#przesylka input[type=radio]:checked').val()!=3) {
            $("#go_c1").unbind('mouseover').unbind('mouseout');
            $('#go_c1').unbind('click').bind('click', function(e){
              e.preventDefault();  
              var from = new Array(),
                    to = new Array(),
                   pkg = new Array(),
                  date = '',
                  user = new Array(),
                  amount = '',
                  bankacc, //bank account for COD
                  courier = 1; //1 dla UPS (id courier)
              
              $('.sending-form').find('.error').removeClass('error');
        
              user['id'] = $('#user_id').val();

              pkg['type'] = $('.pkg_type:checked').val();    
              pkg['weight'] = $('#pkg_weight').val();
              pkg['length'] = $('#pkg_length').val();
              pkg['width'] = $('#pkg_width').val();
              pkg['height'] = $('#pkg_height').val();
              pkg['notstand'] = $('#pkg_notstand').val();
              
              from['type'] = $('input[name=nad_typ]:checked').val();
              from['company'] = $('input[name=nad_nazwa]').val();
              from['nip'] = $('input[name=nad_nip]').val();
              from['name'] = $('input[name=nad_imie]').val();
              from['lname'] = $('input[name=nad_nazwisko]').val(); 
              from['addr'] = $('input[name=nad_ulica]').val();
              from['addr_house'] = $('input[name=nad_nrdomu]').val() +' '+ $('input[name=nad_nrlok]').val();  
              from['city'] = $('input[name=nad_miasto]').val(); 
              from['zip'] = $('input[name=nad_kod1]').val() +'-'+ $('input[name=nad_kod2]').val();
              from['phone'] = $('input[name=nad_telef]').val();
              from['email'] = $('input[name=nad_email]').val();
              from['email2'] = $('input[name=nad_email2]').val();
              
              //to['type'] = $('input[name=odb_typ]:checked').val();
              to['company'] = $('input[name=odb_nazwa]').val();
              to['nip'] = $('input[name=odb_nip]').val();
              to['name'] = $('input[name=odb_imie]').val();
              to['lname'] = $('input[name=odb_nazwisko]').val(); 
              to['addr'] = $('input[name=odb_ulica]').val();
              to['addr_house'] = $('input[name=odb_nrdomu]').val() +' '+ $('input[name=odb_nrlok]').val();  
              to['city'] = $('input[name=odb_miasto]').val(); 
              to['zip'] = $('input[name=odb_kod1]').val() +'-'+ $('input[name=odb_kod2]').val();
              to['phone'] = $('input[name=odb_telef]').val();
              
              if($('#odb_priv').is(':checked')) {
                  to['priv'] = $('#odb_priv').val();
              } else to['priv']=0;
              
              date = $('input[name=data_nad]').val();
              amount = $(this).parent().find('.price').html();
              if($('#bank-account').is(":visible")) {
                  bankacc=$('#bank-account').val(); 
              } else bankacc=false;
              
              var form1 = $('#przesylka fieldset').serialize(),
                 form3 =  $('#uslugi-dodatkowe fieldset').serialize(),
                 form = form1+'&'+form3;

              sendpayu(courier, user['id'],from,to,pkg,date,amount,form,bankacc);
            });
            $('#go_c1').css('background','#0da65e');
        } else {
            $('#go_c1').bind('mouseover',function(e) {
                ddrivetip('Nie wszystkie potrzebne pola zostały uzupełnione.');
                e.preventDefault();
                });
            $('#go_c1').bind('mouseout',function(e) {
                hideddrivetip();
                e.preventDefault();        
            });
            $("#go_c1").unbind('click').bind('click', function(e){
              e.preventDefault();});
            $('#go_c1').css('background','#70706d');
        }
    });
    
    $('#register-btn').click(function(e){
        e.preventDefault();
        var imie = $('input[name=imie]').val(),
            nazwisko = $('input[name=nazwisko]').val(),
            telefon = $('input[name=telefon]').val(),
            email = $('input[name=email]').val(),
            passw = $('input[name=passw]').val(),
            passw2 = $('input[name=passw2]').val();
            
        $('.bform').find('p.error').remove();    
        register(imie,nazwisko,telefon,email,passw,passw2);
    });
    
    $('#login-btn').click(function(e){
        e.preventDefault();
        var login = $('input[name=login]').val(),
            pass = $('input[name=passw]').val();
            
        $('.bform').find('p.error').remove();    
        loginToAccount(login,pass);
    });
    
    
 $(".confirmLink").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
      buttons : {
        "Tak" : function() {
          var id = $('#orderId').val();  
          cancelShipment(id);
        },
        "Anuluj" : function() {
          $(this).dialog("close");
        }
      }
    });

    $("#dialog").dialog("open");
  });



});

function checkboxChange() {
    
        var form1 = $('#przesylka fieldset').serialize(),
            form3 =  $('#uslugi-dodatkowe fieldset').serialize(),
            form = form1+'&'+form3;
    
            updatePrice(form)
}

function cancelShipment(id) {
     $.ajax({
              type: 'POST',
	      url: "/api/ship/void",
		  //cache: false,
              data: {
                  id : id
              },
              dataType: "json",
              beforeSend: function(){
                $('.ajax-loader').show();
              },
              success: function(data) {
               $('.ajax-loader').hide();
               $("#dialog").dialog('close'); 
                if(data.error == undefined && data == 'ok') {
                  $('tr.tr'+id).find('td.status').html('anulowane');
                  $('tr.tr'+id).find('a[rel=cancel]').hide();
                  alert('zamówienie zostało anulowane');
                } else {
                    alert(data.error);
                }

                console.log(data);
                    
                
              },
            error: function(xhr,textStatus,err)
                {
                    console.log("readyState: " + xhr.readyState);
                    console.log("responseText: "+ xhr.responseText);
                    console.log("status: " + xhr.status);

                }                       
        
	 });
            
}

function updatePrice(form) {
     $.ajax({
              type: 'POST',
	      url: "/form/price/update",
		  //cache: false,
              data: {
                  form : form
              },
              dataType: "json",
              beforeSend: function(){
                $('.ajax-loader').show();
              },
              success: function(data) {
               $('.ajax-loader').hide();
                //console.log(data);
                    if(data.error == undefined) {
                        for(var i in data)
                        {
                            //console.log(data[i]);
                            $('#courier_'+i+' .total-price').html(data[i]['price_brut']);
                            //$('#courier_'+i+' .total-price').html(data[i]['price_brut']);
                        }
                    } else {
                        alert(data.error);
                    }
                console.log(data);
                    
                
              },
            error: function(xhr,textStatus,err)
                {
                    console.log("readyState: " + xhr.readyState);
                    console.log("responseText: "+ xhr.responseText);
                    console.log("status: " + xhr.status);

                }                       
        
	 });
            
}

function checkFields() {
  var proceed = 0;
  var n;
  //subpage1
  n = $('#przesylka input[type=radio]:checked').length;
  if(n!=1) proceed++;
  

  $('#przesylka').find('input[type="text"]').each(function() {
      if($(this).val()=='') {proceed++;}
  });
  
  //subpage2

  
  $('#nadawca-odbiorca').find('input[type="text"][rel="require"]').each(function() {
      if($(this).val()=='' && $(this).prop('disabled')==false) { proceed++ };
  });
    
   if(proceed>0)return false; else return true;
};

 function nadFirm()
 {
	if($('#nadfirma').is(':checked')) {
		$('#nad_firma').show();
                $("input[name=nad_nazwa]").prop('disabled', false);
                $("input[name=nad_nip]").prop('disabled', false);                
        } else {
		$('#nad_firma').hide();
                $("input[name=nad_nazwa]").prop('disabled', true);
                $("input[name=nad_nip]").prop('disabled', true);                
        }
 }

 function odbFirm()
 {
	if($('#odbfirma').is(':checked')) {
		$('#odb_firma').show();
                $("input[name=odb_nazwa]").prop('disabled', false);
                $("input[name=odb_nip]").prop('disabled', false);
        } else {
		$('#odb_firma').hide();
                $("input[name=odb_nazwa]").prop('disabled', true);
                $("input[name=odb_nip]").prop('disabled', true);
        }
 }



function ship(from,to,pkg,date) {
	 $.ajax({
              type: 'POST',
	      url: "/api/ups/ship",
		  //cache: false,
              data: {
                  //nad_type : from['type'],        
                  nad_nazwa: from['company'],
                  nad_nip: from['nip'],
                  nad_imie: from['name'], 
                  nad_nazwisko: from['lname'], 
                  nad_addr: from['addr'], 
                  nad_nrdomu: from['addr_house'],
                  nad_miasto: from['city'], 
                  nad_zip: from['zip'],
                  nad_email: from['email'],
                  nad_email2: from['email2'],
                  //nad_country: 'PL',
                  nad_telef: from['phone'],
                  //odb_type : to['type'],              
                  odb_nazwa: to['company'],
                  odb_nip: to['nip'],              
                  odb_imie: to['name'], 
                  odb_nazwisko: to['lname'], 
                  odb_addr: to['addr'], 
                  odb_nrdomu: to['addr_house'],
                  odb_miasto: to['city'], 
                  odb_zip: to['zip'],
                  //odb_country: 'PL',
                  odb_telef: to['phone'],
                  waga: pkg['weight'],
                  dlu: pkg['lenght'],
                  szer: pkg['width'],
                  wys: pkg['height'],
                  data_nad: date
              },
              dataType: "json",
            beforeSend: function(){
                $('.ajax-loader').show();
            },
            success: function(data) {
               $('.ajax-loader').hide();
                  
                console.log(data);
                if(data.input == undefined) {
                    console.log(data);
                }
                else if(data.input.length>0) {
                    if($.inArray('nad_zip', data.input)>-1) {
                        $('input[name^=nad_kod').addClass('error');
                    }
                    if($.inArray('odb_zip', data.input)>-1) {
                        $('input[name^=odb_kod').addClass('error');
                    }
                     if($.inArray('nad_email', data.input)>-1) {
                        $('input[name^=nad_email').addClass('error');
                    }
                    $.each(data.input, function() {
                        $('input[name='+this+']').addClass('error');
                    });
                    
                    console.log(data);
                }
                               
              },
            error: function(xhr,textStatus,err)
                {
                    console.log("readyState: " + xhr.readyState);
                    console.log("responseText: "+ xhr.responseText);
                    console.log("status: " + xhr.status);

                }                       
        
	 });
            
}

 function sendpayu(courierid, userid, from, to, pkg, date, amount, form, bank) {   
        $('.formError').remove();
        $.ajax({
            type: "POST",
            url: '/payment/payu/sending',
            data: {
                  courierid : courierid, 
                  userid : userid, 
                  amount : amount,
                  nad_type : from['type'],        
                  nad_nazwa: from['company'],
                  nad_nip: from['nip'],
                  nad_imie: from['name'], 
                  nad_nazwisko: from['lname'], 
                  nad_addr: from['addr'], 
                  nad_nrdomu: from['addr_house'],
                  nad_miasto: from['city'], 
                  nad_zip: from['zip'],
                  nad_email: from['email'],
                  nad_email2: from['email2'],
                  //nad_country: 'PL',
                  nad_telef: from['phone'],
                  //odb_type : to['type'],              
                  odb_nazwa: to['company'],
                  odb_nip: to['nip'],              
                  odb_imie: to['name'], 
                  odb_nazwisko: to['lname'], 
                  odb_addr: to['addr'], 
                  odb_nrdomu: to['addr_house'],
                  odb_miasto: to['city'], 
                  odb_zip: to['zip'],
                  odb_priv: to['priv'],
                  //odb_country: 'PL',
                  odb_telef: to['phone'],
                  weight: pkg['weight'],
                  length: pkg['length'],
                  width: pkg['width'],
                  height: pkg['height'],
                  pkg_type : pkg['type'],
                  data_nad: date,
                  form: form,
                  bank: bank
                 },
            dataType: "json",
            async: false,
            beforeSend: function(){
            $('.ajax-loader').show();
            },
            success: function(data) {
               var tab, tmp;
               $('.ajax-loader').hide();
               $('#sessionId').val(data.sessionid);
               $('#oauth_token').val(data.token);
               //jezeli nie jest to input typu text to wrzucic tooltip z dymkiem gdzie info jest z msg obok danego pola
                if(data.input == undefined) {
                    $('form#sendingpayu').submit();
                }
                else if(data.input.length>0) {
                    if($.inArray('nad_zip', data.input)>-1) {
                        $('input[name^=nad_kod').addClass('error');
                        formError(data.msg[$.inArray( "nad_zip", data.input )],$('input[name=nad_kod1]'));
                    }
                    if($.inArray('odb_zip', data.input)>-1) {
                        $('input[name^=odb_kod').addClass('error');
                        formError(data.msg[$.inArray( "odb_zip", data.input )],$('input[name=odb_kod1]'));
                    }
                     if($.inArray('nad_email', data.input)>-1) {
                        if(!$('input[name^=nad_email').hasClass('error')) {
                             formError(data.msg[$.inArray( "nad_email", data.input )],$('input[name^=nad_email]'));
                        }
                        $('input[name^=nad_email').addClass('error');
                    }
                     if($.inArray('rodzaj', data.input)>-1) {
                        $('input[name=rodzaj').addClass('error');
                        formError(data.msg[$.inArray( "rodzaj", data.input )],$('input[name=rodzaj]').first());
                    }
                    if($.inArray('data', data.input)>-1) {
                        alert(data.msg[$.inArray( "data", data.input )]);
                    }
                    $.each(data.input, function(index) {
                        if(!$('input[name='+this+']').hasClass('error')) {
                            formError(data.msg[index],$('input[name='+this+']'));
                        }
                        $('input[name='+this+']').addClass('error');

                    });
                    
                }
                 console.log(data);
                },
             error: function(xhr,textStatus,err)
                {
                    console.log("readyState: " + xhr.readyState);
                    console.log("responseText: "+ xhr.responseText);
                    console.log("status: " + xhr.status);

                }
        });
}

 function register(imie, nazwisko, telefon, email, passw, passw2) {   
        $.ajax({
            type: "POST",
            url: '/rejestracja',
            data: {
                  imie : imie, 
                  nazwisko : nazwisko, 
                  telefon : telefon,
                  email : email, 
                  passw : passw, 
                  passw2 : passw2,                  
                 },
            dataType: "json",
            async: false,
            beforeSend: function(){
            $('.ajax-loader').show();
            },
            success: function(data) {
               $('.ajax-loader').hide();
               
                if(data.input == undefined) {
                    window.location.href = "/";
                }
                else if(data.input.length>0) {
                  
                    if($.inArray('passw', data.input)>-1) {
                        $('input[name^=passw').addClass('error');
                    }
                    $.each(data.input, function(index) {
                        $('input[name='+this+']').closest('p').before('<p class="error">'+data.msg[index]+'</p>');
                        $('input[name='+this+']').addClass('error');
                    });
                }
                 console.log(data);
                },
             error: function(xhr,textStatus,err)
                {
                    console.log("readyState: " + xhr.readyState);
                    console.log("responseText: "+ xhr.responseText);
                    console.log("status: " + xhr.status);

                }
        });
}

 function loginToAccount(login, pass) {   
        $.ajax({
            type: "POST",
            url: '/logowanie',
            data: {
                  login : login, 
                  pass : pass                  
                 },
            dataType: "json",
            async: false,
            beforeSend: function(){
            $('.ajax-loader').show();
            },
            success: function(data) {
               $('.ajax-loader').hide();
               
                if(data == 'admin') {
                    window.location.href = "/admin/";
                }
                else if(data.input == undefined) {
                    window.location.href = "/user/faktury";
                }
                else if(data.input.length>0) {
                  $.each(data.input, function(index) {
                        $('input[name='+this+']').closest('p').before('<p class="error">'+data.msg[index]+'</p>');
                        $('input[name='+this+']').addClass('error');
                  });
                }
                 console.log(data);
                },
             error: function(xhr,textStatus,err)
                {
                    console.log("readyState: " + xhr.readyState);
                    console.log("responseText: "+ xhr.responseText);
                    console.log("status: " + xhr.status);

                }
        });
}

function formError(msg,obj){
    obj.before('<p class="formError" style="color:red;">'+msg+'</p>');
}


