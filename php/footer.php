<?php
/**
 * The footer for our theme
 */
?>

	<!-- ══════════════════════════════════════════════
	     FOOTER
	══════════════════════════════════════════════ -->
	<footer class="footer">
		<div class="container">
			<div class="row g-4">

				<!-- Бренд / Контакты -->
				<div class="col-12 col-sm-6 col-lg-3">
					<div class="footer-logo text-white mb-3">
						<?php echo brain_get_logo_html(); ?>
					</div>
					
					<!-- Описание компании (из ACF) -->
					<?php 
						$company_desc = function_exists('get_field') ? get_field('company_description', 'option') : 'AI Business';
						if ($company_desc):
					?>
						<p class="mb-3" style="color:var(--text-secondary);font-size:.9rem;">
							<?php echo esc_html($company_desc); ?>
						</p>
					<?php endif; ?>

					<!-- Социальные сети (из ACF) -->
					<div class="d-flex gap-2 mb-3">
						<?php 
							$social_links = function_exists('get_field') ? get_field('social_links', 'option') : array();
							if (!empty($social_links) && is_array($social_links)):
								foreach ($social_links as $link):
									$platform = isset($link['platform']) ? $link['platform'] : '';
									$url = isset($link['url']) ? $link['url'] : '#';
									$icon = 'bi-' . strtolower($platform);
						?>
									<a href="<?php echo esc_url($url); ?>" class="social-icon" aria-label="<?php echo esc_attr($platform); ?>" target="_blank" rel="noopener noreferrer">
										<i class="bi <?php echo esc_attr($icon); ?>"></i>
									</a>
						<?php 
								endforeach;
							else:
								// Fallback значения
						?>
								<a href="#" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
								<a href="#" class="social-icon" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
								<a href="#" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
								<a href="#" class="social-icon" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
						<?php endif; ?>
					</div>

					<!-- Телефон (из ACF) -->
					<?php 
						$phone = function_exists('get_field') ? get_field('phone', 'option') : '+998 90 123 45 67';
						if ($phone):
					?>
						<p style="color:var(--text-secondary);font-size:.875rem;">
							<i class="bi bi-telephone me-2"></i>
							<a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>" style="color:var(--text-secondary); text-decoration:none;">
								<?php echo esc_html($phone); ?>
							</a>
						</p>
					<?php endif; ?>

					<!-- Приложения -->
					<p style="color:var(--text-secondary);font-size:.875rem;" class="mb-2">
						<?php esc_html_e('Скачайте приложение', 'brain'); ?>
					</p>
					<div class="d-flex gap-2 flex-wrap storyIcon">
						<a href="https://play.google.com" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url(brain_get_image_url('playmarketfoo.svg')); ?>" alt="Google Play" style="height:28px;">
						</a>
						<a href="https://apps.apple.com" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url(brain_get_image_url('apstoryfoo.svg')); ?>" alt="App Store" style="height:28px;">
						</a>
					</div>
				</div>

				<!-- Возможности -->
				<div class="col-12 col-sm-6 col-lg-3">
					<h5 class="text-white mb-3">
						<?php esc_html_e('Возможности', 'brain'); ?>
					</h5>
					<?php 
						$features = function_exists('get_field') ? get_field('footer_features', 'option') : array();
						if (!empty($features) && is_array($features)):
							foreach ($features as $feature):
								$title = isset($feature['title']) ? $feature['title'] : '';
								$link = isset($feature['link']) ? $feature['link'] : '#';
					?>
								<a href="<?php echo esc_url($link); ?>" class="footer-link">
									<?php echo esc_html($title); ?>
								</a>
					<?php 
							endforeach;
						else:
							// Fallback значения
					?>
							<a href="#" class="footer-link">Структура компании</a>
							<a href="#" class="footer-link">KPI и Метрики</a>
							<a href="#" class="footer-link">Основные возможности</a>
							<a href="#" class="footer-link">Контроль сотрудников</a>
							<a href="#" class="footer-link">Мобильное приложение</a>
					<?php endif; ?>
				</div>

				<!-- Ресурсы -->
				<div class="col-12 col-sm-6 col-lg-3">
					<h5 class="text-white mb-3">
						<?php esc_html_e('Ресурсы', 'brain'); ?>
					</h5>
					<?php 
						$resources = function_exists('get_field') ? get_field('footer_resources', 'option') : array();
						if (!empty($resources) && is_array($resources)):
							foreach ($resources as $resource):
								$title = isset($resource['title']) ? $resource['title'] : '';
								$link = isset($resource['link']) ? $resource['link'] : '#';
					?>
								<a href="<?php echo esc_url($link); ?>" class="footer-link">
									<?php echo esc_html($title); ?>
								</a>
					<?php 
							endforeach;
						else:
							// Fallback значения
					?>
							<a href="#" class="footer-link">Документация по API</a>
							<a href="#" class="footer-link">Безопасность данных</a>
							<a href="#" class="footer-link">Блог</a>
							<a href="#" class="footer-link">Онлайн-конференция</a>
					<?php endif; ?>
				</div>

				<!-- О компании -->
				<div class="col-12 col-sm-6 col-lg-3">
					<h5 class="text-white mb-3">
						<?php esc_html_e('О компании', 'brain'); ?>
					</h5>
					<?php 
						$company_links = function_exists('get_field') ? get_field('footer_company', 'option') : array();
						if (!empty($company_links) && is_array($company_links)):
							foreach ($company_links as $link):
								$title = isset($link['title']) ? $link['title'] : '';
								$url = isset($link['link']) ? $link['link'] : '#';
					?>
								<a href="<?php echo esc_url($url); ?>" class="footer-link">
									<?php echo esc_html($title); ?>
								</a>
					<?php 
							endforeach;
						else:
							// Fallback значения
					?>
							<a href="<?php echo esc_url(home_url('/contacts')); ?>" class="footer-link">Контакты</a>
							<a href="#" class="footer-link">Отзывы</a>
							<a href="<?php echo esc_url(home_url('/about')); ?>" class="footer-link">О компании</a>
					<?php endif; ?>
				</div>

			</div>

			<hr class="my-4" style="border-color:var(--border-subtle);">

			<div class="row align-items-center">
				<div class="col-md-6">
					<p style="color:var(--text-secondary);margin:0;font-size:.875rem;">
						<?php 
							$copyright = function_exists('get_field') ? get_field('copyright_text', 'option') : '© ООО «Brain», 2021–' . date('Y');
							echo wp_kses_post($copyright);
						?>
					</p>
				</div>
				<div class="col-md-6 text-md-end mt-2 mt-md-0">
					<a href="<?php echo esc_url(home_url('/privacy')); ?>" class="footer-link d-inline-block me-3" style="font-size:.875rem;">
						<?php esc_html_e('Privacy', 'brain'); ?>
					</a>
					<a href="<?php echo esc_url(home_url('/terms')); ?>" class="footer-link d-inline-block me-3" style="font-size:.875rem;">
						<?php esc_html_e('Terms', 'brain'); ?>
					</a>
					<a href="<?php echo esc_url(home_url('/support')); ?>" class="footer-link d-inline-block" style="font-size:.875rem;">
						<?php esc_html_e('Support', 'brain'); ?>
					</a>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

</body>
</html>
