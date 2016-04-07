<?php

namespace Draft\Draft\Converter;

use Draft\Draft\Project;
use LogicException;
use Symfony\Component\DomCrawler\Crawler;

class EPub
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
        $ePubFolder = join(DIRECTORY_SEPARATOR, [$downloadPath, $outputFolder, "book.epub"]);

        if (!file_exists($htmlFile)) {
            throw new LogicException("htmlFile missing");
        }

        $mimeTypeFile = join(DIRECTORY_SEPARATOR, [$ePubFolder, "mimetype"]);

        mkdir($ePubFolder, $mode = 0777, $recursive = true);
        file_put_contents($mimeTypeFile, "application/epub+zip");

        $htmlContent = file_get_contents($htmlFile);

        $crawler = new Crawler($htmlContent);

        $headings = [];

        $crawler = $crawler
            ->filter("h1")
            ->each(function(Crawler $node) use (&$headings) {
                $headings[] = $node->text();
            });
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
