<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Api\Pagination;

class PageInfo {
	public bool $has_next_page;

	public bool $has_previous_page;

	public ?string $start_cursor;

	public ?string $end_cursor;
}
