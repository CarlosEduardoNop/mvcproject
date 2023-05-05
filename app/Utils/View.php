<?php

namespace App\Utils;

use Exception;

class View
{
    const PAGE_PATH = __DIR__ . '/../../resources/View/page.html';
    const HEADER_PATH = __DIR__ . '/../../resources/View/header.html';
    const FOOTER_PATH = __DIR__ . '/../../resources/View/footer.html';

    /**
     * Render view file
     * @throws Exception
     */
    public static function render(string $view, $vars = [], string $title): string
    {
        $contentView = self::getViewContent($view);

        if (! $contentView) {
            throw new Exception('View file not found!');
        }

        return self::mountPage($vars, $title, $contentView);
    }

    private static function mountPage(array $vars, string $title, $contentView): string
    {
        $pageView = self::mountHeaderAndFooter($vars, $contentView);
        $vars['content'] = self::replaceContentVars($vars, $contentView);
        $vars['title'] = $title;

        return self::replaceContentVars($vars, $pageView);
    }

    private static function getViewContent(string $view): string
    {
        $file = __DIR__ . "/../../resources/View/Pages/{$view}.html";

        return file_exists($file) ? file_get_contents($file) : '';
    }

    private static function replaceContentVars(array $vars, string $contentView): string
    {
        $keys = array_keys($vars);
        $keys = array_map(function($var) {
            return '{{!!$'. $var .'!!}}';
        }, $keys);

        return str_replace($keys, array_values($vars), $contentView);
    }

    private static function mountHeaderAndFooter($vars, $contentView)
    {
        $header = file_exists(self::HEADER_PATH) ? file_get_contents(self::HEADER_PATH) : '';
        $footer = file_exists(self::FOOTER_PATH) ? file_get_contents(self::FOOTER_PATH) : '';
        $contentView = file_get_contents(self::PAGE_PATH);
        $contentPos = strpos($contentView, '{{!!$content!!}}');

        if (! $header && ! $footer) {
            return $contentView;
        }

        if ($header) {
            $contentView = substr_replace($contentView, $header, $contentPos, 0);
            $contentPos = strpos($contentView, '{{!!$content!!}}');
        }

        if ($footer) {
            $contentView = substr_replace($contentView, $footer, $contentPos + strlen('{{!!$content!!}}'), 0);
        }

        return $contentView;
    }
}