<?php

namespace App\Services;

class HtmlFormatHelperService
{
    public function getBoldFormat(string $content): string
    {
        return "<b>{$content}</b>";
    }

    public function getItalicFormat(string $content): string
    {
        return "<i>{$content}</i>";
    }

    public function getFormattedListElements(array $contents): string
    {
        $htmlList = "<ul>";

        foreach ($contents as $content) {
            $htmlList .= "<li>{$content}</li>";
        }

        $htmlList .= "</ul>";
        
        return $htmlList;
    }
}
