<!-- jQuery library (served from Google) -->
<script src="ipt/templates/widgets/js/jquery.min.1.8.2.js"></script>
<!-- bxSlider Javascript file -->
<script src="ipt/templates/widgets/js/jquery.bxslider.min.js"></script>
<style type="text/css">

<!-- bxSlider CSS file -->
/**
 * BxSlider v4.0 - Fully loaded, responsive content slider
 * http://bxslider.com
 *
 * Written by: Steven Wanderski, 2012
 * http://stevenwanderski.com
 * (while drinking Belgian ales and listening to jazz)
 *
 * CEO and founder of bxCreative, LTD
 * http://bxcreative.com
 */


/** RESET AND LAYOUT
===================================*/

.bx-wrapper {
	position: relative;
	margin: 0 auto 60px;
	padding: 0;
	*zoom: 1;
}

.bx-wrapper img {
	max-width: 100%;
	display: block;

}

/** THEME
===================================*/

.bx-wrapper .bx-viewport {
	-moz-box-shadow: 0 0 5px #ccc;
	-webkit-box-shadow: 0 0 5px #ccc;
	box-shadow: 0 0 5px #ccc;
	border: solid #fff 5px;
	left: -5px;
	background: #fff;

}

.bx-wrapper .bx-pager,
.bx-wrapper .bx-controls-auto {
	position: absolute;
	bottom: -30px;
	width: 100%;
}

/* LOADER */

.bx-wrapper .bx-loading {
	min-height: 50px;
	background: url(images/bx_loader.gif) center center no-repeat #fff;
	height: 100%;
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 2000;
}

/* PAGER */

.bx-wrapper .bx-pager {
	text-align: center;
	font-size: .85em;
	font-family: Arial;
	font-weight: bold;
	color: #666;
	padding-top: 20px;
}

.bx-wrapper .bx-pager .bx-pager-item,
.bx-wrapper .bx-controls-auto .bx-controls-auto-item {
	display: inline-block;
	*zoom: 1;
	*display: inline;
}

.bx-wrapper .bx-pager.bx-default-pager a {
	background: #666;
	text-indent: -9999px;
	display: block;
	width: 10px;
	height: 10px;
	margin: 0 5px;
	outline: 0;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {
	background: #000;
}

/* DIRECTION CONTROLS (NEXT / PREV) */

.bx-wrapper .bx-prev {
	left: 10px;
	background: url(images/controls.png) no-repeat 0 -32px;
}

.bx-wrapper .bx-next {
	right: 10px;
	background: url(images/controls.png) no-repeat -43px -32px;
}

.bx-wrapper .bx-prev:hover {
	background-position: 0 0;
}

.bx-wrapper .bx-next:hover {
	background-position: -43px 0;
}

.bx-wrapper .bx-controls-direction a {
	position: absolute;
	top: 50%;
	margin-top: 20px;
	margin-left: 100px;
	margin-right: 100px;
	outline: 0;
	width: 32px;
	height: 32px;
	text-indent: -9999px;
	z-index: 9999;
}

.bx-wrapper .bx-controls-direction a.disabled {
	display: none;
}

/* AUTO CONTROLS (START / STOP) */

.bx-wrapper .bx-controls-auto {
	text-align: center;
}

.bx-wrapper .bx-controls-auto .bx-start {
	display: block;
	text-indent: -9999px;
	width: 10px;
	height: 11px;
	outline: 0;
	background: url(images/controls.png) -86px -11px no-repeat;
	margin: 0 3px;
}

.bx-wrapper .bx-controls-auto .bx-start:hover,
.bx-wrapper .bx-controls-auto .bx-start.active {
	background-position: -86px 0;
}

.bx-wrapper .bx-controls-auto .bx-stop {
	display: block;
	text-indent: -9999px;
	width: 9px;
	height: 11px;
	outline: 0;
	background: url(images/controls.png) -86px -44px no-repeat;
	margin: 0 3px;
}

.bx-wrapper .bx-controls-auto .bx-stop:hover,
.bx-wrapper .bx-controls-auto .bx-stop.active {
	background-position: -86px -33px;
}

/* PAGER WITH AUTO-CONTROLS HYBRID LAYOUT */

.bx-wrapper .bx-controls.bx-has-controls-auto.bx-has-pager .bx-pager {
	text-align: left;
	width: 80%;
}

.bx-wrapper .bx-controls.bx-has-controls-auto.bx-has-pager .bx-controls-auto {
	right: 0;
	width: 35px;
}

/* IMAGE CAPTIONS */

.bx-wrapper .bx-caption {
	position: absolute;
	bottom: 0;
	left: 0;
	background: #666\9;
	background: rgba(80, 80, 80, 0.75);
	width: 100%;
}

.bx-wrapper .bx-caption span {
	color: #fff;
	font-family: Arial;
	display: block;
	font-size: 1em;
	padding-top: 10px;
	padding-bottom: 5px;
	padding-left:-10px;
	font-weight:bold;
	min-height:20px;
	text-align:center;
}



</style>
<div style="padding-left:120px;padding-right:120px;padding-top:20px;padding-bottom:20px;margin:50px;background-color:#303030">
          
  <div class="bx-wrapper">         
    <ul class="bxslider">
       <!--row-->
       <li><img src="<!--col-->{img_url}<!--/col-->" title="<!--col-->{tprenom}<!--/col--> <!--col-->{tnom}<!--/col-->" OnClick="window.location.href='<!--col-->{login_url}<!--/col-->'" style="padding-left:15px;cursor:pointer;"/></li>
       <!--/row-->
    </ul>
  </div>
</div>
        
        
<script>
$('.bxslider').bxSlider({
  minSlides: 3,
  maxSlides: 1000,
  slideWidth: 460,  
  
  adaptiveHeight: true,
  captions: true,
  touchEnabled: true,
  oneToOneTouch: true,
  slideMargin: 10
});
</script>