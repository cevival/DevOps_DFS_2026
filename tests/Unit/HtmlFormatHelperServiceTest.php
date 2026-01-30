<?php

namespace Tests\Unit;
use App\Services\HtmlFormatHelperService;
use App\Services\StackCantBeEmptyException;
use PHPUnit\Framework\TestCase;

class HtmlFormatHelperServiceTest extends TestCase
{
    private HtmlFormatHelperService $service;

    protected function setUp(): void
    {
        $this->service = new HtmlFormatHelperService();
    }

    public function testGetBoldFormat_WrapsContentInBoldTags(): void
    {
        $content = "Test";
        $expected = "<b>Test</b>";
        $this->assertEquals($expected, $this->service->getBoldFormat($content));
    }

    public function testGetBoldFormat_EmptyStringReturnsBoldTags(): void
    {
        $content = "";
        $expected = "<b></b>";
        $this->assertEquals($expected, $this->service->getBoldFormat($content));
    }

        public function testGetBoldFormat_Null_ThrowsTypeError(): void
    {
        $this->expectException(\TypeError::class);
        $this->service->getBoldFormat(null);
    }

    public function testGetItalicFormat_WrapsContentInItalicTags(): void
    {
        $content = "Test";
        $expected = "<i>Test</i>";
        $this->assertEquals($expected, $this->service->getItalicFormat($content));
    }

    public function testGetItalicFormat_EmptyStringReturnsItalicTags(): void
    {
        $content = "";
        $expected = "<i></i>";
        $this->assertEquals($expected, $this->service->getItalicFormat($content));
    }

    public function testGetFormattedListElements_CreatesUnorderedList(): void
    {
        $contents = ["Item 1", "Item 2", "Item 3"];
        $expected = "<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>";
        $this->assertEquals($expected, $this->service->getFormattedListElements($contents));
    }
    public function testGetFormattedListElements_EmptyArrayReturnsEmptyList(): void
    {
        $contents = [];
        $expected = "<ul></ul>";
        $this->assertEquals($expected, $this->service->getFormattedListElements($contents));
    }
    public function testGetFormattedListElements_SpecialCharactersAreHandled(): void
    {
        $contents = ["<Item 1>", "&Item 2&", "\"Item 3\""];
        $expected = "<ul><li><Item 1></li><li>&Item 2&</li><li>\"Item 3\"</li></ul>";
        $this->assertEquals($expected, $this->service->getFormattedListElements($contents));
    }

    public function testGetFormattedListElements_NonArray_ThrowsTypeError(): void
    {
        $this->expectException(\TypeError::class);
        $this->service->getFormattedListElements('not-an-array');
    }
}