<?php

declare(strict_types=1);

namespace Automattic\WooCommerce\Api\Attributes;

use Attribute;

/**
 * Adds a description to a query/mutation argument without overriding its type.
 *
 * Unlike #[Parameter] (which declares the full argument), this attribute only
 * sets the description for an argument whose type and default are already
 * inferred from the `execute()` method signature. This attribute is repeatable:
 * apply it once per argument that needs a description.
 */
#[Attribute(Attribute::IS_REPEATABLE)]
final class ParameterDescription {
	/**
	 * @param string $name        The argument name (must match the `execute()`
	 *                            parameter name).
	 * @param string $description Human-readable description for the schema.
	 */
	public function __construct(
		public readonly string $name,
		public readonly string $description,
	) {
	}
}
