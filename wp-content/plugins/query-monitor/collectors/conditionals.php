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

class QM_Collector_Conditionals extends QM_Collector {

	public $id = 'conditionals';

	public function name() {
		return __( 'Conditionals', 'query-monitor' );
	}

	public function __construct() {
		parent::__construct();
	}

	public function process() {

		$conds = apply_filters( 'query_monitor_conditionals', array(
			'is_404', 'is_archive', 'is_admin', 'is_attachment', 'is_author', 'is_blog_admin', 'is_category', 'is_comments_popup', 'is_date',
			'is_day', 'is_feed', 'is_front_page', 'is_home', 'is_main_network', 'is_main_site', 'is_month', 'is_network_admin',
			'is_page', 'is_page_template', 'is_paged', 'is_post_type_archive', 'is_preview', 'is_robots', 'is_rtl', 'is_search', 'is_single',
			'is_singular', 'is_ssl', 'is_sticky', 'is_tag', 'is_tax', 'is_time', 'is_trackback', 'is_year'
		) );	

		$true = $false = $na = array();

		foreach ( $conds as $cond ) {
			if ( function_exists( $cond ) ) {

				if ( ( 'is_sticky' == $cond ) and !get_post( $id = null ) ) {
					# Special case for is_sticky to prevent PHP notices
					$false[] = $cond;
				} else if ( ( 'is_main_site' == $cond ) and !is_multisite() ) {
					# Special case for is_main_site to prevent it from being annoying on single site installs
					$na[] = $cond;
				} else {
					if ( call_user_func( $cond ) )
						$true[] = $cond;
					else
						$false[] = $cond;
				}

			} else {
				$na[] = $cond;
			}
		}
		$this->data['conds'] = compact( 'true', 'false', 'na' );

	}

}

function register_qm_collector_conditionals( array $qm ) {
	$qm['conditionals'] = new QM_Collector_Conditionals;
	return $qm;
}

add_filter( 'query_monitor_collectors', 'register_qm_collector_conditionals', 50 );
