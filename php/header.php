<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="dark">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php wp_head(); ?>

	<!-- Тема определяется ДО рендера страницы -->
	<script>
		(function () {
			const saved = localStorage.getItem('brainTheme');
			const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
			const theme = saved || (prefersDark ? 'dark' : 'light');
			document.documentElement.setAttribute('data-theme', theme);
		})();
	</script>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<!-- ══════════════════════════════════════════════
	     NAVBAR (fixed-top)
	══════════════════════════════════════════════ -->
	<div class="container-fluid fixed-top px-3 px-md-4">
		<nav class="navbar navbar-expand-lg" id="mainNavbar" aria-label="<?php esc_attr_e('Главная навигация', 'brain'); ?>">
			<div class="container-fluid mx-1 mx-md-3">

				<!-- Логотип -->
				<a class="navbar-brand text-white" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?> — <?php esc_attr_e('на главную', 'brain'); ?>">
					<?php echo brain_get_logo_html(); ?>
				</a>

				<!-- Гамбургер (мобилки) + переключатель темы -->
				<div class="d-flex align-items-center gap-2 d-lg-none">
					<!-- Переключатель темы (мобилка) -->
					<button class="theme-toggle" id="themeToggleMob" aria-label="<?php esc_attr_e('Переключить тему', 'brain'); ?>">
						<i class="bi bi-moon-stars-fill" id="themeIconMob"></i>
					</button>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
						aria-controls="navbarNav" aria-expanded="false" aria-label="<?php esc_attr_e('Открыть меню', 'brain'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>

				<!-- Коллапсируемое меню -->
				<div class="collapse navbar-collapse" id="navbarNav">
					<?php brain_primary_menu(); ?>

					<!-- Правая часть: язык, тема (десктоп), CTA, войти -->
					<div class="d-flex align-items-center gap-2 mt-3 mt-lg-0 flex-wrap flex-lg-nowrap">

						<!-- Выбор языка (Polylang) -->
						<?php if (function_exists('pll_the_languages')): ?>
							<div class="dropdown">
								<button class="btn btn-sm dropdown-toggle rounded-3 d-flex align-items-center gap-1 btnBrain"
									type="button" data-bs-toggle="dropdown" aria-label="<?php esc_attr_e('Выбрать язык', 'brain'); ?>" style="border:none;">
									<?php 
										if (function_exists('pll_current_language')) {
											$current_lang = pll_current_language('slug');
											echo strtoupper($current_lang);
										}
									?>
								</button>
								<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end rounded-3 bg_lang">
									<?php if (function_exists('pll_the_languages')): ?>
										<?php pll_the_languages(array('display_names_as' => 'slug')); ?>
									<?php endif; ?>
								</ul>
							</div>
						<?php endif; ?>

						<!-- Переключатель темы (только десктоп) -->
						<button class="theme-toggle d-none d-lg-flex" id="themeToggleDesk" aria-label="<?php esc_attr_e('Переключить тему', 'brain'); ?>">
							<i class="bi bi-moon-stars-fill" id="themeIconDesk"></i>
						</button>

						<!-- CTA Кнопка -->
						<button class="btn btn-primary-custom btn_pay">
							<?php esc_html_e('Попробовать бесплатно', 'brain'); ?>
						</button>
						
						<!-- Кнопка входа -->
						<button class="btn btn-outline-light btn-sm nav-link" onclick="window.location.href='<?php echo esc_url(wp_login_url()); ?>'">
							<?php esc_html_e('Войти', 'brain'); ?>
						</button>
					</div>
				</div>

			</div>
		</nav>
	</div><!-- /fixed-top -->
