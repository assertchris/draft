<?php

namespace Draft\Draft;

use League\CommonMark\CommonMarkConverter;
use LogicException;

class Converter
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Converts a manuscript to a book.
     */
    public function convert()
    {
        $downloadPath = $this->project->getDownloadPath();
        $inputFolder = $this->project->getInputFolder();
        $outputFolder = $this->project->getOutputFolder();

        $bookFile = join(DIRECTORY_SEPARATOR, [$downloadPath, $inputFolder, "book.txt"]);

        if (!file_exists($bookFile)) {
            throw new LogicException("bookFile missing");
        }

        $unconverted = "";
        $bookFileLines = file($bookFile);

        foreach ($bookFileLines as $next) {
            $next = trim($next);
            $nextPath = join(DIRECTORY_SEPARATOR, [$downloadPath, $inputFolder, $next]);

            if (file_exists($nextPath)) {
                $unconverted .= file_get_contents($nextPath);
            }
        }

        $converter = new CommonMarkConverter();
        $converted = $converter->convertToHtml($unconverted);

        $htmlFile = join(DIRECTORY_SEPARATOR, [$downloadPath, $outputFolder, "book.html"]);

        file_put_contents($htmlFile, $converted);
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
