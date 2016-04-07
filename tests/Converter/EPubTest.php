<?php

namespace Draft\Draft\Test\Converter;
use Draft\Draft\Converter\EPub;
use Draft\Draft\Project;
use Draft\Draft\Renderer;
use Draft\Draft\Test\Test;

/**
 * @covers Draft\Draft\Converter\EPub
 */
class EPubTest extends Test
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
    private $ePubPath = __DIR__ . "/../downloads/assertchris/sample/book/book.epub";

    /**
     * @test
     */
    public function itConvertsToEPub()
    {
//        $project = new Project($this->name, $this->downloadPath, $this->layoutPath);
//
//        $renderer = new Renderer($project);
//        $renderer->render();
//
//        $converter = new EPub($project);
//        $converter->convert();
//
//        $this->assertFileExists($this->pdfPath);

        $this->markTestIncomplete("ePub is a pain");
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->ePubPath)) {
//            exec(sprintf("rm %s", $this->ePubPath));
        }
    }
}
