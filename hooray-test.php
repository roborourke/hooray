<?php

include 'hooray.class.php';

$a = new hooray();

echo '<pre>';

$a
	->fill( 0, 20, 'hello world' )
	->walk( function( &$val, $key ) {
		if ( $key > 9 )
			$val = 'goodbye world';
	} )
	->map( function( $val ) {
		return $val . ': lalala';
	} );

$b = clone $a;

$b->unique()->filter();

var_dump( $a->get() );
var_dump( $b->get() );