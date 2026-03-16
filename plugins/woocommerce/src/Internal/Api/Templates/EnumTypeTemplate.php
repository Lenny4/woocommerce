<?php
/**
 * Template for generating a GraphQL EnumType class.
 *
 * @var string $namespace
 * @var string $class_name
 * @var string $graphql_name
 * @var string $description
 * @var string $enum_fqcn
 * @var string $enum_alias
 * @var array  $values - each: ['graphql_name', 'case_name', 'description', 'deprecation_reason' => ?string]
 */

$escaped_description = addslashes( $description );
?>
<?= '<?php' ?>

declare(strict_types=1);

// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.

namespace <?= $namespace ?>;

use <?= $enum_fqcn ?> as <?= $enum_alias ?>;
use GraphQL\Type\Definition\EnumType;

class <?= $class_name ?> {
	private static ?EnumType $instance = null;

	public static function get(): EnumType {
		if (self::$instance === null) {
			self::$instance = new EnumType([
				'name' => '<?= $graphql_name ?>',
<?php if ( $description !== '' ) : ?>
				'description' => '<?= $escaped_description ?>',
<?php endif; ?>
				'values' => [
<?php foreach ( $values as $val ) : ?>
					'<?= $val['graphql_name'] ?>' => [
						'value' => <?= $enum_alias ?>::<?= $val['case_name'] ?>,
<?php if ( ! empty( $val['description'] ) ) : ?>
						'description' => '<?= addslashes( $val['description'] ) ?>',
<?php endif; ?>
<?php if ( ! empty( $val['deprecation_reason'] ) ) : ?>
						'deprecationReason' => '<?= addslashes( $val['deprecation_reason'] ) ?>',
<?php endif; ?>
					],
<?php endforeach; ?>
				],
			]);
		}
		return self::$instance;
	}
}
