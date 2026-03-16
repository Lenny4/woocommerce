<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Api\Mutations;

use Automattic\WooCommerce\Api\Attributes\Description;
use Automattic\WooCommerce\Api\Attributes\RequiredCapability;
use Automattic\WooCommerce\Api\InputTypes\CreateCouponInput;
use Automattic\WooCommerce\Api\Queries\CouponMapper;
use Automattic\WooCommerce\Api\Types\Coupon;

#[Description('Create a new coupon.')]
#[RequiredCapability('manage_woocommerce')]
class CreateCoupon {
	public function execute(
		#[Description('Data for the new coupon.')]
		CreateCouponInput $input,
	): Coupon {
		$wc_coupon = new \WC_Coupon();
		$wc_coupon->set_code( $input->code );

		if ( $input->description !== null ) {
			$wc_coupon->set_description( $input->description );
		}
		if ( $input->discount_type !== null ) {
			$wc_coupon->set_discount_type( $input->discount_type->value );
		}
		if ( $input->amount !== null ) {
			$wc_coupon->set_amount( $input->amount );
		}
		if ( $input->status !== null ) {
			$wc_coupon->set_status( $input->status->value );
		}
		if ( $input->date_expires !== null ) {
			$wc_coupon->set_date_expires( $input->date_expires );
		}
		if ( $input->individual_use !== null ) {
			$wc_coupon->set_individual_use( $input->individual_use );
		}
		if ( $input->product_ids !== null ) {
			$wc_coupon->set_product_ids( $input->product_ids );
		}
		if ( $input->excluded_product_ids !== null ) {
			$wc_coupon->set_excluded_product_ids( $input->excluded_product_ids );
		}
		if ( $input->usage_limit !== null ) {
			$wc_coupon->set_usage_limit( $input->usage_limit );
		}
		if ( $input->usage_limit_per_user !== null ) {
			$wc_coupon->set_usage_limit_per_user( $input->usage_limit_per_user );
		}
		if ( $input->limit_usage_to_x_items !== null ) {
			$wc_coupon->set_limit_usage_to_x_items( $input->limit_usage_to_x_items );
		}
		if ( $input->free_shipping !== null ) {
			$wc_coupon->set_free_shipping( $input->free_shipping );
		}
		if ( $input->product_categories !== null ) {
			$wc_coupon->set_product_categories( $input->product_categories );
		}
		if ( $input->excluded_product_categories !== null ) {
			$wc_coupon->set_excluded_product_categories( $input->excluded_product_categories );
		}
		if ( $input->exclude_sale_items !== null ) {
			$wc_coupon->set_exclude_sale_items( $input->exclude_sale_items );
		}
		if ( $input->minimum_amount !== null ) {
			$wc_coupon->set_minimum_amount( $input->minimum_amount );
		}
		if ( $input->maximum_amount !== null ) {
			$wc_coupon->set_maximum_amount( $input->maximum_amount );
		}
		if ( $input->email_restrictions !== null ) {
			$wc_coupon->set_email_restrictions( $input->email_restrictions );
		}

		$wc_coupon->save();

		return CouponMapper::fromWcCoupon( $wc_coupon );
	}
}
