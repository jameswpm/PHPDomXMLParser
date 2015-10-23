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
 */
class XMLParser extends DOMDocument
{
	/**
	 * @var string $namespaces The namespaces of the Document
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
            throw new Exception("Invalid File or Directory. XSD not found", 1);            
        }
        $this->xsdToValidate = $xsdFileOrDir;
    }

}