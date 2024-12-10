<?php

use MasterStudy\Lms\Routing\Router;

/** @var Router $router */

// Administrator routes
$router->group(
	array(
		'middleware' => array(
			\MasterStudy\Lms\Routing\Middleware\Authentication::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Middleware\Administrator::class,
		),
		'prefix'     => '/analytics',
	),
	function ( Router $router ) {
		$router->get(
			'/users',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\GetUsersController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\GetUsers::class,
		);
		$router->get(
			'/instructors',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Instructor\GetInstructorsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Instructor\GetInstructors::class,
		);

	}
);

// Administrator and Instructor routes
$router->group(
	array(
		'middleware' => array(
			\MasterStudy\Lms\Routing\Middleware\Authentication::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Middleware\Instructor::class,
		),
		'prefix'     => '/analytics',
	),
	function ( Router $router ) {
		$router->get(
			'/revenue',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Revenue\GetRevenueController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Revenue\GetRevenue::class,
		);
		$router->get(
			'/revenue/payouts',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Revenue\GetPayoutsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Revenue\GetPayouts::class,
		);
		$router->get(
			'/revenue/courses',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Revenue\GetCoursesController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Revenue\GetCourses::class,
		);
		$router->get(
			'/revenue/groups',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Revenue\GetGroupsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Revenue\GetGroups::class,
		);
		$router->get(
			'/revenue/bundles',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Revenue\GetBundlesController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Revenue\GetBundles::class,
		);
		$router->get(
			'/revenue/students',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Revenue\GetStudentsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Revenue\GetStudents::class,
		);
		$router->get(
			'/engagement',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Engagement\GetEngagementController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Engagement\GetEngagement::class,
		);
		$router->get(
			'/engagement/courses',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Engagement\GetCoursesController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Engagement\GetCourses::class,
		);
		$router->get(
			'/engagement/students',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Engagement\GetStudentsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Engagement\GetStudents::class,
		);
		$router->get(
			'/instructor/short-report',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Instructor\GetInstructorReportController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Instructor\GetInstructorReport::class,
		);
		$router->get(
			'/instructor/{instructor_id}/data',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Instructor\GetInstructorDataController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Instructor\GetInstructorData::class,
		);
		$router->get(
			'/instructor/{instructor_id}/courses',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Revenue\GetCoursesController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Revenue\GetCourses::class,
		);
		$router->get(
			'/students',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Student\GetStudentsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Student\GetStudents::class,
		);
		$router->get(
			'/course/{course_id}/data',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Course\GetCourseDataController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Course\GetCourseData::class,
		);
		$router->get(
			'/course/{course_id}/lessons',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Course\GetCourseLessonsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Course\GetCourseLessons::class,
		);
		$router->get(
			'/course/{course_id}/lessons-by-users',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Course\GetLessonsByUsersController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Course\GetLessonsByUsers::class,
		);
		$router->get(
			'/reviews-charts',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Review\GetReviewChartsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Review\GetReviewCharts::class,
		);
		$router->get(
			'/reviews-courses',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Review\GetCoursesController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Review\GetCourses::class,
		);
		$router->get(
			'/reviews-users',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Review\GetUsersController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Review\GetUsers::class,
		);
		$router->get(
			'/reviews-{status}',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Review\GetReviewsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Review\GetReviews::class,
		);
		$router->get(
			'/instructor-students',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Student\GetInstructorStudentsController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Student\GetStudents::class,
		);
		$router->get(
			'/student/{user_id}/data',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Student\GetStudentDataController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Student\GetStudentData::class,
		);
		$router->get(
			'/student/{user_id}/courses',
			\MasterStudy\Lms\Pro\RestApi\Http\Controllers\Analytics\Student\GetStudentCoursesController::class,
			\MasterStudy\Lms\Pro\RestApi\Routing\Swagger\Routes\Analytics\Student\GetStudentCourses::class,
		);
	}
);
