<?php

namespace Draft\Draft\Test\Converter;

use Draft\Draft\Converter\Mobi;
use Draft\Draft\Project;
use Draft\Draft\Renderer;
use Draft\Draft\Test\Test;

/**
 * @covers Draft\Draft\Converter\Mobi
 */
class MobiTest extends Test
{
    /**
     * @var string
     */
    private $name = "assertchris/sample";

    /**
     * @var string
     */
    private $downloadPath = __DIR__ . "/../downloads/assertchris/sample";

    /**
     * @var string
     */
    private $layoutPath = __DIR__ . "/../../resources/templates/layout.html";

    /**
     * @var string
     */
    private $pdfPath = __DIR__ . "/../downloads/assertchris/sample/book/book.mobi";

    /**
     * @test
     */
    public function itConvertsToMobi()
    {
        $project = new Project($this->name, $this->downloadPath, $this->layoutPath);

        $renderer = new Renderer($project);
        $renderer->render();

        $converter = new Mobi($project);
        $converter->setVerbose($verbose = true);
        $converter->convert();

//        $this->assertFileExists($this->pdfPath);
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->pdfPath)) {
//            exec(sprintf("rm %s", $this->pdfPath));
        }
    }
}
