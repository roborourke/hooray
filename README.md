hooray
======

PHP array helper for reducing nestiness

This is a first pass and probably horrible for some reason I haven't thought of. Anyhoo...

You may or not have done something like this horrendously contrived example when
working with arrays in PHP:

```php
<?php

$a = array( 0, 1, 2, 3, 3, 4, 4, 6, 5 );

array_map( function( $val ) {
    return $val * 10;
}, array_unique( array_filter( $a ) ) );

print_r( $a );

?>
```

What I'm aiming to do with Hooray is make all the normal array functions chainable so
it's easier to separate them, and also to avoid repeating yourself to some extent.

**NOTE:** Currently this only implements `array_*` functions. Sorting etc... will come soon.

Here's the equivalent to the above example using Hooray:

```php
<?php

$a = new hooray( array( 0, 1, 2, 3, 3, 4, 4, 6, 5 ) );

$a
	->filter()
	->unique()
	->map( function( $val ) {
		return $val * 10;
	} );

print_r( $a->get() );

?>
```

## Other potential goals

* normalise argument order for similar methods
* work out if the `__call()` + massive switch statement is really worth it as there's no way to add PHPDoc
* add additional nice methods like rotate, flatten, deep copy etc..


