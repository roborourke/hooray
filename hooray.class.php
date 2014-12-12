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
			case 'compact':
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
			case 'sort':
			case 'asort':
			case 'rsort':
			case 'ksort':
			case 'usort':
			case 'arsort':
			case 'krsort':
			case 'uasort':
			case 'uksort':
			case 'natsort':
			case 'natcasesort':
			case 'shuffle':
				$func = $name;
			case 'walk':
			case 'walk_recursive';
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
			case 'extract':
			case 'count':
			case 'sizeof':
			case 'end':
			case 'each':
			case 'current':
			case 'pos':
			case 'next':
			case 'prev':
			case 'key':
			case 'reset':
				$func = $name;
			case 'rand':
			case 'key_exists':
				return call_user_func_array($func, array_merge(array($this->__get('arg_0')), $args));
				break;
//			case 'list':
//				$array = $this->__get( 'arg_0' );
//				call_user_func_array( 'list', $args ) = $array;
//				break;
			case 'contains':
			case 'has':
			case 'in':
				$func = 'in_array';
			case 'search':
				if ( ! isset( $args[1] ) )
					$args[1] = false;
				return call_user_func_array( $func, array( $args[0], $this->__get( 'arg_0' ), $args[1] ) );
				break;
		}

		return $this;
	}

}