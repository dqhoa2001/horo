<?php

namespace App\Library;

class CompileTemplate
{
    /**
     * Templatesテーブルから取得したメールテンプレートををコンパイルする
     */
    public static function compileTemplate(string $template, array $data): string
    {
        $compiled = \Blade::compileString($template);

        // 出力バッファリングを開始し、変数をインポートしてコンパイル済みテンプレートを取得
        extract($data);
        ob_start();
        eval('?>' . $compiled . '<?php ');
        $renderedTemplate = ob_get_clean();

        // 改行コードを <br> タグに置き換える
        $compiledData = nl2br($renderedTemplate);
        return $compiledData;
    }

    /**
     * Templatesテーブルから取得したメールテンプレートををコンパイルする（フッター付き）
     */
    public static function compileTemplateWithFooter(string $template, string $footerTemplate, array $data): string
    {
        // テンプレートとフッターテンプレートを結合
        $newTemplate = $template . $footerTemplate;
        $compiled = \Blade::compileString($newTemplate);

        // 出力バッファリングを開始し、変数をインポートしてコンパイル済みテンプレートを取得
        extract($data);
        ob_start();
        eval('?>' . $compiled . '<?php ');
        $renderedTemplate = ob_get_clean();

        // 改行コードを <br> タグに置き換える
        $compiledData = nl2br($renderedTemplate);
        return $compiledData;
    }
}
