<?php


use PeepSea\Images;
use PeepSea\ImagesCreationException;
use PHPUnit\Framework\TestCase;

class ImagesTest extends TestCase
{
    public function testItThrowsImagesCreationException()
    {
        $this->expectException(ImagesCreationException::class);

        new Images([1, 'abc', []]);
    }
}
