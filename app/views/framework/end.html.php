</div><!-- end #container -->
	<script type="text/javascript" href="/assets/js/idangerous.swiper.min.js"></script>
	<script type="text/javascript" href="/assets/js/jquery-1.11.1.js"></script>
	<script type="text/javascript" href="/assets/js/medium-editor.js"></script>
	<script type="text/javascript" href="/assets/js/common.js"></script>
	<script type="text/javascript" href="/assets/js/site.js"></script>
	<?php 
	if(isset($GLOBALS['js'])) { 
		render( 
		'<script type="text/javascript">$( document ).ready(function() {' 
		. $GLOBALS['js'] 
		. '});</script>'
		);
	}
	?>
</body>
</html>