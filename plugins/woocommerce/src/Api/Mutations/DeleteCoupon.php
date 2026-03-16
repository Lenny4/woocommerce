<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Api\Mutations;

use Automattic\WooCommerce\Api\ApiException;
use Automattic\WooCommerce\Api\Attributes\Description;
use Automattic\WooCommerce\Api\Attributes\RequiredCapability;
use Automattic\WooCommerce\Api\Types\DeleteCouponResult;

#[Description('Delete a coupon.')]
#[RequiredCapability('manage_woocommerce')]
class DeleteCoupon {
	public function execute(
		#[Description('The ID of the coupon to delete.')]
		int $id,
		#[Description('Whether to permanently delete the coupon (bypass trash).')]
		bool $force = false,
	): DeleteCouponResult {
		$wc_coupon = new \WC_Coupon( $id );

		if ( ! $wc_coupon->get_id() ) {
			throw new ApiException( 'Coupon not found.', 'NOT_FOUND', status_code: 404 );
		}

		$wc_coupon->delete( $force );

		$result          = new DeleteCouponResult();
		$result->id      = $id;
		$result->deleted = $force || $wc_coupon->get_id() === 0;

		return $result;
	}
}
