<?php

namespace Draft\Draft\Test;

use Draft\Draft\Project;
use Draft\Draft\Renderer;

/**
 * @covers Draft\Draft\Renderer
 */
class RendererTest extends Test
{
    /**
     * @var string
     */
    private $name = "assertchris/sample";

    /**
     * @var string
     */
    private $downloadPath = __DIR__ . "/downloads/assertchris/sample";

    /**
     * @var string
     */
    private $layoutPath = __DIR__ . "/../resources/templates/layout.html";

    /**
     * @var string
     */
    private $htmlPath = __DIR__ . "/downloads/assertchris/sample/book/book.html";

    /**
     * @test
     */
    public function itConvertsProjects()
    {
        $project = new Project($this->name, $this->downloadPath, $this->layoutPath);

        $renderer = new Renderer($project);
        $renderer->render();

        $this->assertFileExists($this->htmlPath);

        $htmlContents = file_get_contents($this->htmlPath);

        $this->assertContains("<h1>Chapter 1</h1>", $htmlContents);
        $this->assertContains("<p>This is the first chapter</p>", $htmlContents);
        $this->assertContains("<h1>Chapter 2</h1>", $htmlContents);
        $this->assertContains("<p>This is the second chapter</p>", $htmlContents);
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->htmlPath)) {
            exec(sprintf("rm %s", $this->htmlPath));
        }
    }
}
