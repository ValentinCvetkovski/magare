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

class QM_Output_Headers_PHP_Errors extends QM_Output_Headers {

	public function output() {

		if ( ! QM_Util::is_ajax() )
			return;

		$data = $this->collector->get_data();

		if ( empty( $data['errors'] ) )
			return;

		$count = 0;

		foreach ( $data['errors'] as $type => $errors ) {

			foreach ( $errors as $key => $error ) {

				$count++;

				# @TODO we should calculate the component during process() so we don't need to do it
				# separately in each output.
				$component = $error->trace->get_component();
				$output_error = array(
					'type'      => $error->type,
					'message'   => $error->message,
					'file'      => $error->file,
					'line'      => $error->line,
					'stack'     => $error->trace->get_stack(),
					'component' => $component->name,
				);

				header( sprintf( 'X-QM-Error-%d: %s',
					$count,
					json_encode( $output_error )
				) );

			}

		}

		header( sprintf( 'X-QM-Errors: %d',
			$count
		) );

	}

}

function register_qm_output_headers_php_errors( QM_Output $output = null, QM_Collector $collector ) {
	return new QM_Output_Headers_PHP_Errors( $collector );
}

add_filter( 'query_monitor_output_headers_php_errors', 'register_qm_output_headers_php_errors', 10, 2 );
