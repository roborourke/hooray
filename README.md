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

Here's the equivalent to the above example using Hooray:

```php
<?php

// constructor takes the array you want to work on
// if empty you can use push(), fill() etc.. methods
$a = new hooray( array( 0, 1, 2, 3, 3, 4, 4, 6, 5 ) );

$a
	->filter()
	->unique()
	->map( function( $val ) {
		return $val * 10;
	} );

// use the get() method to return the modified array
print_r( $a->get() );

?>
```

Methods that normally return something other than an array will continue to do so eg:

```php
<?php

$a = new hooray( array( 0, 1, 2, 3, 3, 4, 4, 6, 5 ) );

$a->count(); // 9

?>
```

You can continue to use the Hooray object after that if you need to do more with the array.

## Other potential goals

* maybe normalise argument order for similar methods - sort of done as you don't have to pass in the array more than once
* work out if the `__call()` + massive switch statement is really worth it as there's no way to add PHPDoc
* add additional nice methods like rotate, flatten, deep copy etc..
* unit tests
* perf tests


