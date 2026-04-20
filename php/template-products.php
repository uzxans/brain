<?php
/**
 * Template Name: Продукты
 * Template Post Type: page
 * 
 * Страница продуктов BRAIN
 */

get_header();

$hero_title = function_exists('get_field') ? get_field('products_hero_title') : 'Управляйте всем своим бизнесом на одной платформе';
$hero_subtitle = function_exists('get_field') ? get_field('products_hero_subtitle') : 'BRAIN — это ERP-система, объединяющая структуру ORG, бизнес-процессы, контроль сотрудников и мониторинг эффективности';
?>

	<!-- ══════════════════════════════════════════════
	     HERO SECTION
	══════════════════════════════════════════════ -->
	<section class="hero-section d-flex align-items-center line_bg_header">
		<div class="container-fluid px-3 px-md-4">
			<div class="d-flex justify-content-center gy-4 text-center text-lg-start flex-lg-row flex-column align-items-center">
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 text-lg-start">
					<h1 class="display-4 fw-bold mb-3 text-center">
						<?php echo wp_kses_post($hero_title); ?>
					</h1>
					<p class="lead mb-4 text-center">
						<?php echo wp_kses_post($hero_subtitle); ?>
					</p>
					<div class="gap-3 d-flex justify-content-center justify-content-lg-center">
						<button class="btn btn-primary-outline-custom btn-lg" data-bs-toggle="modal" data-bs-target="#contactModal">
							<?php esc_html_e('Попробовать бесплатно', 'brain'); ?> <i class="bi bi-arrow-right"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     КОМУ ПОДХОДИТ ПРОДУКТ
	══════════════════════════════════════════════ -->
	<section class="features-section mb-5">
		<div class="container">
			<h2 class="mb-4">
				<?php esc_html_e('Кому подходит наша продукта', 'brain'); ?>
			</h2>
			<p class="mb-5">
				<?php esc_html_e('Помимо продажи лицензий, для чего не требуется специального опыта, наши партнеры зарабатывают на оказании различных дополнительных услуг. Ваше предложение клиенту ограничено только вашей экспертизой.', 'brain'); ?>
			</p>

			<div class="flex_part">
				<?php 
					$product_use_cases = function_exists('get_field') ? get_field('product_use_cases') : array();
					if (!empty($product_use_cases) && is_array($product_use_cases)):
						foreach ($product_use_cases as $use_case):
							$use_case_title = isset($use_case['title']) ? $use_case['title'] : '';
							$use_case_image = isset($use_case['image']) ? $use_case['image'] : '';
							$use_case_features = isset($use_case['features']) ? $use_case['features'] : array();
				?>
							<div class="card">
								<?php if ($use_case_image): ?>
									<?php 
										if (is_numeric($use_case_image)) {
											echo wp_get_attachment_image($use_case_image, 'medium', false, array('class' => 'card-img-top'));
										} else {
											echo '<img src="' . esc_url($use_case_image) . '" class="card-img-top" alt="' . esc_attr($use_case_title) . '">';
										}
									?>
								<?php endif; ?>
								<div class="card-body">
									<h5 class="card-title"><?php echo esc_html($use_case_title); ?></h5>
									<?php if (!empty($use_case_features)): ?>
										<ol class="card-text">
											<?php foreach ($use_case_features as $feature): ?>
												<li><?php echo wp_kses_post($feature); ?></li>
											<?php endforeach; ?>
										</ol>
									<?php endif; ?>
								</div>
							</div>
				<?php 
						endforeach;
					else:
						// Fallback - стандартные use cases
						$default_use_cases = array(
							'Сеть рознечных магазинов' => array(
								'Готовые шаблоны должностей и должностных инструкций',
								'Настройка и управление локациями филиалов',
								'Автоматизация командировок между филиалами',
								'Готовый шаблон для контроля корпоративного автопарка',
								'Контроль посещаемости сотрудников по каждой локации'
							),
							'Производство' => array(
								'Настройка по процеса производство',
								'Контроль посещаемости сотрудников на производстве',
								'Готовый Telegram-бот для анкетирования',
								'Повышение эффективности работы сотрудников',
								'Контроль и установка лимитов по категориям расходов'
							),
							'Клиника' => array(
								'Готовые шаблоны ОРГ-структуры',
								'Контроль посещаемости сотрудников',
								'Инвентаризация оборудования',
								'Готовые шаблоны для заполнения пациентов',
								'Готовые должностные инструкции'
							),
							'Оптовая торговля' => array(
								'Настройка складов и локаций',
								'Учёт товаров по штрихкодам',
								'Диаграммы по остаткам товаров',
								'Управление документооборотом',
								'Управление логистикой'
							),
							'Сфера услуг' => array(
								'Регистрация каждого клиента и анализ клиентской базы',
								'Готовые шаблоны ОРГ-структуры',
								'Создание проектов и контроль их выполнения',
								'Хранение документов в единой системе',
								'Управление расписанием'
							),
							'Строительство' => array(
								'Контроль каждого объекта',
								'Создание расходных смет и контроль их исполнения',
								'Создание проектов и делегирование задач',
								'Учёт заработной платы сотрудников',
								'Управление ресурсами и материалами'
							)
						);
						foreach ($default_use_cases as $title => $features):
				?>
							<div class="card">
								<img src="<?php echo esc_url(brain_get_image_url('part-step-1.png')); ?>" class="card-img-top" alt="<?php echo esc_attr($title); ?>">
								<div class="card-body">
									<h5 class="card-title"><?php echo esc_html($title); ?></h5>
									<ol class="card-text">
										<?php foreach ($features as $feature): ?>
											<li><?php echo esc_html($feature); ?></li>
										<?php endforeach; ?>
									</ol>
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
	     ДОПОЛНИТЕЛЬНЫЕ ФУНКЦИИ (Gemini)
	══════════════════════════════════════════════ -->
	<section class="mb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="product-info">
						<p class="subtext">
							<?php esc_html_e('Можно добавить к тарифу, либо пользоваться отдельно', 'brain'); ?>
						</p>
						<h2 class="mb-5">
							<?php 
								$addon_title = function_exists('get_field') ? get_field('addon_title') : 'Gemini';
								echo wp_kses_post($addon_title);
							?>
						</h2>
						
						<ul class="features-list">
							<?php 
								$addon_features = function_exists('get_field') ? get_field('addon_features') : array();
								if (!empty($addon_features) && is_array($addon_features)):
									foreach ($addon_features as $feature):
										$feature_text = isset($feature['text']) ? $feature['text'] : '';
										if ($feature_text):
							?>
										<li>
											<span class="check-icon"></span>
											<?php echo wp_kses_post($feature_text); ?>
										</li>
							<?php 
										endif;
									endforeach;
								else:
									// Fallback
									$default_features = array(
										'Задавайте вопросы прямо внутри BRAIN',
										'Автоматическая генерация должностных инструкций с помощью AI',
										'Ускорьте работу с рутинными задачами и процессами',
										'Умный помощник для создания и настройки бизнес-процессов'
									);
									foreach ($default_features as $feature):
							?>
										<li>
											<span class="check-icon"></span>
											<?php echo esc_html($feature); ?>
										</li>
							<?php 
									endforeach;
								endif; 
							?>
						</ul>
					</div>
				</div>

				<div class="col-md-6">
					<div class="product-image">
						<?php 
							$addon_image = function_exists('get_field') ? get_field('addon_image') : '';
							if ($addon_image):
								if (is_numeric($addon_image)) {
									echo wp_get_attachment_image($addon_image, 'large', false, array('class' => 'img-fluid'));
								} else {
									echo '<img src="' . esc_url($addon_image) . '" class="img-fluid" alt="' . esc_attr__('Дополнительная функция', 'brain') . '">';
								}
							else:
								echo '<div class="placeholder-image bg-secondary d-flex align-items-center justify-content-center" style="height: 400px;">';
								echo esc_html_e('Изображение добавится из ACF', 'brain');
								echo '</div>';
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- ══════════════════════════════════════════════
	     CTA SECTION
	══════════════════════════════════════════════ -->
	<section class="cta-section">
		<div class="container">
			<h2 class="cta-title">
				<?php esc_html_e('Готовы начать?', 'brain'); ?>
			</h2>
			<p class="cta-subtitle">
				<?php esc_html_e('Попробуйте BRAIN бесплатно прямо сейчас', 'brain'); ?>
			</p>
			<button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#contactModal">
				<?php esc_html_e('Попробовать бесплатно', 'brain'); ?>
			</button>
		</div>
	</section>

<?php get_footer(); ?>
