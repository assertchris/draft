<?php

namespace Draft\Draft\Test;

use Draft\Draft\Downloader;
use Draft\Draft\Project;

/**
 * @covers Draft\Draft\Downloader
 */
class DownloaderTest extends Test
{
    /**
     * @var string
     */
    private $name = "assertchris/draft";

    /**
     * @var string
     */
    private $downloadPath = __DIR__ . "/downloads/assertchris/draft";

    /**
     * @test
     */
    public function itDownloadsProjects()
    {
        $project = new Project($this->name, $this->downloadPath);

        $downloader = new Downloader($project);
        $downloader->download();

        $this->assertFileExists($this->downloadPath);
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->downloadPath)) {
            exec(sprintf("rm -rf %s", $this->downloadPath));
        }
    }
}
