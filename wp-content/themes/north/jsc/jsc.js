jQuery(document).ready(function() {

			var table = $('#tablaor').DataTable({
				"lengthChange":false,
				"searching":false,
				"order": [],
				"language":{
					"paginate":{
						"first":"Primera",
						"last":"Última",
						"next":"Siguiente",
						"previous":"Anterior"
					},
					"info":"Mostrando pagina _PAGE_ de _PAGES_.",
					"infoEmpty":"Este usuario no tiene repositorios para mostrar.",
					"emptyTable":"No se encontraron repositorios."
				}
				});

		if($('.profesional #first_name').val()!=''){
			$('.profesional #first_name').attr('disabled','disabled');
		}
		

		try{
		
			$('.wp-pagenavi').before('<form><input style="margin-bottom:10px;" type="button" value="Volver" name="volver atrás2" onclick="history.back()" /></form>');
			var co='<div class="wp-pagenavi">'+$('.wp-pagenavi').html()+'</div><form><input style="margin-top:10px;" type="button" value="Volver" name="volver atrás2" onclick="history.back()" /></form>';
			if(co!='<div class="wp-pagenavi">null</div><form><input style="margin-top:10px;" type="button" value="Volver" name="volver atrás2" onclick="history.back()" /></form>'){
			$('.wpb_wrapper .profesionales').append(co);}
				}catch(err){
		
        }
		
		$('.proveedores .login.profile .DESEOMAIL input').attr('disabled','disabled');
		$('.propiedadhorizontal .login.profile .DESEOMAIL input').attr('disabled','disabled');
		 
		
		if($( window ).width()>1024){
			setTimeout(function() {	
				var tame=jQuery("#navigation li").width();
				 tame=(tame*4)+40;
				jQuery("#navigation").css('width',tame);
			}, 10);
			
		} 
		
		$('.profesional .NOMBREORAZON, .profesional .NIT, .profesional .PERSONAADMIN, .profesional .PERSONAPRES, .profesional .CATEGORIA, .profesional .LOGO').remove();
		$('.propiedadhorizontal .CEDULA, .propiedadhorizontal .FIRSTNAME, .propiedadhorizontal .TITULO, .propiedadhorizontal .CARGO, .propiedadhorizontal .CURRICULUM, .propiedadhorizontal .CATEGORIA, .propiedadhorizontal .LOGO').remove();
		$(' .proveedores .FIRSTNAME, .proveedores .TITULO, .proveedores .CARGO, .proveedores .CURRICULUM').remove();
		
		$('.description.ZONA , .ZONA td').append('<a class="cboxElement" title="Clic en tu zona" rel="lightbox[test demo]" href="/wp-content/themes/increase/img/MAPA-CONVICAR.jpg" usemap="#MapC">    Clic aqui para ver zonas</a><map name="MapC"><area shape="rect" coords="598,398,600,400" alt="Image Map" style="outline:none;" title="Image Map"/><area id="4" alt="" title="" href="javascript:selec(4);" shape="poly" coords="60,78,232,77,246,82,260,58,244,59,228,47,203,39,198,28,188,35,178,33,164,38,151,31,146,30,139,31,134,26,133,23,133,20,126,24,126,39,117,31,110,32,112,47,87,37,84,34,76,42,55,50,55,61,54,67" style="outline:none;" /><area id="2" alt="" title="" href="javascript:selec(2);" shape="poly" coords="252,85,264,61,273,59,279,68,293,67,301,67,312,65,319,66,319,84,326,87,311,105,265,109,254,103" style="outline:none;" /><area id="1" alt="" title="" href="javascript:selec(1);" shape="poly" coords="326,71,325,81,333,82,314,106,390,139,397,130,412,97,426,85,424,77,404,77,397,75,398,67,391,70,383,76,370,68,352,62" style="outline:none;"  /><area id="6" alt="" title="" href="javascript:selec(6);" shape="poly" coords="449,77,478,90,494,86,490,94,481,97,460,96,444,113,465,119,484,115,492,118,497,103,505,98,514,100,543,98,552,99,560,95,567,100,561,108,571,107,573,117,568,118,568,126,573,136,562,142,543,125,529,125,510,144,491,143,484,149,481,141,471,142,462,166,471,167,480,191,467,197,465,209,456,206,451,207,453,197,450,196,442,193,432,206,435,214,426,223,423,223,413,230,423,239,434,237,437,249,423,265,421,282,430,295,438,297,437,309,467,329,443,343,435,351,421,346,425,338,425,327,412,327,415,320,407,311,404,309,412,301,396,287,387,282,377,295,374,288,365,287,369,305,367,314,347,293,344,282,333,276,322,284,308,284,341,257,367,169,402,133,415,98" style="outline:none;"  /><area id="5" alt="" title="" href="javascript:selec(5);" shape="poly" coords="173,196,198,194,201,212,196,214,188,212,186,217,195,225,194,237,202,248,208,246,218,265,225,257,236,260,242,257,254,259,266,255,275,233,291,242,289,249,313,276,337,256,363,168,388,144,304,107,262,113,249,103,253,91,241,89,231,113,215,119,197,173" style="outline:none;"     /><area id="3" alt="" title="" href="javascript:selec(3);" shape="poly" coords="68,81,70,96,66,101,68,108,80,111,88,124,97,121,105,133,88,146,100,159,108,156,111,164,111,172,115,185,121,196,127,200,132,196,139,196,140,205,154,205,164,196,178,193,194,171,209,119,229,111,236,84,230,78" style="outline:none;"   /><area id="7" alt="" title="" href="javascript:selec(7);" shape="poly" coords="25,74,49,78,69,129,97,182,145,229,189,257,255,282,329,316,373,326,402,351,328,363,176,344,91,320,51,322,30,314" style="outline:none;"   /></map>'); 
		
		
		
		$( '.cboxElement').click(function() {
			
			setTimeout(function() {
				$('#cboxLoadedContent .cboxPhoto').attr('usemap', '#MapC');
			}, 900);		
			
		});	
		
		$(".entry.profesional .ROLES input").val('Profesional');
		$(".entry.propiedadhorizontal .ROLES input").val('Propiedad Horizontal');
		$(".entry.proveedores .ROLES input").val('Proveedores');
		
		
		
			function gup( name ){
				var regexS = "[\\?&]"+name+"=([^&#]*)";
				var regex = new RegExp ( regexS );
				var tmpURL = window.location.href;
				var results = regex.exec( tmpURL );
				if( results == null )
					return"";
				else
					return results[1];
			}
			var param = gup( 'mail' );
				setTimeout(function() {	
					if(param=='enviado'){ 
						$('#contacto').before('<p class="error" style="font-size:30px;"><strong>CONVOCATORIA REALIZADA CON EXITO!</strong></p>');
					}
				}, 400);	
	
		cargos();
			
			
			
			function trim( text ){
				while (text.toString().indexOf(" ") != -1)
				text = text.toString().replace(" ","");
				return text;
			}
			var parame = gup( 'cat' );
				$( "#carg option" ).each(function() {
					if(decodeURIComponent(parame)==trim($( this ).text())){
						var conn='<p>Se encuentra en la categoria:<a style="cursor:default; font-size:25px; color:#B40404;"> '+($( this ).text())+'</a></p>';
						$('.wpb_wrapper .selcargos').before(conn);
					}
				});
				
			var parame = gup( 'tipo' );
				$( "#carg option" ).each(function() {
					if(decodeURIComponent(parame)==trim($( this ).text())){
						var conn='<p>Se encuentra en el cargo:<a style="cursor:default; font-size:25px; color:#B40404;"> '+($( this ).text())+'</a></p>';
						$('.wpb_wrapper .selcargos').before(conn);
					}
				});
				
				
				
		$('.botbus.prof').click(function(e) {
			var bus = $("input.buscar.prof").val();
			window.location=('/profesionales-por-listado/?buscar='+bus);
		});
		$('.botbus.prov').click(function(e) {
			var bus = $("input.buscar.prov").val();
			window.location=('/proveedores-por-listado/?buscar='+bus);
		});
		
		$('#contacto .envi').click(function(e) {
			var band=true;
			
			var cargos = $('#carg').val();
			var tenvio = $('.tenvio').val();
			
			if (cargos!='filtro'&&tenvio!=''){
					band=false;
			}
			
				if(band){
					e.preventDefault();
					$('.error2').remove();
					$('.envi').after('<p class="error error2"><strong>Seleccionar una categoria / Escribir la descripción de la convocatoria</strong></p>');
				}
		});
		
		$('#contacto .envi2').click(function(e) {
			var band=true;
			
			var cargos = $('#carg').val();
			var tenvio = $('.tenvio').val();
			
			if (cargos!='filtro'&&tenvio!=''){
					band=false;
			}
			
				if(band){
					e.preventDefault();
					$('.error2').remove();
					$('.envi2').after('<p class="error error2"><strong>Seleccionar un cargo / Escribir la descripción de la convocatoria</strong></p>');
				}
		});
		
		
		
		
			/*Inicio validacion propiedad horizontal*/
		$('.propiedadhorizontal .reg').click(function(e) {
			var band=true;
			var error='';
			var usuario=$('#user_login').val();
			if (usuario==''){
				error +='-Usuario<br>';
			}
			var email=$('#user_email').val();
			if (email==''){
				error +='-Correo Electrónico<br>';
			}
			var razon = $('.NOMBREORAZON input').val();
			if (razon==''){
				error +='-Nombre o Razon<br>';
			}
			var nit = $('.NIT input').val();
			if (nit==''){
				error +='-Nit<br>';
			}
			var direc = $('.DIRECCION input').val();
			if (direc==''){
				error +='-Dirección<br>';
			}
			var ciud = $('.CIUDAD input').val();
			if (ciud==''){
				error +='-Ciudad<br>';
			}
			var admin = $('.PERSONAADMIN input').val();
			if (admin==''){
				error +='-Nombre Administrador(a)<br>';
			}
			/*
			var pres = $('.PERSONAPRES input').val();
			if (pres==''){
				error +='-Nombre Presidente(a) consejo<br>';
			}*/
			var zon = $('.ZONA select').val();
			if (zon=='Aqui'){
				error +='-Zona<br>';
			}
			var tel = $('.TELEFONOS input').val();
			if (tel==''){
				error +='-Telefono<br>';
			}
			var cel = $('.CELULAR input').val();
			if (cel==''){
				error +='-Celular<br>';
			}
			var pas1 = $('#pass1').val();
			if (pas1==''){
				error +='-Contraseña<br>';
			}
			var pas2 = $('#pass2').val();
			if (pas2==''){
				error +='-Confirmar Contraseña<br>';
			}
			if (pas1!=pas2){
				error +='-Contraseñas diferentes<br>';
				var co=1;
			}else{
				var co=0;
			}
			var vali=$('#pass-strength-result').html();
			if(vali!='Fuerte'){
				error +='-Contraseña sin caracteres obligatorios<br>';
			}
			vali='Fuerte';
			var ter = $('.TERMINOS input').is(':checked');
			if (ter==false){
				error +='-Debes aceptar los términos y condiciones<br>';
			}
			
			if (usuario!=''&&email!=''&&razon!=''&&nit!=''&&direc!=''&&ciud!=''&&admin!=''&&zon!='Aqui'&&tel!=''&&cel!=''&&pas1!=''&&pas2!=''&&co==0&&vali=='Fuerte'&&ter==true){
				band=false;
			}
			
			if(band){
				e.preventDefault();
				$('.error2').remove();
				$('.propiedadhorizontal .reg').after('<p class="error error2"><strong>Llenar todos los campos correctamente<br>'+error+'</strong></p>');
			}
				
		});
		
	/*Fin validacion propiedad horizontal*/
	
	/*Inicio validacion profesional*/
		$('.profesional #registerform #wp-submit').click(function(e) {
			var band=true;
			var error='';
			var usuario=$('#user_login').val();
			if (usuario==''){
				error +='-Usuario<br>';
			}
			var email=$('#user_email').val();
			if (email==''){
				error +='-Correo Electrónico<br>';
			}
			var razon = $('.FIRSTNAME input').val();
			if (razon==''){
				error +='-Apellido(s)/Nombre(s)<br>';
			}
			var nit = $('.CEDULA input').val();
			if (nit==''){
				error +='-Cédula<br>';
			}
			var tit = $('.TITULO input').val();
			if (tit==''){
				error +='-Título<br>';
			}
			var ca = $('.CARGO select').val();
			if (ca=='Cargo'){
				error +='-Cargo de interes<br>';
			}
			var direc = $('.DIRECCION input').val();
			if (direc==''){
				error +='-Dirección<br>';
			}
			var ciud = $('.CIUDAD input').val();
			if (ciud==''){
				error +='-Ciudad<br>';
			}
			var zon = $('.ZONA select').val();
			if (zon=='Aqui'){
				error +='-Zona<br>';
			}
			var tel = $('.TELEFONOS input').val();
			if (tel==''){
				error +='-Telefono<br>';
			}
			var cel = $('.CELULAR input').val();
			if (cel==''){
				error +='-Celular<br>';
			}
					
			var des = $('.DESCRIPCION textarea').val();
			if (des==''){
				error +='-Descripción<br>';
			}
			
			var pas1 = $('#pass1').val();
			if (pas1==''){
				error +='-Contraseña<br>';
			}
			var pas2 = $('#pass2').val();
			if (pas2==''){
				error +='-Confirmar Contraseña<br>';
			}
			if (pas1!=pas2){
				error +='-Contraseñas diferentes<br>';
				var co=1;
			}else{
				var co=0;
			}
			var vali=$('#pass-strength-result').html();
			/*if(vali!='Fuerte'){
				error +='-Contraseña sin caracteres obligatorios<br>';
			}*/
			vali='Fuerte';
			var ter = $('.TERMINOS input').is(':checked');
			if (ter==false){
				error +='-Debes aceptar los términos y condiciones<br>';
			}
			if (usuario!=''&&email!=''&&razon!=''&&nit!=''&&tit!=''&&ca!=''&&direc!=''&&ciud!=''&&zon!='Aqui'&&tel!=''&&cel!=''&&des!=''&&pas1!=''&&pas2!=''&&co==0&&vali=='Fuerte'&&ter==true){
				band=false;
			}
			
			if(band){
				e.preventDefault();
				$('.error2').remove();
				$('.profesional #registerform #wp-submit').after('<p class="error error2"><strong>Llenar todos los campos correctamente<br>'+error+'</strong></p>');
			}
				
		});
	/*Fin validacion profesional*/
	
	/*Inicio validacion proveedores*/
		$('.proveedores #registerform #wp-submit').click(function(e) {
			var band=true;
			var error='';
			var usuario=$('#user_login').val();
			if (usuario==''){
				error +='-Usuario<br>';
			}
			var email=$('#user_email').val();
			if (email==''){
				error +='-Correo Electrónico<br>';
			}
			var razon = $('.NOMBREORAZON input').val();
			if (razon==''){
				error +='-Nombre o Razon<br>';
			}
			var nit = $('.NIT input').val();
			if (nit==''){
				error +='-Nit<br>';
			}
			var direc = $('.DIRECCION input').val();
			if (direc==''){
				error +='-Dirección<br>';
			}
			var ciud = $('.CIUDAD input').val();
			if (ciud==''){
				error +='-Ciudad<br>';
			}
			var zon = $('.ZONA select').val();
			if (zon=='Aqui'){
				error +='-Zona<br>';
			}
			var tel = $('.TELEFONOS input').val();
			if (tel==''){
				error +='-Telefono<br>';
			}
			var cel = $('.CELULAR input').val();
			if (cel==''){
				error +='-Celular<br>';
			}
			var pas1 = $('#pass1').val();
			if (pas1==''){
				error +='-Contraseña<br>';
			}
			var pas2 = $('#pass2').val();
			if (pas2==''){
				error +='-Confirmar Contraseña<br>';
			}
			if (pas1!=pas2){
				error +='-Contraseñas diferentes<br>';
				var co=1;
			}else{
				var co=0;
			}
			var vali=$('#pass-strength-result').html();
			/*if(vali!='Fuerte'){
				error +='-Contraseña sin caracteres obligatorios<br>';
			}*/
			vali='Fuerte';
			var ter = $('.TERMINOS input').is(':checked');
			if (ter==false){
				error +='-Debes aceptar los términos y condiciones<br>';
			}
			
			if (usuario!=''&&email!=''&&razon!=''&&nit!=''&&direc!=''&&ciud!=''&&zon!='Aqui'&&tel!=''&&cel!=''&&pas1!=''&&pas2!=''&&co==0&&vali=='Fuerte'&&ter==true){
				band=false;
			}
			
			if(band){
				e.preventDefault();
				$('.error2').remove();
				$('.proveedores #registerform #wp-submit').after('<p class="error error2"><strong>Llenar todos los campos correctamente<br>'+error+'</strong></p>');
			}
				
		});
		

	
	/*Fin validacion proveedores*/
	
	/*Inicio validacion numerica*/
	$('.CELULAR input').keypress(function (tecla) {     
			  if((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 45) && (tecla.charCode != 32)&& (tecla.charCode != 0)) return false;
	});
	/*$('.TELEFONOS input').keyup(function () {     
			  this.value = this.value.replace(/[^0-9\.]/g,'');
	});*/

	$('.NIT input').keypress(function(tecla) {
        if((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 45) && (tecla.charCode != 0)) return false;
    });
	$('.CEDULA input').keyup(function () {     
			  this.value = this.value.replace(/[^0-9\.]/g,'');
	});
	/*Fin validacion numerica*/
	
	
	
	/*Inicio validacion contraseña*/
			/*if($('input#pass12')!=''){
				$('#pass-strength-result').html(checkStrength($('input#pass12').val()));
			}		
			
			if($('input#pass22')!=''){

				if($('input#pass12').val()==$('input#pass22').val()){
				
					$('#pass-strength-result').html('Coinciden');
				}else{
				
					$('#pass-strength-result').html('No coinciden');
				}				
			}*/	
			$('input#pass12').keyup(function(){
				$('input#pass12').attr('type','password');
				$('#pass-strength-result').html(checkStrength($('input#pass12').val()));
			});		
			
			$('input#pass22').keyup(function(){
				$('input#pass22').attr('type','password');
				if($('input#pass12').val()==$('input#pass22').val()){
				
					$('#pass-strength-result').html('Coinciden');
				}else{
				
					$('#pass-strength-result').html('No coinciden');
				}				
			});	
	/*Fin validacion contraseña*/
	
	$('.DESCRIPCION textarea').after('<div id="chars" style="margin-left: 30%;"></div>');
	
	try{
	var elem = $("#chars");
	$('.DESCRIPCION textarea').limiter(300, elem);
	}catch(err){

        } 
		
});


