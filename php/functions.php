<?php
/**
 * BRAIN Theme Functions and Definitions
 * Полная поддержка WordPress, ACF PRO, Contact Form 7, Polylang
 */

if (!defined('ABSPATH')) {
	exit;
}

define('BRAIN_THEME_VERSION', '1.0.0');
define('BRAIN_THEME_DIR', get_template_directory());
define('BRAIN_THEME_URI', get_template_directory_uri());
define('BRAIN_ASSETS_URI', BRAIN_THEME_URI . '/assets');

/**
 * =====================================================
 * 1. РЕГИСТРАЦИЯ МЕНЮ
 * =====================================================
 */
function brain_register_menus() {
	register_nav_menus(array(
		'primary_menu' => __('Главное меню (навбар)', 'brain'),
		'footer_menu'  => __('Меню в подвале', 'brain'),
	));
}
add_action('after_setup_theme', 'brain_register_menus');

/**
 * =====================================================
 * 2. ПОДКЛЮЧЕНИЕ СТИЛЕЙ И СКРИПТОВ
 * =====================================================
 */
function brain_enqueue_scripts() {
	
	// === CSS ПОДКЛЮЧЕНИЯ ===
	
	// Bootstrap 5
	wp_enqueue_style(
		'bootstrap-css',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
		array(),
		'5.3.2'
	);

	// Bootstrap Icons
	wp_enqueue_style(
		'bootstrap-icons',
		'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css',
		array(),
		'1.11.1'
	);

	// Google Fonts (Sora)
	wp_enqueue_style(
		'google-fonts-sora',
		'https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	// Swiper CSS
	wp_enqueue_style(
		'swiper-css',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
		array(),
		'11.0.0'
	);

	// Главный CSS файл темы
	wp_enqueue_style(
		'brain-main-css',
		BRAIN_ASSETS_URI . '/css/main.css',
		array('bootstrap-css', 'bootstrap-icons', 'google-fonts-sora', 'swiper-css'),
		BRAIN_THEME_VERSION
	);

	// === СКРИПТЫ ===
	
	// Swiper JS
	wp_enqueue_script(
		'swiper-js',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
		array(),
		'11.0.0',
		array('strategy' => 'defer')
	);

	// Bootstrap JS Bundle
	wp_enqueue_script(
		'bootstrap-js',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
		array(),
		'5.3.2',
		true
	);

	// Основной скрипт темы
	wp_enqueue_script(
		'brain-main-js',
		BRAIN_ASSETS_URI . '/js/main.js',
		array('swiper-js', 'bootstrap-js'),
		BRAIN_THEME_VERSION,
		true
	);

	// Передаём данные для скриптов
	wp_localize_script('brain-main-js', 'brainTheme', array(
		'themeURI'  => BRAIN_ASSETS_URI,
		'siteURL'   => site_url(),
		'adminURL'  => admin_url(),
		'rest_url'  => rest_url(),
		'nonce'     => wp_create_nonce('brain_nonce'),
	));
}
add_action('wp_enqueue_scripts', 'brain_enqueue_scripts');

/**
 * =====================================================
 * 3. БАЗОВАЯ ПОДДЕРЖКА ТЕМЫ
 * =====================================================
 */
function brain_theme_setup() {
	
	// Поддержка title-tag
	add_theme_support('title-tag');
	
	// Поддержка заголовка сайта (кастомный логотип)
	add_theme_support('custom-logo');

	// Поддержка миниатюр постов
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(150, 150, true);

	// Поддержка HTML5
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	));

	// Поддержка синдикации (RSS)
	add_theme_support('automatic-feed-links');

	// Поддержка WooCommerce (если используется)
	add_theme_support('woocommerce');

	// Загрузка текстовой области
	load_theme_textdomain('brain', BRAIN_THEME_DIR . '/languages');
}
add_action('after_setup_theme', 'brain_theme_setup');

/**
 * =====================================================
 * 4. ПОДДЕРЖКА ACF (Advanced Custom Fields)
 * =====================================================
 */
