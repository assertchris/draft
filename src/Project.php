<?php

namespace Draft\Draft;

use InvalidArgumentException;

class Project
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $inputFolder = "manuscript";

    /**
     * @var string
     */
    private $outputFolder = "book";

    /**
     * @var string
     */
    private $downloadPath;

    /**
     * @param string $name
     * @param string $downloadPath
     *
     * @throws InvalidArgumentException
     */
    public function __construct($name, $downloadPath)
    {
        if (!is_string($downloadPath) || file_exists($downloadPath)) {
            throw new InvalidArgumentException("downloadPath is invalid");
        }

        $this->name = $name;
        $this->downloadPath = $downloadPath;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getInputFolder()
    {
        return $this->inputFolder;
    }

    /**
     * @param string $inputFolder
     *
     * @return $this
     */
    public function setInputFolder($inputFolder)
    {
        if (!is_string($inputFolder)) {
            throw new InvalidArgumentException("inputFolder is not a string");
        }

        $this->inputFolder = $inputFolder;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutputFolder()
    {
        return $this->outputFolder;
    }

    /**
     * @param string $outputFolder
     *
     * @return $this
     */
    public function setOutputFolder($outputFolder)
    {
        if (!is_string($outputFolder)) {
            throw new InvalidArgumentException("outputFolder is not a string");
        }

        $this->outputFolder = $outputFolder;

        return $this;
    }

    /**
     * @return string
     */
    public function getDownloadPath()
    {
        return $this->downloadPath;
    }
}