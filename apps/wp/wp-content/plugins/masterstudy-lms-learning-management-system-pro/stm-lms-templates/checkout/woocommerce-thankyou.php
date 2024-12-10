<?php
/**
 * @var int $order
 *
 * The $order object is passed from the method masterstudy_create_template_thankyou_message()
 * located in the file lms/classes/woocommerce-thankyou.php.
 */
wp_enqueue_style( 'masterstudy-button' );
stm_lms_register_style( 'user-orders' );
if ( isset( $order ) && $order instanceof WC_Order ) {
	$order_info    = STM_LMS_Order::get_order_info( $order->get_id() );
	$order_details = apply_filters( 'stm_lms_order_details', null, $order_id );
	?>
	<div class="stm-lms-wrapper">
		<div class="container">
			<div class="masterstudy-orders masterstudy-thank-you-page">
				<div class="masterstudy-orders-box">
					<div class="masterstudy-orders-box__title"><?php echo esc_html__( 'Thank you for your order!', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
					<div class="masterstudy-orders-box__info">
						<div class="masterstudy-orders-box__info-label"><?php echo esc_html__( 'Order ID:', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
						<div class="masterstudy-orders-box__info-value">
							<div class="masterstudy-orders-box__info-label"><?php echo esc_html( $order_info['id'] ); ?></div>
						</div>
					</div>
					<div class="masterstudy-orders-box__info">
						<div class="masterstudy-orders-box__info-label"><?php echo esc_html__( 'Date:', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
						<div class="masterstudy-orders-box__info-value"><?php echo esc_html( $order_info['date_formatted'] ); ?></div>
					</div>
				</div>
				<?php
				$wire_transfer           = get_option( 'woocommerce_bacs_accounts' );
				$woocommerce_enable_bacs = get_option( 'woocommerce_bacs_settings' );

				if ( ! empty( $wire_transfer ) && 'Direct bank transfer' === $order_info['payment_code'] && 'yes' === $woocommerce_enable_bacs['enabled'] ) :
					?>
					<div class="masterstudy-payment-methods">
						<div class="masterstudy-payment-methods__title">
							<?php echo esc_html__( 'Bank details', 'masterstudy-lms-learning-management-system-pro' ); ?>
						</div>
						<div class="masterstudy-payment-methods__table-woocommerce">
						<?php foreach ( $wire_transfer as $key => $account ) : ?>
							<div class="masterstudy-payment-methods__table">
								<div class="masterstudy-payment-methods__sub-title">
									<?php echo esc_html__( 'Method', 'masterstudy-lms-learning-management-system-pro' ) . ' ' . esc_html( $key + 1 ); ?>
								</div>
								<div class="masterstudy-payment-methods__table-column">
									<div class="masterstudy-payment-methods__name"><?php echo esc_html__( 'Bank', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
									<div class="masterstudy-payment-methods__value"><?php echo esc_html( $account['bank_name'] ); ?></div>
								</div>
								<div class="masterstudy-payment-methods__table-column">
									<div class="masterstudy-payment-methods__name"><?php echo esc_html__( 'Recipient', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
									<div class="masterstudy-payment-methods__value"><?php echo esc_html( $account['account_name'] ); ?></div>
								</div>
								<div class="masterstudy-payment-methods__table-column">
									<div class="masterstudy-payment-methods__name"><?php echo esc_html__( 'Account Number', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
									<div class="masterstudy-payment-methods__value"><?php echo esc_html( $account['account_number'] ); ?></div>
								</div>
								<div class="masterstudy-payment-methods__table-column">
									<div class="masterstudy-payment-methods__name"><?php echo esc_html__( 'Amount to be paid', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
									<div class="masterstudy-payment-methods__value"><?php echo esc_attr( $order_info['total'] ); ?></div>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="masterstudy-orders-container">
					<div class="masterstudy-orders-table">
						<div class="masterstudy-orders-table__header">
							<div class="masterstudy-orders-course-info">
								<?php echo esc_html__( 'Order details', 'masterstudy-lms-learning-management-system-pro' ); ?>
							</div>
						</div>
						<div class="masterstudy-orders-table__body">
							<?php
								$items_info = array();

							foreach ( $order_info['items'] as $item ) {
								$items_info[ $item['item_id'] ] = array(
									'bundle_id'     => $item['bundle_id'] ?? null,
									'enterprise_id' => $item['enterprise_id'] ?? null,
								);
							}

							foreach ( $order_info['cart_items'] as $item_id => $order ) :
								$bundle_id     = $items_info[ $item_id ]['bundle_id'] ?? null;
								$enterprise_id = $items_info[ $item_id ]['enterprise_id'] ?? null;
								?>
							<div class="masterstudy-orders-table__body-row">
								<div class="masterstudy-orders-course-info">
									<div class="masterstudy-orders-course-info__image">
										<a href="<?php echo esc_url( $order['link'] ); ?>">
											<img width="300" height="225" src="<?php echo esc_url( wp_get_attachment_url( $order['thumbnail_id'] ) ); ?>" class="attachment-img-300-225 size-img-300-225 wp-post-image" alt="<?php echo esc_attr( $order['title'] ); ?>" decoding="async" loading="lazy">
										</a>
									</div>
									<div class="masterstudy-orders-course-info__common">
										<div class="masterstudy-orders-course-info__title">
											<a href="<?php echo esc_url( $order['link'] ); ?>"><?php echo esc_html( $order['title'] ); ?></a>
											<?php if ( ! empty( $bundle_id ) ) : ?>
											<span class="order-status"><?php echo esc_html__( 'bundle', 'masterstudy-lms-learning-management-system-pro' ); ?></span>
											<?php endif; ?>
											<?php if ( ! empty( $enterprise_id ) ) : ?>
											<span class="order-status"><?php echo esc_html__( 'enterprise', 'masterstudy-lms-learning-management-system-pro' ); ?></span>
											<?php endif; ?>
										</div>
										<div class="masterstudy-orders-course-info__category">
										<?php
										if ( ! empty( $order['terms'] ) ) {
											echo esc_html( implode( ' ', $order['terms'] ) );
										}

										if ( ! empty( $order['bundle_courses_count'] ) ) {
											echo esc_html( $order['bundle_courses_count'] . ' ' . $order_info['i18n']['bundle'] );
										}
										?>
										</div>
									</div>
									<div class="masterstudy-orders-course-info__price">
										<?php echo esc_html( $order['price_formatted'] ); ?>
									</div>
									<?php
										STM_LMS_Templates::show_lms_template(
											'components/button',
											array(
												'title' => esc_html__( 'Go to course', 'masterstudy-lms-learning-management-system-pro' ),
												'link'  => esc_url( $order['link'] ),
												'style' => 'secondary masterstudy-orders-course-info__button',
												'size'  => 'sm',
											)
										);
									?>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="masterstudy-orders-table__footer">
							<div class="masterstudy-orders-course-info">
								<div class="masterstudy-orders-course-info__label"><?php echo esc_html__( 'Total', 'masterstudy-lms-learning-management-system-pro' ); ?>:</div>
								<div class="masterstudy-orders-course-info__price"><?php echo wp_kses_post( $order_info['total'] ); ?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="masterstudy-orders-row">
					<!-- Student info -->
					<div class="masterstudy-orders-column">
						<div class="masterstudy-orders-table">
							<div class="masterstudy-orders-table__header">
								<div class="masterstudy-orders-course-info"><?php echo esc_html__( 'Address', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
							</div>
								<?php
								$billing_info_data = array(
									__( 'Full name', 'masterstudy-lms-learning-management-system-pro' ) => $order_info['billing']['first_name'],
									__( 'Email', 'masterstudy-lms-learning-management-system-pro' )     => $order_info['billing']['last_name'],
									__( 'Address', 'masterstudy-lms-learning-management-system-pro' )   => $order_info['billing']['address_1'],
									__( 'Country', 'masterstudy-lms-learning-management-system-pro' )   => $order_info['billing']['country'],
									__( 'Phone', 'masterstudy-lms-learning-management-system-pro' )     => $order_info['billing']['phone'],
								);
								?>
							<div class="masterstudy-orders-table__body">
								<?php foreach ( $billing_info_data as $label => $value ) : ?>
									<div class="masterstudy-orders-table__body-row">
										<div class="masterstudy-orders-course-info">
											<div class="masterstudy-orders-course-info__label"><?php echo sprintf( esc_html__( '%s:', 'masterstudy-lms-learning-management-system-pro' ), esc_html( $label ) ); ?></div>
											<div class="masterstudy-orders-course-info__value"><?php echo esc_html( $value ); ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<!-- Total fee -->
					<div class="masterstudy-orders-column">
						<div class="masterstudy-orders-table">
							<div class="masterstudy-orders-table__header">
								<div class="masterstudy-orders-course-info"><?php echo esc_html__( 'Total Billed', 'masterstudy-lms-learning-management-system-pro' ); ?></div>
							</div>
								<?php
								$total_info_data = array(
									__( 'Payment method', 'masterstudy-lms-learning-management-system-pro' ) => $order_info['payment_code'],
									__( 'Total', 'masterstudy-lms-learning-management-system-pro' )          => $order_info['total'],
									__( 'Status', 'masterstudy-lms-learning-management-system-pro' )         => '<span class="order-status ' . esc_attr( $order_info['status'] ) . '">' . esc_attr( $order_info['status_name'] ) . '</span>',
									__( 'Transaction ID', 'masterstudy-lms-learning-management-system-pro' ) => $order_details['billing']['transaction'],
								);
								?>
							<div class="masterstudy-orders-table__body">
								<?php foreach ( $total_info_data as $label => $value ) : ?>
								<div class="masterstudy-orders-table__body-row">
									<div class="masterstudy-orders-course-info">
										<div class="masterstudy-orders-course-info__label"><?php echo sprintf( esc_html__( '%s:', 'masterstudy-lms-learning-management-system-pro' ), esc_html( $label ) ); ?></div>
										<div class="masterstudy-orders-course-info__value"><?php echo wp_kses_post( $value ); ?></div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="masterstudy-orders-button">
				<?php
					STM_LMS_Templates::show_lms_template(
						'components/button',
						array(
							'title' => esc_html__( 'View all orders', 'masterstudy-lms-learning-management-system-pro' ),
							'link'  => esc_url( get_permalink( STM_LMS_Options::get_option( 'user_url' ) ) . 'my-orders/' ),
							'style' => 'secondary',
							'size'  => 'sm',
						)
					);
				?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