function brain_acf_init() {
	if (function_exists('acf_add_options_page')) {
		// Главная страница параметров
		acf_add_options_page(array(
			'page_title' => __('Параметры сайта BRAIN', 'brain'),
			'menu_title' => __('Параметры BRAIN', 'brain'),
			'menu_slug'  => 'brain-settings',
			'capability' => 'manage_options',
			'redirect'   => false,
			'icon_url'   => 'dashicons-cog',
			'position'   => 3,
		));

		// Подстраница с контактами
		acf_add_options_sub_page(array(
			'page_title' => __('Контакты и ссылки', 'brain'),
			'menu_title' => __('Контакты', 'brain'),
			'parent_slug' => 'brain-settings',
		));

		// Подстраница со ссылками на соцсети
		acf_add_options_sub_page(array(
			'page_title' => __('Социальные сети', 'brain'),
			'menu_title' => __('Соцсети', 'brain'),
			'parent_slug' => 'brain-settings',
		));
	}
}
add_action('acf/init', 'brain_acf_init');

/**
 * =====================================================
 * 5. ПОДДЕРЖКА POLYLANG (МНОГОЯЗЫЧНОСТЬ)
 * =====================================================
 */
function brain_polylang_init() {
	if (function_exists('pll_register_string')) {
		// Регистрируем строки для переводов
		pll_register_string('brain_main', 'BRAIN — Система автоматизации бизнеса', 'Главное описание');
		pll_register_string('brain_cta', 'Попробовать бесплатно', 'Call-to-action кнопка');
		pll_register_string('brain_login', 'Войти', 'Кнопка входа');
	}
}
add_action('init', 'brain_polylang_init', 5);

/**
 * =====================================================
 * 6. ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ
 * =====================================================
 */

/**
 * Функция для вывода логотипа
 */
function brain_get_logo_html() {
	if (has_custom_logo()) {
		return get_custom_logo();
	}
	return '<img src="' . BRAIN_ASSETS_URI . '/img/logo.svg" alt="' . esc_attr(get_bloginfo('name')) . '" width="100" height="32">';
}

/**
 * Функция для вывода URL изображения
 */
function brain_get_image_url($filename) {
	return BRAIN_ASSETS_URI . '/img/' . $filename;
}

/**
 * Функция для вывода главного меню
 */
function brain_primary_menu() {
	wp_nav_menu(array(
		'theme_location' => 'primary_menu',
		'menu_class'     => 'navbar-nav mx-auto gap-1',
		'container'      => 'div',
		'container_class' => 'collapse navbar-collapse',
		'container_id'   => 'navbarNav',
		'fallback_cb'    => 'brain_menu_fallback',
		'depth'          => 2,
	));
}

/**
 * Функция для вывода меню подвала
 */
function brain_footer_menu() {
	wp_nav_menu(array(
		'theme_location' => 'footer_menu',
		'menu_class'     => 'footer-nav',
		'container'      => false,
		'fallback_cb'    => false,
		'depth'          => 1,
	));
}

/**
 * Fallback меню (если не назначено)
 */
function brain_menu_fallback() {
	echo '<ul class="navbar-nav mx-auto gap-1"><li class="nav-item"><a class="nav-link" href="#">'.esc_html__('Добавьте меню в админке', 'brain').'</a></li></ul>';
}

/**
 * =====================================================
 * 7. РЕГИСТРАЦИЯ САЙДБАРА
 * =====================================================
 */
function brain_register_sidebars() {
	register_sidebar(array(
		'name'          => __('Основной сайдбар', 'brain'),
		'id'            => 'primary-sidebar',
		'description'   => __('Сайдбар для страниц и постов', 'brain'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'brain_register_sidebars');

/**
 * =====================================================
 * 8. ОЧИСТКА НЕНУЖНЫХ СТИЛЕЙ/СКРИПТОВ
 * =====================================================
 */
function brain_remove_default_styles() {
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'brain_remove_default_styles', 100);

/**
 * =====================================================
 * 9. КЛАССЫ ДЛЯ BODY ТЕГА
 * =====================================================
 */
function brain_body_classes($classes) {
	// Добавляем класс для Polylang языков
	if (function_exists('pll_current_language')) {
		$classes[] = 'lang-' . pll_current_language();
	}
	return $classes;
}
add_filter('body_class', 'brain_body_classes');

/**
 * =====================================================
 * 10. ИНИЦИАЛИЗАЦИЯ ВКЛЮЧЕНИЕ ФАЙЛОВ
 * =====================================================
 */

// Включаем вспомогательные файлы темы
if (file_exists(BRAIN_THEME_DIR . '/inc/template-tags.php')) {
	require BRAIN_THEME_DIR . '/inc/template-tags.php';
}

if (file_exists(BRAIN_THEME_DIR . '/inc/template-functions.php')) {
	require BRAIN_THEME_DIR . '/inc/template-functions.php';
}
