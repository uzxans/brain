<?php
/**
 * Template Name: Партнёры / Партнёрская программа
 * Template Post Type: page
 * 
 * Страница партнёрской программы BRAIN
 */

get_header();

$hero_title = function_exists('get_field') ? get_field('partners_hero_title') : 'Партнерская программа Brain';
$hero_subtitle = function_exists('get_field') ? get_field('partners_hero_subtitle') : 'Получайте 50% комиссии с первого платежа при продаже лицензии.';
?>

	<!-- ══════════════════════════════════════════════
	     HERO SECTION
	══════════════════════════════════════════════ -->
	<section class="hero-section d-flex align-items-center line_bg_header">
		<div class="container-fluid px-3 px-md-4">
			<div class="d-flex justify-content-center gy-4 text-center text-lg-start flex-lg-row flex-column align-items-center">
				<div class="col-md-5 col-12 text-lg-start">
					<h1 class="display-4 fw-bold mb-3 text-center">
						<?php echo wp_kses_post($hero_title); ?>
					</h1>
					<p class="lead mb-4">
						<?php echo wp_kses_post($hero_subtitle); ?>
					</p>
					<div class="gap-3 d-flex justify-content-center justify-content-lg-center">
						<button class="btn btn-primary-outline-custom btn-lg" data-bs-toggle="modal" data-bs-target="#contactModal">
							<?php esc_html_e('Стать партнёром', 'brain'); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     ЧТО МЫ ПРЕДЛАГАЕМ
	══════════════════════════════════════════════ -->
	<section class="features-section">
		<div class="container">
			<h2 class="section-title text-center mb-5">
				<?php esc_html_e('Что мы предлагаем своим партнёрам', 'brain'); ?>
			</h2>

			<div class="row">
				<?php 
					$partner_offers = function_exists('get_field') ? get_field('partner_offers') : array();
					if (!empty($partner_offers) && is_array($partner_offers)):
						foreach ($partner_offers as $offer):
							$title = isset($offer['title']) ? $offer['title'] : '';
							$description = isset($offer['description']) ? $offer['description'] : '';
							$icon = isset($offer['icon']) ? $offer['icon'] : 'puzzle.svg';
				?>
							<div class="col-md-4">
								<div class="card_part">
									<img src="<?php echo esc_url(brain_get_image_url($icon)); ?>" alt="<?php echo esc_attr($title); ?>">
									<h5><?php echo esc_html($title); ?></h5>
									<p><?php echo wp_kses_post($description); ?></p>
								</div>
							</div>
				<?php 
						endforeach;
					else:
						// Fallback - стандартные предложения
						$default_offers = array(
							'Получайте 50% комиссии с первого платежа при продаже лицензии.',
							'Мы бесплатно обучим вас работе в программе BRAIN',
							'Проводим обучение на реальных бизнес-кейсах и показываем, как правильно внедрить BRAIN в компанию',
							'Каждый квартал — бесплатные тренинги, встречи и кофебрейки для партнёров',
							'Предложения по улучшению программы от наших партнёров получают приоритет в разработке',
							'За привлечение нового партнёра, который успешно проходит тест, вы получаете гонорар'
						);
						foreach ($default_offers as $offer):
				?>
							<div class="col-md-4">
								<div class="card_part">
									<img src="<?php echo esc_url(brain_get_image_url('puzzle.svg')); ?>" alt="">
									<p><?php echo esc_html($offer); ?></p>
								</div>
							</div>
				<?php 
						endforeach;
					endif; 
				?>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     BANNER CTA
	══════════════════════════════════════════════ -->
	<section class="features-section banner">
		<div class="container">
			<div class="text-center">
				<img class="mx-auto d-block mb-3 logoAnime" src="<?php echo esc_url(brain_get_image_url('logo.svg')); ?>" alt="BRAIN Logo">
				<h2 class="section-title text-center mb-3">
					<?php esc_html_e('Начните зарабатывать сейчас', 'brain'); ?>
				</h2>
				<button class="btn btn-primary-custom btn_pay" data-bs-toggle="modal" data-bs-target="#contactModal">
					<?php esc_html_e('Стать партнёром', 'brain'); ?> <i class="bi bi-arrow-right"></i>
				</button>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     КАК СТАТЬ ПАРТНЁРОМ
	══════════════════════════════════════════════ -->
	<section class="features-section">
		<div class="container">
			<h2 class="mb-5">
				<?php esc_html_e('Как можно стать партнёром', 'brain'); ?>
			</h2>

			<div class="flex_part">
				<?php 
					$partner_steps = function_exists('get_field') ? get_field('partner_steps') : array();
					if (!empty($partner_steps) && is_array($partner_steps)):
						foreach ($partner_steps as $step):
							$step_title = isset($step['title']) ? $step['title'] : '';
							$step_description = isset($step['description']) ? $step['description'] : '';
							$step_image = isset($step['image']) ? $step['image'] : '';
				?>
							<div class="card">
								<?php if ($step_image): ?>
									<?php 
										if (is_numeric($step_image)) {
											echo wp_get_attachment_image($step_image, 'medium', false, array('class' => 'card-img-top'));
										} else {
											echo '<img src="' . esc_url($step_image) . '" class="card-img-top" alt="' . esc_attr($step_title) . '">';
										}
									?>
								<?php endif; ?>
								<div class="card-body">
									<h5 class="card-title"><?php echo esc_html($step_title); ?></h5>
									<p class="card-text"><?php echo wp_kses_post($step_description); ?></p>
								</div>
							</div>
				<?php 
						endforeach;
					else:
						// Fallback - стандартные шаги
						for ($i = 1; $i <= 6; $i++):
				?>
							<div class="card">
								<img src="<?php echo esc_url(brain_get_image_url('step' . $i . '.png')); ?>" class="card-img-top" alt="<?php printf(esc_attr__('Шаг %d', 'brain'), $i); ?>">
								<div class="card-body">
									<h5 class="card-title">
										<?php printf(esc_html__('Шаг %d: Зарегистрируйтесь', 'brain'), $i); ?>
									</h5>
									<p class="card-text">
										<?php esc_html_e('Получите доступ к профессиональным тестам BRAIN', 'brain'); ?>
									</p>
								</div>
							</div>
				<?php 
						endfor;
					endif; 
				?>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     BOTTOM BANNER
	══════════════════════════════════════════════ -->
	<section class="features-section banner">
		<div class="container">
			<div class="text-center">
				<img class="mx-auto d-block mb-3 logoAnime" src="<?php echo esc_url(brain_get_image_url('logo.svg')); ?>" alt="BRAIN Logo">
				<h2 class="section-title text-center mb-3">
					<?php esc_html_e('Начните зарабатывать сейчас', 'brain'); ?>
				</h2>
				<button class="btn btn-primary-custom btn_pay" data-bs-toggle="modal" data-bs-target="#contactModal">
					<?php esc_html_e('Стать партнёром', 'brain'); ?> <i class="bi bi-arrow-right"></i>
				</button>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     ИНТЕГРАЦИИ
	══════════════════════════════════════════════ -->
	<section class="features-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="content-side">
						<span class="badge">
							<?php esc_html_e('Взаимодействие', 'brain'); ?>
						</span>
						<h2 class="title">
							<?php 
								$integrations_title = function_exists('get_field') ? get_field('integrations_title') : 'Интеграция с 30+ ведущими ERP и CRM системами';
								echo wp_kses_post($integrations_title);
							?>
						</h2>

						<div class="app-card">
							<img src="<?php echo esc_url(brain_get_image_url('logo.svg')); ?>" alt="BRAIN Logo" class="brand-logo">
							<p class="app-text">
								<?php esc_html_e('Мобильное приложение на IOS и Android', 'brain'); ?>
							</p>
							<div class="store-buttons">
								<a href="https://play.google.com" target="_blank" rel="noopener noreferrer">
									<img src="<?php echo esc_url(brain_get_image_url('google-play.png')); ?>" alt="Google Play">
								</a>
								<a href="https://apps.apple.com" target="_blank" rel="noopener noreferrer">
									<img src="<?php echo esc_url(brain_get_image_url('app-store.png')); ?>" alt="App Store">
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="grid-side">
						<div class="logo-grid">
							<?php 
								$integrations = function_exists('get_field') ? get_field('integrations_logos') : array();
								if (!empty($integrations) && is_array($integrations)):
									foreach ($integrations as $integration):
										$integration_id = is_array($integration) ? ($integration['ID'] ?? $integration) : $integration;
										$integration_name = is_array($integration) ? ($integration['name'] ?? '') : '';
										?>
										<div class="logo-item">
											<?php 
												if (is_numeric($integration_id)) {
													echo wp_get_attachment_image($integration_id, 'medium', false, array('alt' => esc_attr($integration_name)));
												}
											?>
										</div>
										<?php 
									endforeach;
								else:
									// Fallback логотипы
									$default_logos = array('hh-uz', 'linkedin', 'custom-logo', 'bot', 'telegram', 'whatsapp', 'paypal', 'stripe', 'Payme');
									foreach ($default_logos as $logo):
										?>
										<div class="logo-item">
											<img src="<?php echo esc_url(brain_get_image_url('logo-part/' . $logo . '.png')); ?>" alt="<?php echo esc_attr($logo); ?>">
										</div>
										<?php 
									endforeach;
								endif; 
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
