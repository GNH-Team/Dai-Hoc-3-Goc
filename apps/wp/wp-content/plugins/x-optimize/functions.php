<?php

/**
 * Plugin Name: X Optimize
 * Plugin URI:  http://x.com
 * Description: Plugin sử dụng để tối ưu + bảo mật lại các chức năng trong wordpress. LƯU Ý: KHÔNG XOÁ HOẶC DISABLE PLUGIN NÀY
 * Version:     1.0
 * Author:      xuantm
 * Author URI:  http://x.com
 * License:     GPL2
 */

// Đảm bảo không bị truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit nếu truy cập trực tiếp
}

// Hàm xử lý shortcode với tham số
function gen_form_unique_id($atts) {
    // Thiết lập giá trị mặc định cho các tham số
    $atts = shortcode_atts(
        array(
            'id' => 'default',
        ),
        $atts,
        'gen_form_unique_id'
    );

    return time();
}

// Đăng ký shortcode với WordPress
add_shortcode('gen-form-id', 'gen_form_unique_id');

function send_custom_webhook( $record, $handler ) {

	$form_name = $record->get_form_settings( 'form_name' );

	$raw_fields = $record->get( 'fields' );
	$fields = [];
	foreach ( $raw_fields as $id => $field ) {
		$fields[ $id ] = $field['value'];
	}

    echo print_r($fields);
    die;

}
// add_action( 'elementor_pro/forms/new_record', 'send_custom_webhook', 10, 2 );

add_action('init', 'add_custom_on_init');
function add_custom_on_init()
{
    // hook để custom lại header của course
    add_filter('masterstudy_course_page_header', 'x_masterstudy_course_page_header', 99, 1);
    add_filter('stm_lms_account/private/instructor_parts/rating', 'x_stm_lms_account_custom', 99, 0);
    add_filter('stm_lms_account/private/parts/enterprise_form', 'custom_enterprise_form', 99, 0);
    add_filter('stm_lms_courses/archive', 'stm_lms_courses_archive', 99, 1);
    add_filter('stm_lms_bundle/parts/panel_info', 'stm_lms_bundle_parts_panel_info', 99, 1);
    add_filter('stm_lms_bundle/parts/dynamic_sidebar', 'stm_lms_bundle_parts_dynamic_sidebar', 99, 1);

    // Thêm hành động để gắn mã vào hook wp_enqueue_scripts
    add_action('wp_enqueue_scripts', 'my_custom_script');
    add_filter('get_post_metadata', 'custom_course_review_meta', 10, 4);
}

// ẩn phần dynamic sidebar ở sidebar của trang chi tiết combo khoá học
 // xem tại: masterstudy-lms-learning-management-system-pro/stm-lms-templates/bundle/sidebar.php:14
function stm_lms_bundle_parts_dynamic_sidebar(){
    return null;
}

// ẩn phần thông tin về giảng viên, rating, category ở trang chi tiết combo khoá học
 // xem tại: masterstudy-lms-learning-management-system-pro/stm-lms-templates/bundle/single.php:15
function stm_lms_bundle_parts_panel_info(){
    return null;
}

// ẩn phần list course theo category ở page xem khoá học theo danh mục (return null để ẩn)
// sử dụng widget có sẵn trên elementor để hiển thị danh sách khoá học theo danh mục, không cần sử dụng giao diện từ file courses/archive nên ẩn phần đó đi để không trùng lặp
 // xem tại: masterstudy-lms-learning-management-system/_core/lms/classes/templates.php:51
function stm_lms_courses_archive($courses){
    return null;
    // return $courses;
}

// trả về null để ẩn rating trên widget list khoá học trên page wishlist: /wishlist
// rating hiển thị trong file: plugins/masterstudy-lms-learning-management-system/_core/stm-lms-templates/courses/parts/rating.php
// dữ liệu lấy từ post_meta ở dòng 7 : $rating = get_post_meta($id, 'course_marks', true);
function custom_course_review_meta($data, $object_id, $meta_key, $single)
{
    if (!is_admin()) {
        if ($meta_key === 'course_marks') {
            return false; // Trả về false (null vẫn hiển thị rating, false thì ok) để WordPress không lấy dữ liệu từ database
        }
    }

    return $data; // Trả về data để WordPress tiếp tục xử lý bình thường
}

// ẩn phần gửi yêu cầu thắc mắc trong phần cài đặt hồ sơ của học viên —> cái này sẽ dùng hệ thống riêng
// xem tại: masterstudy-lms-learning-management-system/_core/stm-lms-templates/account/private/parts/info.php:18
function custom_enterprise_form()
{
    return "";
}

// return "" để ẩn rating trên trang instructor ở link /account
function x_stm_lms_account_custom()
{
    return "";
}

function x_masterstudy_course_page_header($course_data)
{
    // Kiểm tra nếu đây là trang front-end
    if (!is_admin()) {
        try {
            // set rate = emtpty để ẩn rating trên trang chi tiết khoá học. 
            // Xem hook masterstudy_course_page_header được sử dụng tại đây: ../masterstudy-lms-learning-management-system-pro/stm-lms-templates/course/full-width.php
            $course_data['course']->rate = [];
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $course_data;
    }
}

// add custom script + style
function my_custom_script()
{
    // Kiểm tra nếu đây là trang front-end
    if (!is_admin()) {
        // Đăng ký script của bạn với WordPress
        // wp_register_script('my-custom-script', getPluginAssetsUrl() . '/main.js', [], "1.1", true);
        // // Đưa script đã đăng ký vào hàng đợi để tải
        // wp_enqueue_script('my-custom-script');

        // Đăng ký và thêm custom CSS vào header
        wp_enqueue_style('my-custom-style', getPluginAssetsUrl() . '/style.css', [], '1.4');
    }
}


function getPluginAssetsUrl()
{
    return plugins_url("/assets", __FILE__);
}
