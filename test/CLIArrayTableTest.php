<?php

class CLIArrayTableTest extends PHPUnit_Framework_TestCase {

    private $arrayTable;

    public function setUp() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar'], ['foo' => 'baz']]);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty array argument.
     */
    public function testException_EmptyArrayConstructorArg() {
        new \SMSApplication\CLIArrayTable([]);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty 2D array argument.
     */
    public function testException_InvalidConstructorArgs() {
        new \SMSApplication\CLIArrayTable([[], []]);
    }

    //test that output is a string
    public function testToString() {
        $this->assertTrue(is_string($this->arrayTable->toString()));
    }

    //assert correct representation of array as a string
    public function testToString_RightFormat() {
        $this->arrayTable->toString(0);
        $this->arrayTable->setHeaderSeparator(".");
        $this->arrayTable->setRowNumbersColSeparator("|");
        $this->arrayTable->setCellSeparator("|");
        $strOutput = " |foo|\n.|...|\n";
        $strOutput .= "0|bar|\n.|...|\n";
        $strOutput .= "1|baz|\n.|...|\n";
        $this->assertEquals($this->arrayTable->toString(), $strOutput);
    }

    /**
     * @expectedException \Exception
     */
    public function testToString_RightFormatCase2() {
        new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'baz' => 'foobar'], ['baz' => 'foobar']]);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty array argument.
     */
    public function testException_NonArrayArgs() {
        new \SMSApplication\CLIArrayTable('bar');
    }

    /**
     * @expectedException Exception
     */
    public function testException_MoreThan2DArrayArgs() {
        new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'foo' => 'baz', ['foo' => 'bar', 'foo' => 'baz']]]);
    }

    /**
     * @expectedException Exception
     */
    public function testSetHeaderSeparator() {
        $this->arrayTable->setHeaderSeparator('...');
    }

    /**
     * @expectedException Exception
     */
    public function testSetRowNumbersColSeparator() {
        $this->arrayTable->setRowNumbersColSeparator('|||');
    }

    /**
     * @expectedException Exception
     */
    public function testSetCellSeparator() {
        $this->arrayTable->setCellSeparator(2);
    }

}
