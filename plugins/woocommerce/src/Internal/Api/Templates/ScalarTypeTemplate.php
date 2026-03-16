<?php
/**
 * Template for generating a GraphQL CustomScalarType class.
 *
 * @var string $namespace
 * @var string $class_name
 * @var string $graphql_name
 * @var string $description
 * @var string $scalar_fqcn
 * @var string $scalar_alias
 */

$escaped_description = addslashes( $description );
?>
<?= '<?php' ?>

declare(strict_types=1);

// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.

namespace <?= $namespace ?>;

use <?= $scalar_fqcn ?> as <?= $scalar_alias ?>;
use GraphQL\Type\Definition\CustomScalarType;

class <?= $class_name ?> {
	private static ?CustomScalarType $instance = null;

	public static function get(): CustomScalarType {
		if (self::$instance === null) {
			self::$instance = new CustomScalarType([
				'name' => '<?= $graphql_name ?>',
<?php if ( $description !== '' ) : ?>
				'description' => '<?= $escaped_description ?>',
<?php endif; ?>
				'serialize' => fn($value) => <?= $scalar_alias ?>::serialize($value),
				'parseValue' => fn($value) => <?= $scalar_alias ?>::parse($value),
				'parseLiteral' => function ($valueNode, ?array $variables = null) {
					if ($valueNode instanceof \GraphQL\Language\AST\StringValueNode) {
						return <?= $scalar_alias ?>::parse($valueNode->value);
					}
					throw new \GraphQL\Error\Error(
						'<?= $graphql_name ?> must be a string, got: ' . $valueNode->kind
					);
				},
			]);
		}
		return self::$instance;
	}
}
