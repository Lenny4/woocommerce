<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Api;

class ApiException extends \RuntimeException {
	public function __construct(
		string $message,
		private readonly string $error_code = 'INTERNAL_ERROR',
		private readonly array $extensions = [],
		int $status_code = 500,
		?\Throwable $previous = null,
	) {
		parent::__construct( $message, $status_code, $previous );
	}

	public function getErrorCode(): string {
		return $this->error_code;
	}

	public function getExtensions(): array {
		return $this->extensions;
	}

	public function getStatusCode(): int {
		return $this->getCode();
	}
}
