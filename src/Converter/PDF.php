<?php

namespace Draft\Draft\Converter;

use Draft\Draft\Project;
use LogicException;

class PDF
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @var bool
     */
    private $verbose = false;

    /**
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Converts an HTML file to a PDF file.
     */
    public function convert()
    {
        $verbose = $this->getVerboseString();

        $downloadPath = $this->project->getDownloadPath();
        $outputFolder = $this->project->getOutputFolder();

        $htmlFile = join(DIRECTORY_SEPARATOR, [$downloadPath, $outputFolder, "book.html"]);
        $pdfFile = join(DIRECTORY_SEPARATOR, [$downloadPath, $outputFolder, "book.pdf"]);

        if (!file_exists($htmlFile)) {
            throw new LogicException("htmlFile missing");
        }

        exec(sprintf("prince %s -o %s %s", $htmlFile, $pdfFile, $verbose));
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param bool $verbose
     *
     * @return $this
     */
    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;

        return $this;
    }

    /**
     * @return string
     */
    private function getVerboseString()
    {
        if ($this->verbose) {
            return "";
        }

        return " 2> /dev/null";
    }
}
