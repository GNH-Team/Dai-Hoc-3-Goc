<?php

defined( 'ABSPATH' ) || exit;

function masterstudy_lms_course_player_register_assets() {
	wp_register_style( 'masterstudy-course-player-video-plyr', STM_LMS_URL . 'assets/css/course-player/content/lesson/plyr.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-fonts', STM_LMS_URL . 'assets/css/course-player/fonts.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-main', STM_LMS_URL . 'assets/css/course-player/main.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-header', STM_LMS_URL . 'assets/css/course-player/header.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-curriculum', STM_LMS_URL . 'assets/css/course-player/curriculum.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-discussions', STM_LMS_URL . 'assets/css/course-player/discussions.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-navigation', STM_LMS_URL . 'assets/css/course-player/navigation.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-lesson', STM_LMS_URL . 'assets/css/course-player/content/lesson/main.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-lesson-materials', STM_LMS_URL . 'assets/css/course-player/content/lesson/materials.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-lesson-video', STM_LMS_URL . 'assets/css/course-player/content/lesson/video.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-lesson-type-audio', STM_LMS_URL . 'assets/css/course-player/content/lesson/audio-type.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-quiz', STM_LMS_URL . 'assets/css/course-player/content/quiz.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-question', STM_LMS_URL . 'assets/css/course-player/content/questions.css', null, MS_LMS_VERSION );
	wp_register_style( 'masterstudy-course-player-locked', STM_LMS_URL . 'assets/css/course-player/locked.css', null, MS_LMS_VERSION );

	wp_register_script( 'plyr', STM_LMS_URL . '/assets/vendors/plyr/plyr.js', array(), MS_LMS_VERSION, false );
	wp_register_script( 'masterstudy-course-player-header', STM_LMS_URL . '/assets/js/course-player/header.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-navigation', STM_LMS_URL . '/assets/js/course-player/navigation.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-lesson', STM_LMS_URL . '/assets/js/course-player/content/lesson/lesson.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-lesson-materials', STM_LMS_URL . '/assets/js/course-player/content/lesson/lesson-materials.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-audio-lesson-type', STM_LMS_URL . '/assets/js/course-player/content/lesson/lesson-audio.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-curriculum', STM_LMS_URL . '/assets/js/course-player/curriculum.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-discussions', STM_LMS_URL . '/assets/js/course-player/discussions.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-lesson-video', STM_LMS_URL . '/assets/js/course-player/content/lesson/lesson-video.js', array( 'jquery', 'plyr' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-quiz-touch', STM_LMS_URL . '/assets/js/jquery.ui.touch-punch.min.js', array( 'jquery-ui-sortable' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-quiz', STM_LMS_URL . '/assets/js/course-player/content/quiz.js', array( 'jquery', 'jquery-ui-sortable' ), MS_LMS_VERSION, true );
	wp_register_script( 'masterstudy-course-player-question', STM_LMS_URL . '/assets/js/course-player/content/questions.js', array( 'jquery' ), MS_LMS_VERSION, true );
	wp_register_script( 'jspdf', STM_LMS_URL . '/assets/vendors/jspdf.umd.js', array(), MS_LMS_VERSION, false );
	wp_register_script( 'masterstudy-course-player-certificate', STM_LMS_URL . '/assets/js/course-player/generate-certificate.js', array( 'jspdf', 'masterstudy_certificate_fonts' ), MS_LMS_VERSION, false );
}
add_action( 'masterstudy_lms_course_player_register_assets', 'masterstudy_lms_course_player_register_assets' );