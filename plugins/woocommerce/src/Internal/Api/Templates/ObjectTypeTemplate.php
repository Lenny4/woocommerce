<?php
/**
 * Template for generating a GraphQL ObjectType class.
 *
 * @var string $namespace
 * @var string $class_name
 * @var string $graphql_name
 * @var string $description
 * @var array  $use_statements
 * @var array  $interfaces - each: ['alias' => string]
 * @var array  $fields - each: ['name', 'type_expr', 'description', 'args' => [], 'deprecation_reason' => ?string]
 */

$escaped_description = addslashes( $description );
?>
<?= '<?php' ?>

declare(strict_types=1);

// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.

namespace <?= $namespace ?>;

<?php foreach ( $use_statements as $use ) : ?>
use <?= $use ?>;
<?php endforeach; ?>
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class <?= $class_name ?> {
	private static ?ObjectType $instance = null;

	public static function get(): ObjectType {
		if (self::$instance === null) {
			self::$instance = new ObjectType([
				'name' => '<?= $graphql_name ?>',
<?php if ( $description !== '' ) : ?>
				'description' => '<?= $escaped_description ?>',
<?php endif; ?>
<?php if ( ! empty( $interfaces ) ) : ?>
				'interfaces' => fn() => [
<?php foreach ( $interfaces as $iface ) : ?>
					<?= $iface['alias'] ?>::get(),
<?php endforeach; ?>
				],
<?php endif; ?>
				'fields' => fn() => [
<?php foreach ( $fields as $field ) : ?>
					'<?= $field['name'] ?>' => [
						'type' => <?= $field['type_expr'] ?>,
<?php if ( ! empty( $field['description'] ) ) : ?>
						'description' => '<?= addslashes( $field['description'] ) ?>',
<?php endif; ?>
<?php if ( ! empty( $field['args'] ) ) : ?>
						'args' => [
<?php foreach ( $field['args'] as $arg ) : ?>
							'<?= $arg['name'] ?>' => [
								'type' => <?= $arg['type_expr'] ?>,
<?php if ( array_key_exists( 'default', $arg ) ) : ?>
								'defaultValue' => <?= var_export( $arg['default'], true ) ?>,
<?php endif; ?>
<?php if ( ! empty( $arg['description'] ) ) : ?>
								'description' => '<?= addslashes( $arg['description'] ) ?>',
<?php endif; ?>
							],
<?php endforeach; ?>
						],
<?php endif; ?>
<?php if ( ! empty( $field['deprecation_reason'] ) ) : ?>
						'deprecationReason' => '<?= addslashes( $field['deprecation_reason'] ) ?>',
<?php endif; ?>
					],
<?php endforeach; ?>
				],
			]);
		}
		return self::$instance;
	}
}
