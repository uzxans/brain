<?php
/**
 * Template Name: Тарифы и Цены
 * Template Post Type: page
 * 
 * Страница тарифов и цен BRAIN
 */

get_header();
?>

	<!-- ══════════════════════════════════════════════
	     PRICING SECTION
	══════════════════════════════════════════════ -->
	<section class="pricing-section">
		<div class="container-fluid px-3 px-md-4">
			<!-- Заголовок и переключатель -->
			<div class="pricing-header pt-5">
				<h2 class="section-title pt-3">
					<?php esc_html_e('Тарифы и цены', 'brain'); ?>
				</h2>

				<div class="toggle-wrapper">
					<span class="save-badge d-none d-md-inline">
						<?php esc_html_e('Сэкономьте 15% на годовом плане!', 'brain'); ?>
					</span>

					<div class="pricing-toggle">
						<button class="active" data-period="yearly">
							<?php esc_html_e('Ежегодно', 'brain'); ?>
						</button>
						<button data-period="monthly">
							<?php esc_html_e('Ежемесячно', 'brain'); ?>
						</button>
					</div>

					<div class="gift-badge">
						<i class="bi bi-gift-fill"></i>
						<span class="gift-text">
							<span class="highlight">
								<?php esc_html_e('2 месяца', 'brain'); ?>
							</span>
							<span>
								<?php esc_html_e('даром', 'brain'); ?>
							</span>
						</span>
					</div>
				</div>
			</div>

			<!-- Карточки тарифов -->
			<div class="row g-4">
				<?php 
					$pricing_plans = function_exists('get_field') ? get_field('pricing_plans') : array();
					
					if (!empty($pricing_plans) && is_array($pricing_plans)):
						foreach ($pricing_plans as $plan):
							$plan_name = isset($plan['name']) ? $plan['name'] : '';
							$plan_users = isset($plan['users']) ? $plan['users'] : '';
							$plan_yearly_price = isset($plan['yearly_price']) ? $plan['yearly_price'] : '';
							$plan_monthly_price = isset($plan['monthly_price']) ? $plan['monthly_price'] : '';
							$plan_features = isset($plan['features']) ? $plan['features'] : array();
							$is_popular = isset($plan['is_popular']) ? $plan['is_popular'] : false;
				?>
							<div class="col-12 col-sm-6 col-lg-4 col-xl">
								<div class="pricing-card <?php echo $is_popular ? 'popular' : ''; ?>">
									<?php if ($is_popular): ?>
										<div class="popular-badge">
											<?php esc_html_e('Популярно', 'brain'); ?>
										</div>
									<?php endif; ?>

									<div class="card-title"><?php echo esc_html($plan_name); ?></div>
									<div class="card-users"><?php echo esc_html($plan_users); ?></div>
									<div class="card-label">
										<?php esc_html_e('Пользователь', 'brain'); ?>
									</div>

									<div class="card-price">
										<div class="price-yearly">
											<span class="price-value"><?php echo esc_html($plan_yearly_price); ?></span>
											<span class="price-period">/месяц</span>
										</div>
										<div class="price-monthly price-hidden">
											<span class="price-value"><?php echo esc_html($plan_monthly_price); ?></span>
											<span class="price-period">/месяц</span>
										</div>
									</div>

									<button class="btn btn-primary-custom w-100" data-bs-toggle="modal" data-bs-target="#contactModal">
										<?php esc_html_e('Начать бесплатно', 'brain'); ?>
									</button>

									<?php if (!empty($plan_features)): ?>
										<div class="features-list">
											<?php foreach ($plan_features as $feature): ?>
												<div class="feature-item">
													<i class="bi bi-check-circle-fill"></i>
													<span><?php echo esc_html($feature); ?></span>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
				<?php 
						endforeach;
					else:
						// Fallback - стандартные тарифы
						$default_plans = array(
							array(
								'name' => 'Старт',
								'users' => '10-50',
								'yearly' => '50 000сум',
								'monthly' => '58 800сум'
							),
							array(
								'name' => 'Профессиональный',
								'users' => '50-500',
								'yearly' => '75 000сум',
								'monthly' => '88 000сум',
								'popular' => true
							),
							array(
								'name' => 'Корпоративный',
								'users' => '500+',
								'yearly' => 'Индивидуально',
								'monthly' => 'Индивидуально'
							)
						);

						foreach ($default_plans as $plan):
							$is_popular = isset($plan['popular']) && $plan['popular'];
				?>
							<div class="col-12 col-sm-6 col-lg-4 col-xl">
								<div class="pricing-card <?php echo $is_popular ? 'popular' : ''; ?>">
									<?php if ($is_popular): ?>
										<div class="popular-badge">
											<?php esc_html_e('Популярно', 'brain'); ?>
										</div>
									<?php endif; ?>

									<div class="card-title"><?php echo esc_html($plan['name']); ?></div>
									<div class="card-users"><?php echo esc_html($plan['users']); ?></div>
									<div class="card-label">
										<?php esc_html_e('Пользователь', 'brain'); ?>
									</div>

									<div class="card-price">
										<div class="price-yearly">
											<span class="price-value"><?php echo esc_html($plan['yearly']); ?></span>
											<span class="price-period">/месяц</span>
										</div>
										<div class="price-monthly price-hidden">
											<span class="price-value"><?php echo esc_html($plan['monthly']); ?></span>
											<span class="price-period">/месяц</span>
										</div>
									</div>

									<button class="btn btn-primary-custom w-100" data-bs-toggle="modal" data-bs-target="#contactModal">
										<?php esc_html_e('Начать бесплатно', 'brain'); ?>
									</button>

									<div class="features-list">
										<div class="feature-item">
											<i class="bi bi-check-circle-fill"></i>
											<span><?php esc_html_e('Все основные функции', 'brain'); ?></span>
										</div>
										<div class="feature-item">
											<i class="bi bi-check-circle-fill"></i>
											<span><?php esc_html_e('Поддержка 24/7', 'brain'); ?></span>
										</div>
										<div class="feature-item">
											<i class="bi bi-check-circle-fill"></i>
											<span><?php esc_html_e('Обновления включены', 'brain'); ?></span>
										</div>
									</div>
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
	     FAQ SECTION (опционально)
	══════════════════════════════════════════════ -->
	<?php 
		$show_faq = function_exists('get_field') ? get_field('show_pricing_faq') : false;
		$faq_items = function_exists('get_field') ? get_field('pricing_faq_items') : array();
		
		if ($show_faq || !empty($faq_items)):
	?>
		<section class="features-section">
			<div class="container">
				<h2 class="section-title text-center mb-5">
					<?php esc_html_e('Часто задаваемые вопросы', 'brain'); ?>
				</h2>

				<div class="accordion" id="pricingFAQ">
					<?php 
						if (!empty($faq_items)):
							foreach ($faq_items as $index => $item):
								$question = isset($item['question']) ? $item['question'] : '';
								$answer = isset($item['answer']) ? $item['answer'] : '';
								$item_id = 'faq-' . $index;
					?>
								<div class="accordion-item">
									<h2 class="accordion-header">
										<button class="accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($item_id); ?>" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($item_id); ?>">
											<?php echo esc_html($question); ?>
										</button>
									</h2>
									<div id="<?php echo esc_attr($item_id); ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" data-bs-parent="#pricingFAQ">
										<div class="accordion-body">
											<?php echo wp_kses_post($answer); ?>
										</div>
									</div>
								</div>
					<?php 
							endforeach;
						endif; 
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>


	<!-- ══════════════════════════════════════════════
	     JAVASCRIPT ДЛЯ ПЕРЕКЛЮЧЕНИЯ ЦЕН
	══════════════════════════════════════════════ -->
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const toggleButtons = document.querySelectorAll('.pricing-toggle button');
			const priceContainers = document.querySelectorAll('.card-price');

			toggleButtons.forEach(button => {
				button.addEventListener('click', function() {
					const period = this.getAttribute('data-period');
					
					// Обновляем активную кнопку
					toggleButtons.forEach(btn => btn.classList.remove('active'));
					this.classList.add('active');

					// Переключаем отображение цен
					priceContainers.forEach(container => {
						const yearlyPrice = container.querySelector('.price-yearly');
						const monthlyPrice = container.querySelector('.price-monthly');

						if (period === 'yearly') {
							yearlyPrice.classList.remove('price-hidden');
							monthlyPrice.classList.add('price-hidden');
						} else {
							yearlyPrice.classList.add('price-hidden');
							monthlyPrice.classList.remove('price-hidden');
						}
					});
				});
			});
		});
	</script>

<?php get_footer(); ?>
