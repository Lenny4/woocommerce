<?php
/**
 * Template for generating the shared PageInfo GraphQL type class.
 *
 * @var string $namespace
 */
?>
<?= '<?php' ?>

declare(strict_types=1);

// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.

namespace <?= $namespace ?>;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class PageInfo {
	private static ?ObjectType $instance = null;

	public static function get(): ObjectType {
		if (self::$instance === null) {
			self::$instance = new ObjectType([
				'name' => 'PageInfo',
				'fields' => [
					'has_next_page' => [
						'type' => Type::nonNull(Type::boolean()),
					],
					'has_previous_page' => [
						'type' => Type::nonNull(Type::boolean()),
					],
					'start_cursor' => [
						'type' => Type::string(),
					],
					'end_cursor' => [
						'type' => Type::string(),
					],
				],
			]);
		}
		return self::$instance;
	}
}
