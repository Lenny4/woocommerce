<?php
/**
 * Template for generating the FieldArgumentExtractor helper class.
 *
 * @var string $namespace
 */
?>
<?= '<?php' ?>

declare(strict_types=1);

// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.

namespace <?= $namespace ?>;

use GraphQL\Language\AST\SelectionSetNode;
use GraphQL\Language\AST\FieldNode;
use GraphQL\Language\AST\ArgumentNode;

class FieldArgumentExtractor {
	public static function extract(?SelectionSetNode $selectionSet, array $variableValues): ?array {
		if ($selectionSet === null) {
			return null;
		}

		$result = [];

		foreach ($selectionSet->selections as $selection) {
			if (!($selection instanceof FieldNode)) {
				continue;
			}

			$field_name = $selection->name->value;
			$entry = [];

			if (!empty($selection->arguments)) {
				foreach ($selection->arguments as $arg) {
					$entry[$arg->name->value] = self::resolveArgumentValue($arg, $variableValues);
				}
			}

			if ($selection->selectionSet !== null) {
				$sub_args = self::extract($selection->selectionSet, $variableValues);
				if ($sub_args !== null) {
					$entry['_item'] = $sub_args;
				}
			}

			if (!empty($entry)) {
				$result[$field_name] = $entry;
			}
		}

		return empty($result) ? null : $result;
	}

	private static function resolveArgumentValue(ArgumentNode $arg, array $variableValues): mixed {
		$value_node = $arg->value;

		if ($value_node instanceof \GraphQL\Language\AST\VariableNode) {
			return $variableValues[$value_node->name->value] ?? null;
		}

		return \GraphQL\Utils\AST::valueFromAST($value_node, null, $variableValues);
	}
}
