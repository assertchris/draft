<?php

namespace Draft\Draft;

class Downloader
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
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Downloads project files to a local path.
     */
    public function download()
    {
        $name = $this->project->getName();
        $downloadPath = $this->project->getDownloadPath();
        $verbose = $this->getVerboseString();

        mkdir($downloadPath, $mode = 0777, $recursive = true);
        chdir($downloadPath);

        exec(sprintf("git clone git@github.com:%s.git . %s", $name, $verbose));
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
