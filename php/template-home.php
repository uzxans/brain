<?php
/**
 * Template Name: Главная страница
 * Template Post Type: page
 * 
 * Главная страница BRAIN - Система автоматизации бизнеса
 */

get_header(); 

// Получаем контент главной страницы из ACF или используем fallback
$hero_title = function_exists('get_field') ? get_field('hero_title') : 'Индивидуальная программа для вашего бизнеса';
$hero_subtitle = function_exists('get_field') ? get_field('hero_subtitle') : 'BRAIN — это комплексная система автоматизации и систематизации бизнес-процессов, настроенная индивидуально под ваш бизнес.';
$hero_price = function_exists('get_field') ? get_field('hero_price') : 'всего лишь 40 000 сум/мес';
$hero_image = function_exists('get_field') ? get_field('hero_image') : BRAIN_ASSETS_URI . '/img/dashbord.png';
?>

	<!-- ══════════════════════════════════════════════
	     HERO
	══════════════════════════════════════════════ -->
	<section class="hero-section d-flex align-items-center">
		<div class="container-fluid px-3 px-md-4">
			<div class="row align-items-center gy-4">

				<div class="col-lg-6 fade-in-up">
					<h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
					<p class="hero-subtitle">
						<?php echo wp_kses_post($hero_subtitle); ?>
					</p>
					<div class="d-flex flex-wrap align-items-center gap-3">
						<button class="btn btn-primary-outline-custom" data-bs-toggle="modal" data-bs-target="#contactModal">
							<?php esc_html_e('Попробовать бесплатно', 'brain'); ?> <i class="bi bi-arrow-right ms-2"></i>
						</button>
						<span class="price-tag">
							<i class="bi bi-arrow-down-right"></i>
							<?php echo esc_html($hero_price); ?>
						</span>
					</div>
				</div>

				<div class="col-lg-6 fade-in-up">
					<div class="hero-image animate-float">
						<?php 
							if (is_numeric($hero_image)) {
								echo wp_get_attachment_image($hero_image, 'large', false, array('class' => 'img-fluid rounded-4', 'alt' => esc_attr(get_the_title())));
							} else {
								?>
								<img src="<?php echo esc_url($hero_image); ?>" alt="<?php esc_attr_e('Превью дашборда BRAIN', 'brain'); ?>" class="img-fluid rounded-4">
								<?php
							}
						?>
					</div>
				</div>

			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     PARTNERS
	══════════════════════════════════════════════ -->
	<section class="partners-section" aria-label="<?php esc_attr_e('Клиенты и партнёры', 'brain'); ?>">
		<div class="container">
			<div class="swiper part-slider">
				<div class="swiper-wrapper mb-5">
					<?php 
						$partner_logos = function_exists('get_field') ? get_field('partner_logos') : array();
						if (!empty($partner_logos) && is_array($partner_logos)):
							foreach ($partner_logos as $logo):
								$logo_id = is_array($logo) ? ($logo['ID'] ?? $logo) : $logo;
					?>
								<div class="swiper-slide">
									<?php echo wp_get_attachment_image($logo_id, 'medium', false, array('class' => 'partner-logo')); ?>
								</div>
					<?php 
							endforeach;
						else:
							// Fallback - стандартные логотипы
							for ($i = 1; $i <= 8; $i++):
					?>
								<div class="swiper-slide">
									<img src="<?php echo esc_url(brain_get_image_url('client_logo/client_logo' . $i . '.png')); ?>" class="partner-logo" alt="<?php printf(esc_attr__('Логотип партнёра %d', 'brain'), $i); ?>">
								</div>
					<?php 
							endfor;
						endif; 
					?>
				</div>

				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     FEATURES GRID
	══════════════════════════════════════════════ -->
	<section class="features-section">
		<div class="container">
			<h2 class="section-title">
				<?php 
					$features_title = function_exists('get_field') ? get_field('features_title') : '6 причин почему вам стоит<br>выбрать BRAIN';
					echo wp_kses_post($features_title);
				?>
			</h2>
			<p class="section-subtitle">
				<?php 
					$features_subtitle = function_exists('get_field') ? get_field('features_subtitle') : 'BRAIN предоставляет все необходимые инструменты для управления вашим бизнесом в одном месте';
					echo wp_kses_post($features_subtitle);
				?>
			</p>

			<div class="features-grid">
				<?php 
					$features = function_exists('get_field') ? get_field('features_list') : array();
					if (!empty($features) && is_array($features)):
						foreach ($features as $index => $feature):
							$title = isset($feature['title']) ? $feature['title'] : '';
							$description = isset($feature['description']) ? $feature['description'] : '';
							$icon = isset($feature['icon']) ? $feature['icon'] : 'gear-fill';
				?>
							<div class="feature-card fade-in-up" style="animation-delay: <?php echo ($index * 0.1); ?>s;">
								<div class="feature-icon">
									<i class="bi bi-<?php echo esc_attr($icon); ?>"></i>
								</div>
								<h3 class="feature-title"><?php echo esc_html($title); ?></h3>
								<p class="feature-description"><?php echo wp_kses_post($description); ?></p>
							</div>
				<?php 
						endforeach;
					else:
						// Fallback
						$default_features = array(
							array('title' => 'Автоматизация процессов', 'icon' => 'gear-fill'),
							array('title' => 'Управление сотрудниками', 'icon' => 'people-fill'),
							array('title' => 'Аналитика и отчеты', 'icon' => 'graph-up'),
							array('title' => 'Интеграция с сервисами', 'icon' => 'puzzle-fill'),
							array('title' => 'Безопасность данных', 'icon' => 'shield-fill'),
							array('title' => 'Техническая поддержка', 'icon' => 'headset'),
						);
						foreach ($default_features as $index => $feature):
				?>
							<div class="feature-card fade-in-up" style="animation-delay: <?php echo ($index * 0.1); ?>s;">
								<div class="feature-icon">
									<i class="bi bi-<?php echo esc_attr($feature['icon']); ?>"></i>
								</div>
								<h3 class="feature-title"><?php echo esc_html($feature['title']); ?></h3>
								<p class="feature-description"><?php esc_html_e('Описание функции', 'brain'); ?></p>
							</div>
						<?php 
						endforeach;
					endif; 
				?>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     TESTIMONIALS
	══════════════════════════════════════════════ -->
	<section class="testimonials-section">
		<div class="container">
			<h2 class="section-title">
				<?php 
					$testimonials_title = function_exists('get_field') ? get_field('testimonials_title') : 'Что говорят о нас наши клиенты';
					echo wp_kses_post($testimonials_title);
				?>
			</h2>

			<div class="swiper testimonials-slider">
				<div class="swiper-wrapper">
					<?php 
						$testimonials = function_exists('get_field') ? get_field('testimonials_list') : array();
						if (!empty($testimonials) && is_array($testimonials)):
							foreach ($testimonials as $testimonial):
								$client_name = isset($testimonial['client_name']) ? $testimonial['client_name'] : '';
								$client_company = isset($testimonial['client_company']) ? $testimonial['client_company'] : '';
								$client_text = isset($testimonial['client_text']) ? $testimonial['client_text'] : '';
								$rating = isset($testimonial['rating']) ? $testimonial['rating'] : 5;
					?>
								<div class="swiper-slide">
									<div class="testimonial-card">
										<div class="testimonial-stars">
											<?php for ($i = 0; $i < $rating; $i++): ?>
												<i class="bi bi-star-fill"></i>
											<?php endfor; ?>
										</div>
										<p class="testimonial-text"><?php echo wp_kses_post($client_text); ?></p>
										<div class="testimonial-author">
											<p class="author-name"><?php echo esc_html($client_name); ?></p>
											<p class="author-company"><?php echo esc_html($client_company); ?></p>
										</div>
									</div>
								</div>
					<?php 
							endforeach;
						else:
							// Fallback
							for ($i = 1; $i <= 3; $i++):
					?>
								<div class="swiper-slide">
									<div class="testimonial-card">
										<div class="testimonial-stars">
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
										</div>
										<p class="testimonial-text"><?php printf(esc_html__('Отзыв от клиента %d - BRAIN помогла нам автоматизировать наш бизнес', 'brain'), $i); ?></p>
										<div class="testimonial-author">
											<p class="author-name"><?php printf(esc_html__('Клиент %d', 'brain'), $i); ?></p>
											<p class="author-company"><?php esc_html_e('Компания', 'brain'); ?></p>
										</div>
									</div>
								</div>
					<?php 
							endfor;
						endif; 
					?>
				</div>

				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     CTA SECTION
	══════════════════════════════════════════════ -->
	<section class="cta-section">
		<div class="container">
			<h2 class="cta-title">
				<?php 
					$cta_title = function_exists('get_field') ? get_field('cta_title') : 'Готовы начать?';
					echo wp_kses_post($cta_title);
				?>
			</h2>
			<p class="cta-subtitle">
				<?php 
					$cta_subtitle = function_exists('get_field') ? get_field('cta_subtitle') : 'Попробуйте BRAIN бесплатно прямо сейчас и увидьте, как мы можем помочь вашему бизнесу';
					echo wp_kses_post($cta_subtitle);
				?>
			</p>
			<button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#contactModal">
				<?php esc_html_e('Попробовать бесплатно', 'brain'); ?>
			</button>
		</div>
	</section>

<?php get_footer(); ?>
