<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$rules = [
    /*
     * General Standards.
     */
    '@PSR1' => true,
    '@PSR2' => true,
    '@PSR12' => true,

    /*
     * Generic Rules.
     */
    'array_syntax' => ['syntax' => 'short'],
    'blank_line_after_namespace' => true,
    'blank_line_after_opening_tag' => true,
    'braces' => true,
    'cast_spaces' => true,
    'concat_space' => [
        'spacing' => 'none',
    ],
    'declare_equal_normalize' => true,
    'elseif' => true,
    'encoding' => true,
    'full_opening_tag' => true,
    'fully_qualified_strict_types' => true, // added by Shift
    'function_declaration' => true,
    'function_typehint_space' => true,
    'heredoc_to_nowdoc' => true,
    'include' => true,
    'increment_style' => ['style' => 'post'],
    'indentation_type' => true,
    'linebreak_after_opening_tag' => true,
    'line_ending' => true,
    'lowercase_cast' => true,
    'lowercase_keywords' => true,
    'lowercase_static_reference' => true, // added from Symfony
    'magic_method_casing' => true, // added from Symfony
    'magic_constant_casing' => true,
    'method_argument_space' => true,
    'native_function_casing' => true,
    'no_alias_functions' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            'extra',
            'throw',
            'use',
            'use_trait',
        ],
    ],
    'no_blank_lines_after_class_opening' => true,
    'no_blank_lines_after_phpdoc' => true,
    'no_closing_tag' => true,
    'no_unused_imports' => true,
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_leading_import_slash' => true,
    'no_leading_namespace_whitespace' => true,
    'no_mixed_echo_print' => [
        'use' => 'echo',
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'no_short_bool_cast' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'no_spaces_after_function_name' => true,
    'no_spaces_inside_parenthesis' => true,
    'no_trailing_comma_in_list_call' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_trailing_whitespace' => true,
    'no_trailing_whitespace_in_comment' => true,
    'no_unreachable_default_argument_value' => true,
    'no_useless_return' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_whitespace_in_blank_line' => true,
    'normalize_index_brace' => true,
    /*
     * Logical NOT operators (!) should have one trailing whitespace. This fixer is not configurable.
     *
     * @link https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0|fixer:not_operator_with_successor_space
     */
    'not_operator_with_successor_space' => true,
    'object_operator_without_whitespace' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_scalar' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    /*
     * Annotations in PHPDoc should be grouped together so that annotations of the same type immediately follow each other, and annotations of a different type are separated by a single blank line.
     *
     * @link https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0|fixer:phpdoc_separation
     */
    'phpdoc_separation' => true,
    /*
     * All items of the given phpdoc tags must be either left-aligned or (by default) aligned vertically.
     *
     * @link https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0|fixer:phpdoc_align
     */
    'phpdoc_align' => ['align' => 'left'],
    /*
     * All instances created with new keyword must be followed by braces.
     *
     * @link https://mlocati.github.io/php-cs-fixer-configurator/#version:3.38|fixer:new_with_parentheses
     */
    'new_with_parentheses' => [
        'anonymous_class' => false,
        'named_class' => false,
    ],
    /*
     * Docblocks should only be used on structural elements. This fixer is not configurable.
     *
     * @link https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0|fixer:phpdoc_to_comment
     */
    'phpdoc_to_comment' => false,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'self_accessor' => true,
    'short_scalar_cast' => true,
    'simplified_null_return' => false, // disabled by Shift
    'single_blank_line_at_eof' => true,
    'blank_lines_before_namespace' => true,
    'single_import_per_statement' => true,
    'single_line_after_imports' => true,
    'single_line_comment_style' => [
        'comment_types' => ['hash'],
    ],
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_not_equals' => true,
    'switch_case_semicolon_to_colon' => true,
    'switch_case_space' => true,
    'ternary_operator_spaces' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'whitespace_after_comma_in_array' => true,

    // php-cs-fixer 3: Renamed rules
    'constant_case' => ['case' => 'lower'],
    'general_phpdoc_tag_rename' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_tag_type' => true,
    'psr_autoloading' => true,
    'trailing_comma_in_multiline' => ['elements' => ['arrays']],

    // php-cs-fixer 3: Changed options
    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => ['=>' => null],
    ],
    'blank_line_before_statement' => [
        'statements' => ['return'],
    ],
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'one',
            'method' => 'one',
            'property' => 'one',
        ],
    ],
    'class_definition' => [
        'multi_line_extends_each_single_line' => true,
        'single_item_single_line' => true,
        'single_line' => true,
    ],
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
    ],

    // php-cs-fixer 3: Removed rootless options (*)
    'no_unneeded_control_parentheses' => [
        'statements' => ['break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield'],
    ],
    'no_spaces_around_offset' => [
        'positions' => ['inside', 'outside'],
    ],
    'visibility_required' => [
        'elements' => ['property', 'method', 'const'],
    ],
    /*
     * Add leading \ before function invocation to speed up resolving.
     *
     * @link https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0|fixer:native_function_invocation
     */
    'native_function_invocation' => [
        'exclude' => [],
        // 'include' => [NativeFunctionInvocationFixer::SET_COMPILER_OPTIMIZED],
        'include' => [NativeFunctionInvocationFixer::SET_ALL],
        'scope' => 'namespaced',
        'strict' => true,
    ],
];

$projectPath = __DIR__;

$finder = Finder::create()
    ->in([
        "{$projectPath}/app",
        "{$projectPath}/config",
        "{$projectPath}/database",
        "{$projectPath}/resources",
        "{$projectPath}/routes",
        "{$projectPath}/tests",
    ])
    ->exclude([
        "{$projectPath}/bootstrap",
        "{$projectPath}/public",
        "{$projectPath}/storage",
        "{$projectPath}/vendor",
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config)
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setUsingCache(false);