try {
(function($) {
    $.fn.extend( {
        limiter: function(limit, elem) {
            $(this).keyup( function() {
                setCount(this, elem);
            });
            function setCount(src, elem) {
                var chars = src.value.length;
                if (chars > limit) {
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                elem.html( limit - chars );
            }
            setCount($(this)[0], elem);
        }
    });
})(jQuery);
}catch(err){

        }


		function checkStrength(password){
			
			//initial strength
			var strength = 0;
		 
			//if the password length is less than 6, return message.
			if (password.length < 4) {
				$('#pass-strength-result').removeClass();
				$('#pass-strength-result').addClass('short');
				return 'Demasiado corto';
			}
		 
			//length is ok, lets continue.
		 
			//if length is 8 characters or more, increase strength value
			if (password.length > 5){
			strength += 1;
			}		 
			//if password contains both lower and uppercase characters, increase strength value
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)){
			strength += 1;
			}		 
			//if it has numbers and characters, increase strength value
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)){  
			strength += 1 ;
			}		 
			//if it has one special character, increase strength value
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)){  
			strength += 1;
			}		 
			//if it has two special characters, increase strength value
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)){ 
			strength += 1;
			}		 
			//now we have calculated strength value, we can return messages
		 
			//if value is less than 2
			if (strength < 3 ) {
				$('#pass-strength-result').removeClass();
				$('#pass-strength-result').addClass('weak');
				return 'Debil';
			} else if (strength == 3 ) {
				$('#pass-strength-result').removeClass();
				$('#pass-strength-result').addClass('good');
				return 'Buena';
			} else {
				$('#pass-strength-result').removeClass();
				$('#pass-strength-result').addClass('strong');
				return 'Fuerte';
			}
		}










