 <div id="footer">

 <div class="foot2">
 <a href="<?php echo base_url(); ?>web/dekstop">Lihat Versi Desktop</a> <br>

 <div class="foot2">
 <a href="<?php echo base_url(); ?>mobile/statis/sejarah">Sekilas Pinggir</a> .
				<a href="<?php echo base_url(); ?>mobile/link/kepegawaian">Kepegawaian</a> .
				<a href="<?php echo base_url(); ?>mobile/link/kontak-kami">Kontak Kami</a>
 
<br>
<br>
<b>AVAILABLE ON : </b><br><br>
                    <div class="cleaner_h5"></div>
  <div class="pemisah"> </div> 
  <div class="cleaner_h5"></div>
<div class="cleaner_h5"></div>
<a href="#" target="_blank">

<img style="height:30px;" src="<?php echo base_url(); ?>google.png"></a>&nbsp;&nbsp;

<img style="height:30px;" src="<?php echo base_url(); ?>apple.png"></a>
 </div>
 <div class="sosmed">
 <a href="https://www.facebook.com/Kecamatan-Pinggir-1900833760178669" target="_blank"><img src="<?php echo base_url(); ?>baru/images/001-facebook.png" alt=""></a>
 <a href="https://twitter.com/pinggirbks" target="_blank"><img src="<?php echo base_url(); ?>baru/images/003-twitter.png" alt=""></a>
 <a href="https://plus.google.com/112608269492397203003" target="_blank"><img src="<?php echo base_url(); ?>baru/images/002-google-plus.png" alt=""></a>
 
  <a href="https://www.instagram.com/kecamatanpinggir" target="_blank"><img src="<?php echo base_url(); ?>baru/images/004-instagram.png" alt=""></a>
  
   <a href="https://www.youtube.com/channel/UCohnqV_T0QdqP6pj36xtt2A" target="_blank"><img src="<?php echo base_url(); ?>baru/images/005-youtube.png" alt=""></a>

 </div>
 <div class="clearfix"></div>
 Copyright &copy; 2017 Kecamatan Pinggir Kabupaten Bengkalis<br/>
				Jl. Bathin Muajolelo Kecamatan Pinggir Kabupaten Bengkalis - Riau<br>
				Telp. 0765-707147 Fax. 0765-561050, email: kecamatanpinggirbengkalis@gmail.com
 </div>
</div>

<div class="scrollup"><a href="#top"><img src="<?php echo base_url(); ?>baru/images/back_to_top@2x.png" width="37px" alt="Back To Top"></a></div>
<script type="text/javascript" src="<?php echo base_url(); ?>baru/js/it.mobile.js"></script>


<script>
function init() {
 window.addEventListener('scroll', function(e){
 var distanceY = window.pageYOffset || document.documentElement.scrollTop,
 shrinkOn = 150,
 header = document.querySelector("#header_new");
 if (distanceY > shrinkOn) {
 classie.add(header,"fixed");
 } else {
 if (classie.has(header,"fixed")) {
 classie.remove(header,"fixed");
 }
 }
 });
}
window.onload = init();
var numItems = $('.navads a').length;
var widthitem = 100/numItems;
$(".navads a").css("width","calc("+widthitem+"% - 4px)");
$( "#menudetik" ).click(function() {
 $(".newnav").addClass("show");
 $("#tutupmenu").show();
 $(this).hide();
 $("#header_new").addClass("stay");
});
$( "#tutupmenu" ).click(function() {
 $(".newnav").removeClass("show");
 $("#menudetik").show();
 $(this).hide();
 $("#header_new").removeClass("stay");
});
$( ".sb_close" ).click(function() {
 $(".smartbanner_new").remove();
});
var tinggi = $(window).height();
var nav_tinggi = tinggi - 140;
$(".con_newnav").height(nav_tinggi+"px");
( function( window ) {
'use strict';
function classReg( className ) {
 return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}
var hasClass, addClass, removeClass;
if ( 'classList' in document.documentElement ) {
 hasClass = function( elem, c ) {
 return elem.classList.contains( c );
 };
 addClass = function( elem, c ) {
 elem.classList.add( c );
 };
 removeClass = function( elem, c ) {
 elem.classList.remove( c );
 };
}
else {
 hasClass = function( elem, c ) {
 return classReg( c ).test( elem.className );
 };
 addClass = function( elem, c ) {
 if ( !hasClass( elem, c ) ) {
 elem.className = elem.className + ' ' + c;
 }
 };
 removeClass = function( elem, c ) {
 elem.className = elem.className.replace( classReg( c ), ' ' );
 };
}
function toggleClass( elem, c ) {
 var fn = hasClass( elem, c ) ? removeClass : addClass;
 fn( elem, c );
}
var classie = {
 hasClass: hasClass,
 addClass: addClass,
 removeClass: removeClass,
 toggleClass: toggleClass,
 has: hasClass,
 add: addClass,
 remove: removeClass,
 toggle: toggleClass
};
if ( typeof define === 'function' && define.amd ) {
 define( classie );
} else {
 window.classie = classie;
}
})( window );
</script>
<script type="application/javascript">
// Dropdown Menu
var dropdown = document.querySelectorAll('.dropdown');
var dropdownArray = Array.prototype.slice.call(dropdown,0);
dropdownArray.forEach(function(el){
	var button = el.querySelector('a[data-toggle="dropdown"]'),
			menu = el.querySelector('.dropdown-menu'),
			arrow = button.querySelector('i.icon-arrow');

	button.onclick = function(event) {
		if(!menu.hasClass('show')) {
			menu.classList.add('show');
			menu.classList.remove('hide');
			arrow.classList.add('open');
			arrow.classList.remove('close');
			event.preventDefault();
		}
		else {
			menu.classList.remove('show');
			menu.classList.add('hide');
			arrow.classList.remove('open');
			arrow.classList.add('close');
			event.preventDefault();
		}
	};
})

Element.prototype.hasClass = function(className) {
    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
};

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>hp/js/jquery.swipebox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>hp/js/custom.js"></script>
 <script src="https://humas.bengkaliskab.go.id/humasbaru/js/jquery.min.js"></script>
<script src="https://humas.bengkaliskab.go.id/humasbaru/js/bootstrap.min.js"></script>

 <script type="text/javascript">$(document).ready(function(){$('#quote-carousel').carousel({pause:true,interval:5000,});});</script>

<!--cached @ 1484485439--></div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102588173-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106317509-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-106317509-1');
</script>

</body></html>