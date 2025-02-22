<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__) // プロジェクト全体を対象
    ->exclude(['vendor', 'storage', 'node_modules']) // 除外するディレクトリ
    ->name('*.php'); // PHPファイルのみ対象

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true, // PSR-12 に準拠
        'array_syntax' => ['syntax' => 'short'], // 配列を `[]` に統一
        'binary_operator_spaces' => ['default' => 'single_space'], // 演算子周りのスペース調整
        'blank_line_after_namespace' => true, // namespace の後に空行を入れる
        'blank_line_after_opening_tag' => true, // PHPの開始タグの後に空行を入れる
        'blank_line_before_statement' => [
            'statements' => ['return']
        ], // return の前に空行を入れる
        'braces' => ['allow_single_line_closure' => true], // 中括弧のスタイル調整
        'concat_space' => ['spacing' => 'one'], // 文字列結合のスペース調整
        'declare_strict_types' => false, // `declare(strict_types=1);` を強制しない
        'no_unused_imports' => true, // 使われていない `use` を削除
        'single_quote' => true, // 文字列は `''` を推奨
        'trailing_comma_in_multiline' => ['elements' => ['arrays']], // 配列の最後に `,` を追加
    ])
    ->setFinder($finder);