function selec(zona){
	$('.ZONA select').val(zona);
	$('#cboxClose').click();
}


function cargos() {
	$("select.carg.cargo").change(function() {
			  var str = "";
				$( "select option:selected" ).each(function() {
						str += $( this ).val() + " ";
				});
				/*$(".filtro").slideUp()
				$("."+str).show('slow');*/
				
				window.location=('?tipo='+str);
			});
	$("select.carg.cate").change(function() {
			  var str = "";
				$( "select option:selected" ).each(function() {
						str += $( this ).val() + " ";
						
				});
				/*$(".filtro").slideUp()
				$("."+str).show('slow');*/
				
				window.location=('?cat='+str);
			});
}
	

	
function RegresarEstilo() {
	$( ".filtro" ).removeClass("grids");
}



function CambiarEstilo() {
	$( ".filtro" ).addClass("grids");
} 

function uploadFile(form_name, field_name, msg, extensions) {
	var browser = navigator.appName;
	var formblock = document.getElementById(form_name);
	var field = document.getElementById(field_name);

	// as usual not respecting standards, bugger!
	if (browser == "Microsoft Internet Explorer")
		formblock.encoding = "multipart/form-data";
	else
		formblock.enctype = "multipart/form-data";
	
	var upload = field.value;
	upload = upload.toLowerCase();
	
	if (upload != '') {
		var ext1 = upload.substring((upload.length-3),(upload.length));
		var ext2 = upload.substring((upload.length-4),(upload.length));
	}

	// if array is empty then means all extensions are allowed
	if (extensions.length > 0) {
		var found = false;
		for (var i=0; i<extensions.length; i++) {
			var ext = extensions[i].toLowerCase();

			if ((ext1 == ext) || (ext2 == ext)) {
				found = true;
				break;
			}
		}
		
		if (!found) {
			field.value = '';
			alert(msg+": "+extensions.join(' '));
		}
	}
}


jQuery(window).scroll(function(){
    	if($( window ).width()>1024){
			if( $(this).scrollTop() > 600 ) {
				   $('.public').css('position','fixed');
				   var ww=$('.bar.widget_text').width();
				   $('.public').css('width',ww);
			}else{
					$('.public').css('position','static');
			}			
		}
});


