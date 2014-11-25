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

class QM_Collector_Theme extends QM_Collector {

	public $id = 'theme';

	public function name() {
		return __( 'Theme', 'query-monitor' );
	}

	public function __construct() {
		parent::__construct();
		add_filter( 'body_class', array( $this, 'filter_body_class' ), 99 );
	}

	public function filter_body_class( $class ) {
		$this->data['body_class'] = $class;
		return $class;
	}

	public function process() {

		global $template;

		$template_path        = QM_Util::standard_dir( $template );
		$stylesheet_directory = QM_Util::standard_dir( get_stylesheet_directory() );
		$template_directory   = QM_Util::standard_dir( get_template_directory() );

		$template_file = str_replace( array( $stylesheet_directory, $template_directory ), '', $template_path );
		$template_file = ltrim( $template_file, '/' );

		$this->data['template_path'] = $template_path;
		$this->data['template_file'] = $template_file;
		$this->data['stylesheet']    = get_stylesheet();
		$this->data['template']      = get_template();

		if ( isset( $this->data['body_class'] ) )
			asort( $this->data['body_class'] );

	}

}

function register_qm_collector_theme( array $qm ) {
	if ( !is_admin() )
		$qm['theme'] = new QM_Collector_Theme;
	return $qm;
}

add_filter( 'query_monitor_collectors', 'register_qm_collector_theme', 70 );
