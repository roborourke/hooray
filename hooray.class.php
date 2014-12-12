<?php

class hooray {

	public $args;

	public function __construct() {
		$this->args = func_get_args();

		// init with empty array if none given
		if ( empty( $this->args ) )
			$this->args = array( array() );

		foreach( $this->args as $i => $array ) {
			$this->__set( "arg_{$i}", $array );
		}
	}

	public function __set( $name, $value ) {
		$this->$name = $value;
	}

	public function __get( $name ) {
		return $this->$name;
	}

	public function get( $arg = 0 ) {
		return $this->__get( "arg_{$arg}" );
	}

	public function __call( $name, $args ) {

		$func = "array_{$name}";

		// array_ prefix
		switch( $name ) {
			// no array param
			case 'fill':
			case 'fill_keys':
			case 'range':
				$this->__set('arg_0', call_user_func_array($func, $args));
				break;

			// single param
			case 'count_values':
			case 'pop':
			case 'sum':
			case 'flip':
			case 'shift':
			case 'values':
			case 'product':
				$this->__set('arg_0', call_user_func($func, $this->__get('arg_0')));
				break;

			// multiple params
			case 'change_key_case':
			case 'chunk':
			case 'column':
			case 'pad':
			case 'keys':
			case 'push':
			case 'splice':
			case 'slice':
			case 'udiff':
			case 'filter':
			case 'reduce':
			case 'unique':
			case 'reverse':
			case 'unshift':
			case 'multisort':
				$this->__set('arg_0', call_user_func_array($func, array_merge(array($this->__get('arg_0')), $args)));
				break;

			// modifiers
			case 'walk':
			case 'walk_recursive':
				$array = $this->__get( 'arg_0' );
				call_user_func_array( $func, array_merge( array( &$array ), $args ) );
				$this->__set( 'arg_0', $array );
				break;

			// callback first param
			case 'map':
				$callback = array_shift($args);
				$this->__set('arg_0', call_user_func_array($func, array_merge(array($callback), array($this->__get('arg_0')), $args)));
				break;

			// infinite arrays
			case 'diff_assoc':
			case 'diff_uassoc':
			case 'udiff_assoc':
			case 'udiff_uassoc':
			case 'diff_key':
			case 'diff_ukey':
			case 'merge':
			case 'merge_recursive':
			case 'replace':
			case 'replace_recursive':
			case 'intersect':
			case 'uintersect':
			case 'intersect_key':
			case 'intersect_ukey':
			case 'intersect_assoc':
			case 'intersect_uassoc':
				$this->__set('arg_0', call_user_func_array($func, array_merge(array($this->__get('arg_0')), $args)));
				break;

		}

		// non array returning function
		switch( $name ) {
			case 'rand':
			case 'key_exists':
				$this->__set('arg_0', call_user_func_array($func, array_merge(array($this->__get('arg_0')), $args)));
				return $this->__get( 'arg_0' );
				break;
			case 'search':
				if ( ! isset( $args[1] ) )
					$args[1] = false;
				return call_user_func_array( $func, array( $args[0], $this->__get( 'arg_0' ), $args[1] ) );
				break;
		}

		return $this;
	}

	//array_diff_uassoc — Computes the difference of arrays with additional index check which is performed by a user supplied callback function
	//array_diff_ukey — Computes the difference of arrays using a callback function on the keys for comparison
	//array_diff — Computes the difference of arrays
	//array_fill_keys — Fill an array with values, specifying keys
	//array_fill — Fill an array with values
	//array_filter — Filters elements of an array using a callback function
	//array_flip — Exchanges all keys with their associated values in an array
	//array_intersect_assoc — Computes the intersection of arrays with additional index check
	//array_intersect_key — Computes the intersection of arrays using keys for comparison
	//array_intersect_uassoc — Computes the intersection of arrays with additional index check, compares indexes by a callback function
	//array_intersect_ukey — Computes the intersection of arrays using a callback function on the keys for comparison
	//array_intersect — Computes the intersection of arrays
	//array_key_exists — Checks if the given key or index exists in the array
	//array_keys — Return all the keys or a subset of the keys of an array
	//array_map — Applies the callback to the elements of the given arrays
	//array_merge_recursive — Merge two or more arrays recursively
	//array_merge — Merge one or more arrays
	//array_multisort — Sort multiple or multi-dimensional arrays
	//array_pad — Pad array to the specified length with a value
	//array_pop — Pop the element off the end of array
	//array_product — Calculate the product of values in an array
	//array_push — Push one or more elements onto the end of array
	//array_rand — Pick one or more random entries out of an array
	//array_reduce — Iteratively reduce the array to a single value using a callback function
	//array_replace_recursive — Replaces elements from passed arrays into the first array recursively
	//array_replace — Replaces elements from passed arrays into the first array
	//array_reverse — Return an array with elements in reverse order
	//array_search — Searches the array for a given value and returns the corresponding key if successful
	//array_shift — Shift an element off the beginning of array
	//array_slice — Extract a slice of the array
	//array_splice — Remove a portion of the array and replace it with something else
	//array_sum — Calculate the sum of values in an array
	//array_udiff_assoc — Computes the difference of arrays with additional index check, compares data by a callback function
	//array_udiff_uassoc — Computes the difference of arrays with additional index check, compares data and indexes by a callback function
	//array_udiff — Computes the difference of arrays by using a callback function for data comparison
	//array_uintersect_assoc — Computes the intersection of arrays with additional index check, compares data by a callback function
	//array_uintersect_uassoc — Computes the intersection of arrays with additional index check, compares data and indexes by a callback functions
	//array_uintersect — Computes the intersection of arrays, compares data by a callback function
	//array_unique — Removes duplicate values from an array
	//array_unshift — Prepend one or more elements to the beginning of an array
	//array_values — Return all the values of an array
	//array_walk_recursive — Apply a user function recursively to every member of an array
	//array_walk — Apply a user supplied function to every member of an array
	//array — Create an array
	//arsort — Sort an array in reverse order and maintain index association
	//asort — Sort an array and maintain index association
	//compact — Create array containing variables and their values
	//count — Count all elements in an array, or something in an object
	//current — Return the current element in an array
	//each — Return the current key and value pair from an array and advance the array cursor
	//end — Set the internal pointer of an array to its last element
	//extract — Import variables into the current symbol table from an array
	//in_array — Checks if a value exists in an array
	//key_exists — Alias of array_key_exists
	//key — Fetch a key from an array
	//krsort — Sort an array by key in reverse order
	//ksort — Sort an array by key
	//list — Assign variables as if they were an array
	//natcasesort — Sort an array using a case insensitive "natural order" algorithm
	//natsort — Sort an array using a "natural order" algorithm
	//next — Advance the internal array pointer of an array
	//pos — Alias of current
	//prev — Rewind the internal array pointer
	//range — Create an array containing a range of elements
	//reset — Set the internal pointer of an array to its first element
	//rsort — Sort an array in reverse order
	//shuffle — Shuffle an array
	//sizeof — Alias of count
	//sort — Sort an array
	//uasort — Sort an array with a user-defined comparison function and maintain index association
	//uksort — Sort an array by keys using a user-defined comparison function
	//usort — Sort an array by values using a user-defined comparison function

}