<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->name('*.php')
    ->exclude('vendor'); // Exclude vendor directory

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR12' => true, // Use PSR-12 as the base standard
        'indentation_type' => true, // Ensure spaces (4 spaces) for indentation
        'braces' => [
            'position_after_functions_and_oop_constructs' => 'same', // K&R brace style: opening brace on the same line
        ],
        'no_trailing_whitespace' => true, // Remove trailing whitespace
        'single_quote' => true, // Enforce single quotes wherever possible
        'array_syntax' => ['syntax' => 'short'], // Use short array syntax ([])
        'blank_line_after_opening_tag' => true, // Ensure a blank line after PHP opening tag
        'no_extra_blank_lines' => true, // Remove extra blank lines
    ])
    ->setFinder($finder);
