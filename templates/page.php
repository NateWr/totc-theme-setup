<div class="wrap">
	<h1><?php echo esc_html( $this->strings['page.title'] ); ?><h1>

	<?php if ( !empty( $this->demos ) ) : ?>

		<h2><?php echo esc_html( $this->strings['page.demo.section'] ); ?></h2>

		<table class="form-table">
			<tbody>

				<?php foreach( $this->demos as $demo ) : $demo->get_status(); ?>
					<tr>
						<th scope="row">
							<?php echo esc_html( $demo->title ); ?>
						</th>
						<td>
							<?php if ( $demo->status == 'install_plugin' ) : ?>
								<?php if ( current_user_can( 'install_plugins' ) ) : ?>
									<?php
										$path = 'themes.php?page=tgmpa-install-plugins';
									?>
									<a class="button" data-title="<?php echo esc_attr( $demo->title ); ?>" href="<?php echo is_multisite() ? esc_url( network_admin_url( $path ) ) : esc_url( admin_url( $path ) ); ?>">
										<?php echo esc_html( $this->strings['page.demo.install_plugin'] ); ?>
									</a>

								<?php else : ?>
									<p class="description">
										<?php echo esc_html( $this->strings['page.demo.install_plugin.no_permission'] ); ?>
									</p>
								<?php endif; ?>

							<?php elseif ( $demo->status == 'activate_plugin' ) : ?>
								<?php if ( current_user_can( 'activate_plugins' ) ) : ?>
									<a class="button" href="<?php echo esc_url( admin_url( 'plugins.php?s=' . str_replace( ' ', '+', $demo->slug ) ) ); ?>">
										<?php echo esc_html( $this->strings['page.demo.activate_plugin'] ); ?>
									</a>
								<?php else : ?>
									<p class="description">
										<?php echo esc_html( $this->strings['page.demo.activate_plugin.no_permission'] ); ?>
									</p>
								<?php endif; ?>

							<?php elseif ( $demo->status == 'install_demo' ) : ?>
								<?php if ( $demo->current_user_can() ) : ?>
									<a class="button button-primary totc-theme-setup-install-demo-content" data-slug="<?php echo esc_attr( $demo->slug ); ?>" href="#">
										<?php echo esc_html( $this->strings['page.demo.install_demo'] ); ?>
									</a>
								<?php else : ?>
									<p class="description">
										<?php echo esc_html( $this->strings['page.demo.install_demo.no_permission'] ); ?>
									</p>
								<?php endif; ?>

							<?php elseif ( $demo->status == 'done' ) : ?>
								<?php
									$post_id = get_option( 'totc_theme_demo_content_' . sanitize_key( $demo->slug ), false );
									$permalink = get_permalink( $post_id );
								?>
								<a href="<?php echo esc_url( $permalink ); ?>">
									<?php echo esc_html( $this->strings['page.demo.view_demo'] ); ?>
								</a>

							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php endif; // demos ?>

	<h2><?php echo esc_html( $this->strings['page.documentation.section'] ); ?></h2>

	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<?php echo esc_html( $this->strings['page.documentation.help'] ); ?>
				</th>
				<td>
					<a href="<?php echo esc_url( $this->strings['page.documentation.help.url'] ); ?>">
						<?php echo esc_html( $this->strings['page.documentation.help.description'] ); ?>
					</a>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<?php echo esc_html( $this->strings['page.documentation.support'] ); ?>
				</th>
				<td>
					<?php printf( $this->strings['page.documentation.support.description'], '<a href="' . esc_url( $this->strings['page.documentation.support.url'] ) . '">', '</a>' ); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<?php echo esc_html( $this->strings['page.documentation.demo'] ); ?>
				</th>
				<td>
					<a href="<?php echo esc_url( $this->strings['page.documentation.demo.url'] ); ?>" target="_blank">
						<?php echo esc_html( $this->strings['page.documentation.demo.description'] ); ?>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
 </div>
