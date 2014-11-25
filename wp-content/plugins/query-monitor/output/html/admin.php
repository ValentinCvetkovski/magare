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

class QM_Output_Html_Admin extends QM_Output_Html {

	public function __construct( QM_Collector $collector ) {
		parent::__construct( $collector );
		add_filter( 'query_monitor_menus', array( $this, 'admin_menu' ), 60 );
	}

	public function output() {

		$data = $this->collector->get_data();

		if ( empty( $data ) )
			return;

		echo '<div class="qm qm-half" id="' . $this->collector->id() . '">';
		echo '<table cellspacing="0">';
		echo '<thead>';
		echo '<tr>';
		echo '<th colspan="2">' . $this->collector->name() . '</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';

		echo '<tr>';
		echo '<td class="qm-ltr">get_current_screen()</td>';
		echo '<td class="qm-has-inner">';

		echo '<table class="qm-inner" cellspacing="0">';
		echo '<tbody>';
		foreach ( $data['current_screen'] as $key => $value ) {
			echo '<tr>';
			echo '<td>' . esc_html( $key ) . '</td>';
			echo '<td>' . esc_html( $value ) . '</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';

		echo '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td class="qm-ltr">$pagenow</td>';
		echo "<td>{$data['pagenow']}</td>";
		echo '</tr>';

		$screens = array(
			'edit'            => true,
			'edit-comments'   => true,
			'edit-tags'       => true,
			'link-manager'    => true,
			'plugins'         => true,
			'plugins-network' => true,
			'sites-network'   => true,
			'themes-network'  => true,
			'upload'          => true,
			'users'           => true,
			'users-network'   => true,
		);

		if ( !empty( $data['current_screen'] ) and isset( $screens[$data['current_screen']->base] ) ) {

			# And now, WordPress' legendary inconsistency comes into play:

			if ( !empty( $data['current_screen']->taxonomy ) )
				$col = $data['current_screen']->taxonomy;
			else if ( !empty( $data['current_screen']->post_type ) )
				$col = $data['current_screen']->post_type . '_posts';
			else
				$col = $data['current_screen']->base;

			if ( !empty( $data['current_screen']->post_type ) and empty( $data['current_screen']->taxonomy ) )
				$cols = $data['current_screen']->post_type . '_posts';
			else
				$cols = $data['current_screen']->id;

			if ( 'edit-comments' == $col )
				$col = 'comments';
			else if ( 'upload' == $col )
				$col = 'media';
			else if ( 'link-manager' == $col )
				$col = 'link';

			echo '<tr>';
			echo '<td rowspan="2">' . __( 'Column Filters', 'query-monitor' ) . '</td>';
			echo "<td colspan='2'>manage_<span class='qm-current'>{$cols}</span>_columns</td>";
			echo '</tr>';
			echo '<tr>';
			echo "<td colspan='2'>manage_<span class='qm-current'>{$data['current_screen']->id}</span>_sortable_columns</td>";
			echo '</tr>';

			echo '<tr>';
			echo '<td rowspan="1">' . __( 'Column Action', 'query-monitor' ) . '</td>';
			echo "<td colspan='2'>manage_<span class='qm-current'>{$col}</span>_custom_column</td>";
			echo '</tr>';

		}

		echo '</tbody>';
		echo '</table>';
		echo '</div>';

	}

	public function admin_menu( array $menu ) {

		$menu[] = $this->menu( array(
			'title' => __( 'Admin Screen', 'query-monitor' ),
		) );
		return $menu;

	}

}

function register_qm_output_html_admin( QM_Output $output = null, QM_Collector $collector ) {
	return new QM_Output_Html_Admin( $collector );
}

add_filter( 'query_monitor_output_html_admin', 'register_qm_output_html_admin', 10, 2 );
