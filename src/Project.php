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
     * @var string
     */
    private $layoutPath;

    /**
     * @param string $name
     * @param string $downloadPath
     * @param string $layoutPath
     *
     * @throws InvalidArgumentException
     */
    public function __construct($name, $downloadPath, $layoutPath)
    {
        if (!is_string($downloadPath)) {
            throw new InvalidArgumentException("downloadPath is not a string");
        }

        $this->name = $name;
        $this->downloadPath = $downloadPath;
        $this->layoutPath = $layoutPath;
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

    /**
     * @return string
     */
    public function getLayoutPath()
    {
        return $this->layoutPath;
    }
}
