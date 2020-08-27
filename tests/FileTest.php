<?php

use PHPUnit\Framework\TestCase;
use Utils\File;

class FileTest extends TestCase
{
    public function testInstance() {
        $file = new File('oneFile.txt');
        $this->assertInstanceOf(File::class, $file);
    }

    public function testGetFile() {
        touch('unFichier.txt');
        $file = File::getFile('unFichier.txt');
        $this->assertInstanceOf(File::class, $file);
        unlink('unFichier.txt');

        $file = File::getFile('unMauvaisFichier.txt');
        $this->assertFalse($file);

    }

    public function testGetFileContent() {
        $fileName = 'unFichier.txt';
        $file = fopen($fileName, 'w');
        fwrite($file, "Hello world");
        $fileContent = File::getFileContent($fileName);
        fclose($file);
        $this->assertEquals("Hello world", $fileContent);
        unlink($fileName);
        $this->expectException(Exception::class);
        File::getFileContent($fileName);
    }

    public function testExists() {
        $fileName = 'unFichier.txt';

        $file = fopen($fileName, 'w');
        fwrite($file, "Hello world");
        fclose($file);
        $this->assertTrue(File::exists($fileName));
        unlink($fileName);

        $this->expectException(Exception::class);
        File::exists('unMauvaisFichier.txt');
    }

    

}

