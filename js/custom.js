/** 
  * Template Name: Home Property
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. FIXED NAVBAR 
  2. AGENTS SLIDER
  3. TESTIMONIAL SLIDER  
  4. CLIENT BRAND SLIDER (SLICK SLIDER)
  5. TOP SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  7. HOVER DROPDOWN MENU
  8. ADVANCE SEARCH FILTER  (noUiSlider SLIDER)
  9. MIXIT FILTER ( FOR GALLERY ) 
  10. FANCYBOX ( FOR PORTFOLIO POPUP VIEW )
  11. SCROLL TOP BUTTON
  12. PRELOADER
  13. GRID AND LIST LAYOUT CHANGER 
  14.RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. FIXED NAVBAR 
  /* ----------------------------------------------------------- */
    
    
  jQuery(window).bind('scroll', function () {
    if (jQuery(window).scrollTop() > 200) {
        jQuery('.main-navbar').addClass('navbar-fixed-top');
        
      } else {
          jQuery('.main-navbar').removeClass('navbar-fixed-top');          
      }
  });
  
  /* ----------------------------------------------------------- */
  /*  2. AGENTS SLIDER
  /* ----------------------------------------------------------- */    

    jQuery('.aa-agents-slider').slick({
      dots: false,
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2500,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

  /* ----------------------------------------------------------- */
  /*  3. TESTIMONIAL SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('.aa-testimonial-slider').slick({
        dots: false,      
        infinite: true,
        speed: 500,      
        cssEase: 'linear'
      });

  /* ----------------------------------------------------------- */
  /*  4. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

   jQuery('.aa-client-brand-slider').slick({
      dots: false,
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2500,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

  
  /* ----------------------------------------------------------- */
  /*  5. TOP SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */    

    jQuery('.aa-top-slider').slick({
      dots: false,
      infinite: true,
      arrows: true,
      speed: 500,
      fade: true,
      cssEase: 'linear'
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-properties-details-img').slick({
      dots: false,
      infinite: true,
      arrows: true,
      speed: 500,      
      cssEase: 'linear'
    });

      
  /* ----------------------------------------------------------- */
  /*  7. HOVER DROPDOWN MENU
  /* ----------------------------------------------------------- */ 
  
  // for hover dropdown menu
    jQuery('ul.nav li.dropdown').hover(function() {
      jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
      jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });

 
  /* ----------------------------------------------------------- */
  /* 8. ADVANCE SEARCH FILTER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if(jQuery('body').is('.aa-price-range')){
        // FOR AREA SECTION
       var skipSlider = document.getElementById('aa-sqrfeet-range');
        noUiSlider.create(skipSlider, {
            range: {
              'min': 0,
			  '2%': 20,
			  '4%': 40,
			  '6%': 60,
			  '8%': 80,
              '10%': 100,
              '20%': 200,
              '30%': 400,
              '40%': 800,
              '50%': 1000,
              '60%': 2000,
              '70%': 5000,
              '80%': 7500,
              '90%': 10000,
              'max': 100000
            },
            snap: true,
            connect: true,
            start: [povrsina_od, povrsina_do]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });

        // FOR PRICE SECTION

        var skipSlider2 = document.getElementById('aa-price-range');
        noUiSlider.create(skipSlider2, {
            range: {
              'min': 0,
			  '2%': 50,
			  '4%': 100,
			  '6%': 500,
			  '8%': 1000,
              '10%': 2000,
              '20%': 5000,
              '30%': 10000,
              '40%': 20000,
              '50%': 50000,
              '60%': 100000,
              '70%': 500000,
              '80%': 1000000,
              '90%': 5000000,
              'max': 10000000
            },
            snap: true,
            connect: true,
            start: [cijena_od, cijena_do]
        });
        // for value print
        var skipValues2 = [
          document.getElementById('skip-value-lower2'),
          document.getElementById('skip-value-upper2')
        ];

        skipSlider2.noUiSlider.on('update', function( values, handle ) {
          skipValues2[handle].innerHTML = values[handle];
        });
      }
    });

  /* ----------------------------------------------------------- */
  /*  9. MIXIT FILTER ( FOR GALLERY ) 
  /* ----------------------------------------------------------- */  

    jQuery(function(){
      jQuery('#mixit-container').mixItUp();
    });

  /* ----------------------------------------------------------- */
  /*  10. FANCYBOX ( FOR PORTFOLIO POPUP VIEW ) 
  /* ----------------------------------------------------------- */ 
      
    jQuery(document).ready(function() {
      jQuery(".fancybox").fancybox();
    });  
   
    
  /* ----------------------------------------------------------- */
  /*  11. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if (jQuery(this).scrollTop() > 300) {
        jQuery('.scrollToTop').fadeIn();
      } else {
        jQuery('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      jQuery('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  12. PRELOADER
  /* ----------------------------------------------------------- */

   jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#aa-preloader-area').delay(300).fadeOut('slow'); // will fade out      
    })
   


  /* ----------------------------------------------------------- */
  /*  13. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#aa-list-properties").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-properties-nav").addClass("aa-list-view");
  });
  jQuery("#aa-grid-properties").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-properties-nav").removeClass("aa-list-view");
  });


  /* ----------------------------------------------------------- */
  /*  14. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

 
});

$('#search-form').on('submit',function(e){
	
	document.getElementById('cijena_od').value = document.getElementById('skip-value-lower2').innerHTML;
	document.getElementById('cijena_do').value = document.getElementById('skip-value-upper2').innerHTML;
	
	document.getElementById('povrsina_od').value = document.getElementById('skip-value-lower').innerHTML;
	document.getElementById('povrsina_do').value = document.getElementById('skip-value-upper').innerHTML;
	
});

$('#key, #limit, #order').on('change', function(e){
	var key = event.target.value;
	
	var param = getParamsAsObject(location.search);
	param[event.target.id] = key;
	
	if(event.target.id == 'limit')param.offset = 0;
	
	location.search = $.param(param);
	
});

$('#pag li').on('click', function(e){
	event.preventDefault();
	if($(this)[0].firstElementChild.className == 'disabled')return;
	
	var key = parseInt($(this).text().trim());
	
	if(isNaN(key)){
		
		key = $(this).text().trim();
		var pagItems = $('#pag li').slice(1,$('#pag li').length-1);
		
		if(key == '«'){
			key = parseInt(pagItems.find('a.disabled').html()) - 1;
		}
		else if(key == "»"){
			key = parseInt(pagItems.find('a.disabled').html()) + 1;
		}else{
			return;
		}
		
	}
	
	var param = getParamsAsObject(location.search);
	param.offset = key - 1;
	
	location.search = $.param(param);
	
});


var getParamsAsObject = function (query) {

    query = query.substring(query.indexOf('?') + 1);

    var re = /([^&=]+)=?([^&]*)/g;
    var decodeRE = /\+/g;

    var decode = function (str) {
        return decodeURIComponent(str.replace(decodeRE, " "));
    };

    var params = {}, e;
    while (e = re.exec(query)) {
        var k = decode(e[1]), v = decode(e[2]);
        if (k.substring(k.length - 2) === '[]') {
            k = k.substring(0, k.length - 2);
            (params[k] || (params[k] = [])).push(v);
        }
        else params[k] = v;
    }

    var assign = function (obj, keyPath, value) {
        var lastKeyIndex = keyPath.length - 1;
        for (var i = 0; i < lastKeyIndex; ++i) {
            var key = keyPath[i];
            if (!(key in obj))
                obj[key] = {}
            obj = obj[key];
        }
        obj[keyPath[lastKeyIndex]] = value;
    }

    for (var prop in params) {
        var structure = prop.split('[');
        if (structure.length > 1) {
            var levels = [];
            structure.forEach(function (item, i) {
                var key = item.replace(/[?[\]\\ ]/g, '');
                levels.push(key);
            });
            assign(params, levels, params[prop]);
            delete(params[prop]);
        }
    }
    return params;
};


$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
		fileReader.file = f;
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + this.file.name + "\"/>" +
            "<br/><span class=\"remove\"><i class='fa fa-trash'></i></span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

function remove_all_images(){
	$(".field").children(".pip").remove();
}

 $("#files").on("click", function(e) {
	 remove_all_images();
 });
 
 function getImages(){
	var arr = [];
	$(".field").children(".pip").each(function(i){
		arr.push($(".field").children(".pip")[i].firstElementChild.title);
	})
	return arr; 
 }
 
  function getOldImages(){
	var arr = [];
	$(".field1").children(".pip").each(function(i){
		arr.push($(".field1").children(".pip")[i].firstElementChild.title);
	})
	return arr; 
 }
 
  $("#dodaj_oglas").on("submit", function(e) {
	
	//event.preventDefault();
	
	this['mgr'].value = JSON.stringify(getImages());
	this['svojstva'].value = getTagValues();
	
	if(this['postojece'])
	this['postojece'].value = JSON.stringify(getOldImages());
	
 });
 
 function show_current_images(){
	 var arr = [];
	 var txt = $("#dodaj_oglas")[0]['postojece'].value;
	 if(txt)arr = JSON.parse(txt);
		
	 
	 var path = $("#dodaj_oglas")[0]['postojece'].getAttribute('data-path');
	 
	 arr.forEach(img =>{
		 if(img)
		 $(".field1").append("<span class=\"pip\">" +
			"<img class=\"imageThumb\" src=\"" + path+img + "\" title=\"" + img + "\"/>" +
			"<br/><span class=\"remove\" onclick = '$(this).parent().remove();' ><i class='fa fa-trash'></i></span>" +
			"</span>"
		  );
	 });
	 
 }
 
 function getTagValues(){
	var multiInput = document.querySelector('multi-input'); 
	var arr = multiInput.getValues(); 
	var str = arr.join(',');
	return str;
 }
 
  function setTagValues(str){
	var multiInput = document.querySelector('multi-input'); 
	var arr = str.split(',');
	arr.forEach(e =>{
		if(e)
		multiInput._addItem(e);
	});
 }
 
 function fill_input_tag(){
	var str = $("#dodaj_oglas")[0]['svojstva'].value;
	 setTagValues(str);
 }
 
$("a[data-del]").on("click", function(e) {
	 var answ = confirm('Da li ste sigurni da zelite da obriste ovu nekretninu?');
	 if(!answ)event.preventDefault();
 });
 
   $("a[data-del-admin]").on("click", function(e) {
	 var answ = confirm('Da li ste sigurni da nekretnina ima neprimjereni sadrzaj?');
	 if(!answ)event.preventDefault();
 });
