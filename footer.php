<?php
/**
 * WordPress template file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

$navbar_items = get_nav_menu_items_by_location( 'main-navbar' );

?>

			</main>
		</section>
		<footer>
			<div class="flex flex-wrap bg-dark-gray text-gray-500 p-4" role="contentinfo">
				<div class="grow w-full md:w-1/2 lg:w-1/3 p-2 flex flex-col items-center">
					<h2 class="text-center mt-0">
						<?php if ( Options::get( 'the_phantom_url' ) ) : ?>
							<a class="text-gray-400 no-underline" href="<?php echo esc_attr( Options::get( 'the_phantom_url' ) ); ?>">
								<?php echo esc_html( get_phantom_quote() ); ?>
							</a>
						<?php else : ?>
							<?php echo esc_html( get_phantom_quote() ); ?>
						<?php endif; ?>
					</h2>
					<img class="w-32 max-w-1/2" src="<?php echo esc_attr( get_template_directory_uri() . '/assets/the-phantom.svg' ); ?>">
				</div>
				<div class="grow w-full md:w-1/2 lg:w-1/3 p-2 flex justify-center md:order-first text-center md:text-left">
					<div class="inline-block">
						<h3><a class="text-gray-400 no-underline mt-0" href="<?php echo esc_attr( home_url() ); ?>"><?php esc_html_e( 'The Physics Division', 'ftek-theme' ); ?></a></h3>
						<ul class="text-sm">
							<?php if ( Options::get( 'org_nr' ) ) : ?>
								<li>
									<?php // translators: %1$s Organization number. ?>
									<?php echo esc_html( sprintf( __( 'Organization number: %1$s', 'ftek-theme' ), Options::get( 'org_nr' ) ) ); ?>
								</li>
							<?php endif; ?>
							<?php if ( Options::get( 'publisher_name' ) ) : ?>
								<li>
									<?php // translators: %1$s Publisher name. ?>
									<?php echo esc_html( sprintf( __( 'Publisher: %1$s', 'ftek-theme' ), Options::get( 'publisher_name' ) ) ); ?>
								</li>
							<?php endif; ?>
							<?php if ( Options::get( 'email' ) ) : ?>
								<li>
									<?php // translators: %1$s Email anchor. ?>
									<?php echo sprintf( __( 'Email: %1$s', 'ftek-theme' ), '<a class="text-gray-400" href="mailto:' . esc_attr( Options::get( 'email' ) ) . '">' . esc_attr( Options::get( 'email' ) ) . '</a>' ); ?> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</li>
							<?php endif; ?>
							<?php if ( Options::get( 'street_address' ) ) : ?>
								<li>
									<?php // translators: %1$s Street address. ?>
									<?php echo esc_html( sprintf( __( 'Street address: %1$s', 'ftek-theme' ), Options::get( 'street_address' ) ) ); ?>
								</li>
							<?php endif; ?>
							<?php if ( Options::get( 'mailing_address' ) ) : ?>
								<li>
									<?php // translators: %1$s Mailing address. ?>
									<?php echo esc_html( sprintf( __( 'Mailing address: %1$s', 'ftek-theme' ), Options::get( 'mailing_address' ) ) ); ?>
								</li>
							<?php endif; ?>
							<?php if ( Options::get( 'contact_url' ) ) : ?>
								<li>
									<a class="text-gray-400" href="<?php echo esc_attr( Options::get( 'contact_url' ) ); ?>">
										<?php esc_html_e( 'Looking for someone?', 'ftek-theme' ); ?>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<div class="grow w-full md:w-1/2 lg:w-1/3 p-2 flex justify-center text-sm">
					<a class="w-3/4" href="https://chalmersstudentkar.se">
						<img class="w-full" src="<?php echo esc_attr( get_template_directory_uri() . '/assets/student-union.svg' ); ?>">
					</a>
				</div>
				<div class="grow w-full md:w-1/2 lg:w-1/3 p-2 flex flex-col items-center text-sm">
					<?php // translators: %1$s Name of a person or group. ?>
					<span><?php echo sprintf( __( 'Development and design: %1$s', 'ftek-theme' ), '<a class="text-gray-400" target="_blank" rel="noreferre noopener" href="https://github.com/OssianEriksson">Ossian Eriksson</a>' ); ?></span> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php // translators: %1$s Name of a person or group. ?>
					<span><?php echo sprintf( __( 'Original design: %1$s', 'ftek-theme' ), '<a class="text-gray-400" target="_blank" rel="noreferre noopener" href="https://github.com/JohanWinther">Johan Winther</a>' ); ?></span> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php if ( Options::get( 'support_name' ) ) : ?>
						<?php // translators: %1$s Name of a person or group. ?>
						<span><?php echo sprintf( __( 'Development and support: %1$s', 'ftek-theme' ), esc_attr( Options::get( 'support_url' ) ) ? ( '<a class="text-gray-400" href="' . esc_attr( Options::get( 'support_url' ) ) . '">' . esc_html( Options::get( 'support_name' ) ) . '</a>' ) : esc_html( Options::get( 'support_name' ) ) ); ?></span> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php endif; ?>
					<div class="mt-4 text-center">
						<?php if ( Options::get( 'contact_url' ) || Options::get( 'privacy_policy_url' ) ) : ?>
							<span class="mr-4">
								<?php if ( Options::get( 'contact_url' ) ) : ?>
									<a class="text-gray-400" href="<?php echo esc_attr( Options::get( 'contact_url' ) ); ?>">
										<?php esc_html_e( 'Contact', 'ftek-theme' ); ?>
									</a>
								<?php endif; ?>
								<?php echo Options::get( 'contact_url' ) && Options::get( 'privacy_policy_url' ) ? '|' : ''; ?>
								<?php if ( Options::get( 'privacy_policy_url' ) ) : ?>
									<a class="text-gray-400" href="<?php echo esc_attr( Options::get( 'privacy_policy_url' ) ); ?>">
										<?php esc_html_e( 'Privacy Policy', 'ftek-theme' ); ?>
									</a>
								<?php endif; ?>
							</span>
						<?php endif; ?>
						<span class="whitespace-nowrap">© <?php echo esc_html( date( 'Y' ) ); ?> Fysikteknologsektionen</span> <?php //phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date ?>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
