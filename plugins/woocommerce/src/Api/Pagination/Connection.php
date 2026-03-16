<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Api\Pagination;

class Connection {
	/** @var Edge[] */
	public array $edges;

	/** @var object[] The raw nodes without cursor wrappers. */
	public array $nodes;

	public PageInfo $page_info;

	public int $total_count;
}
