<?php
/**
 * DemopdfCommand
 *
 * This is command demoes how to create a PDF file from the commandline.
 * To use it you can add this to your console.php:
 *
 *  'commandMap' => array(
 *      'demopdf' => array(
 *          'class' => 'ext.pdfable.pdfable.commands.DemopdfCommand',
 *      ),
 *  ),
 *
 * Then call it with ./yiic demopdf.
 *
 * @author Michael Härtl <haertl.mike@gmail.com>
 * @version 1.0.0
 * @license http://www.opensource.org/licenses/MIT
 */
require_once(__DIR__.'/../../PdfFile.php');
class DemopdfCommand extends CConsoleCommand
{
    /**
     * Create a demo PDF and save it to the given filename
     *
     * @param string $filename the filename for the PDF
     */
    public function actionIndex($filename)
    {
        $pdf = new PdfFile;

        // We have to set some paths ...
        $pdf->baseViewPath = Yii::getPathOfAlias('ext.pdfable.pdfable.views');
        $pdf->layoutPath = Yii::getPathOfAlias('ext.pdfable.pdfable.views.layouts');
        $pdf->viewPath = Yii::getPathOfAlias('ext.pdfable.pdfable.views.demo');

        // ... and supply our custom CSS file
        $pdf->setOptions(array(
            'user-style-sheet'  => Yii::getPathOfAlias('ext.pdfable.pdfable.assets.css.pdf').'.css',
        ));

        $pdf->renderPage('invoice');
        $pdf->renderPage('page1');
        $pdf->renderPage('page2');

        $pdf->saveAs($filename);
    }
}
