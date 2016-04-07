<?php

namespace Draft\Draft;

use League\CommonMark\CommonMarkConverter;
use LogicException;

class Renderer
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
     * Renders a manuscript to a book.
     */
    public function render()
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

        $layoutPath = $this->project->getLayoutPath();

        if (!file_exists($layoutPath)) {
            throw new LogicException("layoutPath missing");
        }

        $layoutContent = file_get_contents($layoutPath);
        $convertedInLayout = str_replace("{{ content }}", $converted, $layoutContent);

        $htmlFile = join(DIRECTORY_SEPARATOR, [$downloadPath, $outputFolder, "book.html"]);

        file_put_contents($htmlFile, $convertedInLayout);
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
