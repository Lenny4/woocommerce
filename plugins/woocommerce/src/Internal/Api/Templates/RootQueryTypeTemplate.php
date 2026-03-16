<?php
/**
 * Template for generating the RootQueryType class.
 *
 * @var string $namespace
 * @var array  $queries - each: ['class_name', 'fqcn', 'graphql_name']
 */
?>
<?= '<?php' ?>

declare(strict_types=1);

// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.

namespace <?= $namespace ?>;

<?php foreach ( $queries as $query ) : ?>
use <?= $query['fqcn'] ?>;
<?php endforeach; ?>
use GraphQL\Type\Definition\ObjectType;

class RootQueryType {
	private static ?ObjectType $instance = null;

	public static function get(): ObjectType {
		if (self::$instance === null) {
			self::$instance = new ObjectType([
				'name' => 'Query',
				'fields' => fn() => [
<?php foreach ( $queries as $query ) : ?>
					'<?= $query['graphql_name'] ?>' => <?= $query['class_name'] ?>::getFieldDefinition(),
<?php endforeach; ?>
				],
			]);
		}
		return self::$instance;
	}
}
