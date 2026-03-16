<?php
/**
 * Template for generating the RootMutationType class.
 *
 * @var string $namespace
 * @var array  $mutations - each: ['class_name', 'fqcn', 'graphql_name']
 */
?>
<?= '<?php' ?>

declare(strict_types=1);

// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.

namespace <?= $namespace ?>;

<?php foreach ( $mutations as $mutation ) : ?>
use <?= $mutation['fqcn'] ?>;
<?php endforeach; ?>
use GraphQL\Type\Definition\ObjectType;

class RootMutationType {
	private static ?ObjectType $instance = null;

	public static function get(): ObjectType {
		if (self::$instance === null) {
			self::$instance = new ObjectType([
				'name' => 'Mutation',
				'fields' => fn() => [
<?php foreach ( $mutations as $mutation ) : ?>
					'<?= $mutation['graphql_name'] ?>' => <?= $mutation['class_name'] ?>::getFieldDefinition(),
<?php endforeach; ?>
				],
			]);
		}
		return self::$instance;
	}
}
