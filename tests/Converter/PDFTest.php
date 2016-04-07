<?php

namespace Draft\Draft\Test\Converter;
use Draft\Draft\Converter\PDF;
use Draft\Draft\Project;
use Draft\Draft\Renderer;
use Draft\Draft\Test\Test;

/**
 * @covers Draft\Draft\Converter\PDF
 */
class PDFTest extends Test
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
    private $pdfPath = __DIR__ . "/../downloads/assertchris/sample/book/book.pdf";

    /**
     * @test
     */
    public function itConvertsToPDF()
    {
        $project = new Project($this->name, $this->downloadPath);

        $renderer = new Renderer($project);
        $renderer->render();

        $converter = new PDF($project);
        $converter->convert();

        $this->assertFileExists($this->pdfPath);
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->pdfPath)) {
            exec(sprintf("rm %s", $this->pdfPath));
        }
    }
}
