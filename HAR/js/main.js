$(document).ready(function(){

	// Objeto del Banner
	var banner = {
		padre: $('#banner'),
		numeroSlides: $('#banner').children('.slide').length,
		posicion: 1
	};

		// Objeto del Slider de Info
	var info = {
		padre: $('#info'),
		numeroSlides: $('#info').children('.slide').length,
		posicion: 1
	}


	// Se establece que el primer slide aparezca desplazado
	banner.padre.children('.slide').first().css({
		'left': 0
	});

	// Establecemos que el primer slide aparecera desplazado
	info.padre.children('.slide').first().css({
		'left': 0
	});	

	// Función para calcular el alto que tendrán los contenedores padre:

	var altoBanner = function(){
		//se calcula la altura de cada slide y se guardan en la variable alto
		var alto = banner.padre.children('.slide').outerHeight();  
		banner.padre.css({
			'height': alto + 'px'
		});
	}

	var altoInfo = function(){
		var alto = info.padre.children('.active').outerHeight();
		info.padre.animate({
			'height': alto + 'px'
		});
	}

	// Se establece que el #contenedor tenga el 100% del alto de la pagina. 
	// Para despues centrarlo verticalente con flexbox.
	var altoContenedor = function(){
		var altoVentana = $(window).height();

		if (altoVentana <= $('.contenedor').outerHeight() + 200) {
			$('#contenedor').css({'height': ''});
		} else {
			$('#contenedor').css({'height': altoVentana + 'px'});
		}
	}

	// Se ejecutan las funciones para calcular los altos.
	altoBanner();
	altoContenedor();
	altoInfo();



	//Función para  saber el nuevo tamaño del elemento padre en caso de que
	//se haya cambiado el tamaño de la pantalla
	//Función para que la pantalla sea RESPONSIVE 
	$(window).resize(function(){
		altoBanner();
		altoInfo();
		altoContenedor();
	});

// ---------------------------------------
// ----- TODO EL CÓDIGO QUE TIENE QUE VER CON EL
//------BANNER 
// ---------------------------------------

	// CÓDIGO DEL BOTÓN SIGUIENTE (banner-next)

	$('#banner-next').on('click', function(e){
		e.preventDefault();

		if (banner.posicion < banner.numeroSlides){

			//Así se asegura que los demás slides empiezan desde la derecha:
			banner.padre.children().not('.active').css({
				'left': '100%'
			});

			// Se quita la clase active y se le pone al siguiente elemento, y luego se anima: 
			$('#banner .active').removeClass('active').next().addClass('active').animate({
				'left': 0
			});

			// Se anima el slide anterior para que se deslice a la izquierda:
			$('#banner .active').prev().animate({
				'left': '-100%'
			});

			banner.posicion=banner.posicion +1; 

		}else {

			//Así es cómo el slide activo(el último), se anime hacia la derecha:
			$('#banner .active').animate({
				'left': '-100%'
			});

			//Se seleccionan todos los slides que no tengan la clase .active y se posicionan a la derecha: 
			banner.padre.children().not('.active').css({
				'left': '100%'
			});

			//Se elimina la calse .active y se le one al primer elemento, luego se anima: 
			$('#banner.active').removeClass('active');
			banner.padre.children('.slide').first().addClass('active').animate({
				'left':0
			}); 

			//Se resetea la posición del banner a 1 
			banner.posicion =1; 
		}

	});

// CÓDIGO DEL BOTÓN ANTERIOR (banner-prev)
		$('#banner-prev').on('click', function(e){
			e.preventDefault();

			if (banner.posicion > 1){

				// Aspi se asegura que de todos los elementos hijos (que no sean) .active
				// se posicionen a la izquierda
				banner.padre.children().not('.active').css({
					'left': '-100%'
				});

				// Deslpazamos el slide activo de izquierda a derecha
				$('#banner .active').animate({
					'left': '100%'
				});

				// Eliminamos la clase active y se la ponemos al slide anterior.
				// Y lo animamos
				$('#banner .active').removeClass('active').prev().addClass('active').animate({
					'left': 0
				});

				// Reiniciamos la posicion a 1
				banner.posicion = banner.posicion - 1;
			} else {

				// Nos aseguramos de que los slides empiecen a la izquierda
				banner.padre.children().not('.active').css({
					'left': '-100%'
				});

				// Se anima el slide activo hacia la derecha
				$('#banner .active').animate({
					'left': '100%'
				});

				// Se elimina la clase active y se le pone al primer elemento.
				// Despues se anima 
				$('#banner .active').removeClass('active');
				banner.padre.children().last().addClass('active').animate({
					'left': 0
				});

				// Se resetea la posicion a 1
				banner.posicion = banner.numeroSlides;
			}

		});


// ---------------------------------------
// ----- Slider Info
// ---------------------------------------
// Boton Siguiente

	$('#info-next').on('click', function(e){
		e.preventDefault();

		if (info.posicion < info.numeroSlides){
			// Asegurarse de que los demás slides empiecen desde la derecha.
			info.padre.children().not('.active').css({
				'left': '100%'
			});

			// Se quita la clase active y se le pone al siguiente elemento, y se anima: 
			$('#info .active').removeClass('active').next().addClass('active').animate({
				'left': 0
			});

			// Se anima el slide anterior para que se deslace hacia la izquierda
			$('#info .active').prev().animate({
				'left': '-100%'
			});

			// Se elimina la clase active y se le pone  al siguiente elemento
			$('.botones').children('.active').removeClass('active').next().addClass('active');
				
			// Se incrementa la posicion en 1
			info.posicion = info.posicion + 1;
		} else {
			// El slide activo (es decir el ultimo) se anima hacia la derecha
			$('#info .active').animate({
				'left': '-100%'
			});

			// Se seleccionan todos los slides que no tengan la clase .active
			// y se posicionans a la derecha
			info.padre.children().not('.active').css({
				'left': '100%'
			});

			// Se elimina la clase active y se le pone al primer elemento
			// Despues se anima. 
			$('#info .active').removeClass('active');
			info.padre.children().first().addClass('active').animate({
				'left': 0
			});

			// Se elimina la clase active y se la ponemos al primer elemento
			//$('.botones').children('.active').removeClass('active');
			//$('.botones').children('span').first().addClass('active');

			// Se resetea la posicion a 1
			info.posicion = 1;
		}

		altoInfo();
	});

// Boton Anterior
		$('#info-prev').on('click', function(e){
			e.preventDefault();

			if (info.posicion > 1){

				// Se asegura que todos los elementos hijos (que no sean) .active
				// se posicionen a la izquierda
				info.padre.children().not('.active').css({
					'left': '-100%'
				});

				// Se desplaza el slide activo de izquierda a derecha
				$('#info .active').animate({
					'left': '100%'
				});

				// Se elimina la clase active y se le pone al slide anterior.
				// Luego se anima
				$('#info .active').removeClass('active').prev().addClass('active').animate({
					'left': 0
				});

				$('#botones').children('.active').removeClass('active').prev().addClass('active');

				// Se reinicia  la posicion a 1
				info.posicion = info.posicion - 1;
			} else {

				// Asegurarse de que los slides empiecen a la izquierda
				info.padre.children().not('.active').css({
					'left': '-100%'
				});

				// Se anima el slide activo hacia la derecha
				$('#info .active').animate({
					'left': '100%'
				});

				// Se elimina la clase active y se la ponemos al primer elemento.
				// Despues se animan.
				$('#info .active').removeClass('active');
				info.padre.children().last().addClass('active').animate({
					'left': 0
				});

				//$('#botones').children('.active').removeClass('active');
				//$('#botones').children('span').last().addClass('active');

				// Reseteamos la posicion a 1
				info.posicion = info.numeroSlides;
			}

			altoInfo();
		});

});	