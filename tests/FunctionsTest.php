<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testHtmlImg()
    {
        $result = html_img(
            [
                'src' => 'https://example.com',
                'alt' => '"Test"',
            ]
        );

        $this->assertEquals('<img src="https://example.com" alt="&quot;Test&quot;">', $result);
    }
}
