<?php

namespace MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Student;

use MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Controller;
use MasterStudy\Lms\Pro\RestApi\Http\Serializers\Student\StudentSerializer;
use MasterStudy\Lms\Pro\RestApi\Repositories\DataTable\StudentRepository;
use WP_REST_Request;
use WP_REST_Response;

final class GetStudentsController extends Controller {
	public function __invoke( WP_REST_Request $request ): WP_REST_Response {
		$validation = $this->validate_datatable( $request );

		if ( $validation instanceof WP_REST_Response ) {
			return $validation;
		}

		$validated_data     = $this->get_validated_data();
		$student_repository = new StudentRepository(
			$this->get_date_from(),
			$this->get_date_to(),
			$validated_data['start'] ?? 0,
			$validated_data['length'] ?? 10,
			$validated_data['search']['value'] ?? null
		);

		$students = $student_repository->get_students_data(
			$validated_data['columns'],
			$validated_data['order']
		);

		$total = $student_repository->get_total();

		return new WP_REST_Response(
			array(
				'recordsTotal'    => $total,
				'recordsFiltered' => $total,
				'data'            => ( new StudentSerializer() )->collectionToArray( $students ),
			)
		);
	}
}