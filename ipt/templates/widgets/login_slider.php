<!-- Styles for my specific scrolling content -->
<style type="text/css">
  
  .iptLoginSlider_container {
  	padding:0;
  	width:806px;
  	margin:0 auto;
    height:241px;
    background-repeat:no-repeat;
  	background-image:url(css/images/fond_user.png);
  }

  

	#iptLoginSlider_scroll
	{
		width:700px;
		height: 230px;
    margin: 30px 0px 0px 50px;
	
	}
	
	/* Replace the last selector for the type of element you have in
	   your scroller. If you have div's use #makeMeScrollable div.scrollableArea div,
	   if you have links use #makeMeScrollable div.scrollableArea a and so on. */
	#iptLoginSlider_scroll div.scrollableArea img
	{
		position: relative;
		float: left;
		margin: 0px 0px 0px 10px;
		padding: 70px 0px 0px 0px;
    cursor:pointer;
		/* If you don't want the images in the scroller to be selectable, try the following
		   block of code. It's just a nice feature that prevent the images from
		   accidentally becoming selected/inverted when the user interacts with the scroller. */
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-o-user-select: none;
		user-select: none;
	}
</style>
	
        
<div class="iptLoginSlider_container">
   <div id="iptLoginSlider_scroll">
   <!--row-->
     
        <img src="<!--col-->{img_url}<!--/col-->" OnClick="window.location.href='<!--col-->{login_url}<!--/col-->'" title="<!--col-->{username}<!--/col-->" alt="<!--col-->{username}<!--/col-->"/>
     
     
    <!--/row-->
    </div>
</div>   	


<!-- Javascript -->

	<!-- jQuery library - Please load it from Google API's -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>

	<!-- jQuery UI Widget and Effects Core (custom download)
	     You can make your own at: http://jqueryui.com/download -->
	<script src="ipt/templates/widgets/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	
	<!-- Latest version (3.0.6) of jQuery Mouse Wheel by Brandon Aaron
	     You will find it here: http://brandonaaron.net/code/mousewheel/demos -->
	<script src="ipt/templates/widgets/js/jquery.mousewheel.min.js" type="text/javascript"></script>

	<!-- jQuery Kinectic (1.5) used for touch scrolling -->
	<script src="ipt/templates/widgets/js/jquery.kinetic.js" type="text/javascript"></script>

	<!-- Smooth Div Scroll 1.3 minified-->
	<script src="ipt/templates/widgets/js/jquery.smoothdivscroll-1.3-min.js" type="text/javascript"></script>

	<!-- If you want to look at the uncompressed version you find it at
	     js/jquery.smoothDivScroll-1.3.js -->

<!-- Plugin initialization -->
<script type="text/javascript">
	$(document).ready(function () {
		$("#iptLoginSlider_scroll").smoothDivScroll({
			hotSpotScrolling: false,
			touchScrolling: true,
			manualContinuousScrolling: true,
			mousewheelScrolling: false
		});
	});
</script>

<!--/Javascript-->
