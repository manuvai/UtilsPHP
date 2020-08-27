<?php

namespace Utils;

use Exception;

class File {

    private $fileName;
    private $content;

    public function __construct($fileName, $content = '')
    {
        $this->fileName = $fileName;
        $this->content = $content;
    }

    public static function getFile($path) {
        try {
            $content = self::getFileContent($path);

        } catch (Exception $e) {
            return false;
        }

        return new self($path, $content);
        
    }

    public function write() {
        $file = fopen($this->fileName, 'w');
        fwrite($file, $this->content);
        fclose($this->fileName);
    }

    public static function getFileContent($path) {

        if (!self::exists($path)) {
            $dirname = __DIR__;
            throw new Exception("File $path not found in $dirname");
        }

        $content = file_get_contents($path);

        return $content;
    }

    public static function exists($path) {
        return file_exists($path);
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
}

