<?php
/*The MIT License (MIT)

Copyright (c) 2015 James Miranda

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.*/
namespace Parser;

use DOMDocument;

/**
 * Class XMLParser
 * Get the XML from a file or string and creates a DOMDocument
 * @author James Miranda <jameswpm@gmail.com>
 * @package Parser
 * @license Copyright (c) 2015 James Miranda with MIT License
 */
class XMLParser extends DOMDocument
{
	/**
	 * @var string|array $namespaces The namespaces of the Document
	 */
	private $namespaces;
	/**
	 * @var string $xsdToValidate File or directory with XSD to validate the document
	 */
	protected $xsdToValidate;


	/**
     * Method __construct
     * Creates a DomDocument and set preserveWhiteSpace to false
     * @author James Miranda <jameswpm@gmail.com>
     * @param string $version
     * @param string $encoding
     */
    public function __construct ($version = null, $encoding = null)
    {
        parent::__construct($version, $encoding);
        $this->preserveWhiteSpace = false;
		$this->formatOutput = true;
    }

    /**
     * Method setXsdToValidate
     * Sets a XSD file or Directory with multiple XSDs to made the validation
     * @author James Miranda <jameswpm@gmail.com>
     * @param string $xsdFileOrDir
     */
    public setXsdToValidate ($xsdFileOrDir)
    {
        if (!file_exists($xsdFileOrDir)) {
            throw new Exception("Invalid File or Directory. XSD not found");            
        }
        $this->xsdToValidate = $xsdFileOrDir;
    }

    /**
     * Method validateXML
     * Validate the XML against a XSD
     * @author James Miranda <jameswpm@gmail.com>
     * @param string $xsdToValidateFilename represents the file in the $this->xsdToValidate. Defaul is null
     * @throws Exception
     */
    public validateXML($xsdToValidateFilename = null) 
    {
        if (is_dir($this->xsdToValidate) && is_null($xsdToValidateFilename)) {
            throw new Exception ('The default validation is a directory. Please, set a file to validate');
        }

        if (is_dir($this->xsdToValidate)){
            if (!$this->schemaValidate($this->xsdToValidate . DIRECTORY_SEPARATOR . $xsdToValidateFilename)) {
                $exception = new Exception ('The XML sent is invalid. Does note fill the XSD standards');
                /*foreach(libxml_get_errors() as $error){
                    $exception->setError($error->message);
                }*/
                throw $exception;
            }
        }

        if (is_file($this->xsdToValidate)) {
            if (!$this->schemaValidate($this->xsdToValidate)) {
                $exception = new Exception ('The XML sent is invalid. Does note fill the XSD standards');
                /*foreach(libxml_get_errors() as $error){
                    $exception->setError($error->message);
                }*/
                throw $exception;
            }
        }
    }

}