<?php
/*

Copyright 2014 John Blackbourn

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

class QM_Util {

	protected static $file_components = array();
	protected static $file_dirs       = array();
	protected static $abspath         = null;

	private function __construct() {}

	public static function convert_hr_to_bytes( $size ) {

		# Annoyingly, wp_convert_hr_to_bytes() is defined in a file that's only
		# loaded in the admin area, so we'll use our own version.
		# See also http://core.trac.wordpress.org/ticket/17725

		$bytes = (float) $size;

		if ( $bytes ) {
			$last = strtolower( substr( $size, -1 ) );
			$pos = strpos( ' kmg', $last, 1);
			if ( $pos )
				$bytes *= pow( 1024, $pos );
			$bytes = round( $bytes );
		}

		return $bytes;

	}

	public static function standard_dir( $dir, $abspath_replace = null ) {

		$dir = str_replace( '\\', '/', $dir );
		$dir = str_replace( '//', '/', $dir );

		if ( is_string( $abspath_replace ) ) {
			if ( !self::$abspath ) {
				self::$abspath = self::standard_dir( ABSPATH );
			}
			$dir = str_replace( self::$abspath, $abspath_replace, $dir );
		}

		return $dir;

	}

	public static function get_file_dirs() {
		return self::$file_dirs;
	}

	public static function get_file_component( $file ) {

		# @TODO turn this into a class (eg QM_File_Component)

		if ( isset( self::$file_components[$file] ) )
			return self::$file_components[$file];

		if ( empty( self::$file_dirs ) ) {
			self::$file_dirs['plugin']     = self::standard_dir( WP_PLUGIN_DIR );
			self::$file_dirs['muplugin']   = self::standard_dir( WPMU_PLUGIN_DIR );
			self::$file_dirs['stylesheet'] = self::standard_dir( get_stylesheet_directory() );
			self::$file_dirs['template']   = self::standard_dir( get_template_directory() );
			self::$file_dirs['other']      = self::standard_dir( WP_CONTENT_DIR );
			self::$file_dirs['core']       = self::standard_dir( ABSPATH );
		}

		foreach ( self::$file_dirs as $type => $dir ) {
			if ( 0 === strpos( $file, $dir ) )
				break;
		}

		switch ( $type ) {
			case 'plugin':
			case 'muplugin':
				$plug = plugin_basename( $file );
				if ( strpos( $plug, '/' ) ) {
					$plug = explode( '/', $plug );
					$plug = reset( $plug );
				} else {
					$plug = basename( $plug );
				}
				$name = sprintf( __( 'Plugin: %s', 'query-monitor' ), $plug );
				break;
			case 'stylesheet':
				$name = __( 'Theme', 'query-monitor' );
				break;
			case 'template':
				$name = __( 'Parent Theme', 'query-monitor' );
				break;
			case 'other':
				$name = self::standard_dir( $file, '' );
				break;
			case 'core':
			default:
				$name = __( 'Core', 'query-monitor' );
				break;
		}

		return self::$file_components[$file] = (object) compact( 'type', 'name' );

	}

	public static function populate_callback( array $callback ) {

		$access = '->';

		if ( is_string( $callback['function'] ) and ( false !== strpos( $callback['function'], '::' ) ) ) {
			$callback['function'] = explode( '::', $callback['function'] );
			$access = '::';
		}

		try {

			if ( is_array( $callback['function'] ) ) {

				if ( is_object( $callback['function'][0] ) )
					$class = get_class( $callback['function'][0] );
				else
					$class = $callback['function'][0];

				$callback['name'] = $class . $access . $callback['function'][1] . '()';
				$ref = new ReflectionMethod( $class, $callback['function'][1] );

			} else if ( is_object( $callback['function'] ) and is_a( $callback['function'], 'Closure' ) ) {

				$ref  = new ReflectionFunction( $callback['function'] );
				$file = trim( QM_Util::standard_dir( $ref->getFileName(), '' ), '/' );
				$callback['name'] = sprintf( __( '{closure}() on line %1$d of %2$s', 'query-monitor' ), $ref->getEndLine(), $file );

			} else {

				$callback['name'] = $callback['function'] . '()';
				$ref = new ReflectionFunction( $callback['function'] );

			}

			$callback['file']      = $ref->getFileName();
			$callback['line']      = $ref->getStartLine();
			$callback['component'] = self::get_file_component( $ref->getFileName() );

		} catch ( ReflectionException $e ) {

			$callback['error'] = new WP_Error( 'reflection_exception', $e->getMessage() );

		}

		return $callback;

	}

	public static function is_ajax() {
		if ( defined( 'DOING_AJAX' ) and DOING_AJAX )
			return true;
		return false;
	}

	public static function is_async() {
		if ( self::is_ajax() )
			return true;
		if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) and 'xmlhttprequest' == strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) )
			return true;
		return false;
	}

	public static function get_admins() {
		if ( is_multisite() )
			return false;
		else
			return get_role( 'administrator' );
	}

	public static function get_current_url() {
		return ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

}
