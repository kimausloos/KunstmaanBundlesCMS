<?php

namespace Kunstmaan\AdminListBundle\Tests\Service;

use Kunstmaan\AdminListBundle\Service\ExportService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-03-19 at 09:56:53.
 */
class ExportServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExportService
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ExportService;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Kunstmaan\AdminListBundle\Service\ExportService::getSupportedExtensions
     */
    public function testGetSupportedExtensions()
    {
        $extensions = ExportService::getSupportedExtensions();
        $this->assertEquals(array('Csv' => 'csv', 'Excel' => 'xlsx'), $extensions);
    }

    /**
     * @covers Kunstmaan\AdminListBundle\Service\ExportService::getDownloadableResponse
     * @todo   Implement testGetDownloadableResponse().
     */
    public function testGetDownloadableResponse()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @dataProvider createFromTemplateProvider
     *
     * @covers Kunstmaan\AdminListBundle\Service\ExportService::createFromTemplate
     * @covers Kunstmaan\AdminListBundle\Service\ExportService::setRenderer
     */
    public function testCreateFromTemplate($template = null)
    {
        $adminList = $this->getMock('Kunstmaan\AdminListBundle\AdminList\ExportableInterface');
        $iterator = $this->getMock('\Iterator');
        $adminList->expects($this->once())->method('getIterator')->willReturn($iterator);

        $templateName = is_null($template) ? 'KunstmaanAdminListBundle:Default:export.csv.twig' : $template;
        $renderer = $this->getMock('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface');
        $renderer->expects($this->once())
            ->method('render')
            ->with($templateName,
                array(
                    'iterator'    => $iterator,
                    'adminlist'   => $adminList,
                    'queryparams' => array()
                )
            );

        $this->object->setRenderer($renderer);
        $this->object->createFromTemplate($adminList, ExportService::EXT_CSV, $template);
    }

    public function createFromTemplateProvider()
    {
        return array(
            array(null),
            array('MyBundle:Default:export.csv.twig'),
        );
    }

    /**
     * @covers Kunstmaan\AdminListBundle\Service\ExportService::createExcelSheet
     * @todo   Implement testCreateExcelSheet().
     */
    public function testCreateExcelSheet()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Kunstmaan\AdminListBundle\Service\ExportService::createResponse
     */
    public function testCreateResponse()
    {
        $response = $this->object->createResponse('content', ExportService::EXT_CSV);
        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
    }

    /**
     * @covers Kunstmaan\AdminListBundle\Service\ExportService::createResponseForExcel
     */
    public function testCreateResponseForExcel()
    {
        $writer = $this->getMock('\PHPExcel_Writer_IWriter');
        $response = $this->object->createResponseForExcel($writer);
        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
    }
}
