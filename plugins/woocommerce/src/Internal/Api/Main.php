<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Internal\Api;

class Main {
	private GraphQLController $controller;

	/**
	 * DI: injected by WooCommerce container.
	 */
	final public function init( GraphQLController $controller ): void {
		$this->controller = $controller;
	}

	/**
	 * Register the API. Called during WooCommerce initialization.
	 */
	public function register(): void {
		add_action( 'rest_api_init', array( $this->controller, 'register' ) );
	}
}
