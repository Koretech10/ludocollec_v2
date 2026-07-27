<?php

$finder = new PhpCsFixer\Finder()
    ->in(__DIR__)
    ->exclude('var')
;

return new PhpCsFixer\Config()
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'align_multiline_comment' => true,
        'compact_nullable_type_declaration' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'phpdoc_to_comment' => ['ignored_tags' => ['var', 'phpstan-ignore']],
    ])
    ->setFinder($finder)
;
