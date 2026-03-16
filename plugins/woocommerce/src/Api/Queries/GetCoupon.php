<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Api\Queries;

use Automattic\WooCommerce\Api\Attributes\Description;
use Automattic\WooCommerce\Api\Attributes\Name;
use Automattic\WooCommerce\Api\Attributes\RequiredCapability;
use Automattic\WooCommerce\Api\Attributes\PublicAccess;
use Automattic\WooCommerce\Api\Types\Coupon;

#[Name('Coupon')]
#[Description('Retrieve a single coupon by ID or code. Exactly one of the two arguments must be provided.')]
//#[RequiredCapability('manage_woocommerce')]
#[PublicAccess]
class GetCoupon {
	public function execute(
		#[Description('The ID of the coupon to retrieve.')]
		?int $id = null,
		#[Description('The coupon code to look up.')]
		?string $code = null,
	): ?Coupon {
		if ( ( $id === null ) === ( $code === null ) ) {
			throw new \InvalidArgumentException( 'Exactly one of "id" or "code" must be provided.' );
		}

		$wc_coupon = new \WC_Coupon( $id ?? $code );

		if ( ! $wc_coupon->get_id() ) {
			return null;
		}

		return CouponMapper::fromWcCoupon( $wc_coupon );
	}
}

