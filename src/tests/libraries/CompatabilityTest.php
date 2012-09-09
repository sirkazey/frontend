<?php
class CompatabilityTest extends PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->file = sprintf('%s/%s', dirname(__FILE__), 'sample.jpg');

  }

  public function testParseIniStringSuccess()
  {
    $array = parse_ini_string('foo="bar"');
    $this->assertEquals(array('foo' => 'bar'), $array);
  }

  public function testParseIniStringWithSectionsIgnoreSuccess()
  {
    $array = parse_ini_string('[section]
foo="bar"');
    $this->assertEquals(array('foo' => 'bar'), $array);
  }

  public function testParseIniStringWithSectionsSuccess()
  {
    $array = parse_ini_string('[section]
foo="bar"', true);
    $this->assertEquals(array('section' => array('foo' => 'bar')), $array);
  }

  public function testParseIniStringEmptySuccess()
  {
    $array = parse_ini_string('', true);
    $this->assertEquals(array(), $array, "Empty string should parse to empty array");
    
    $array = parse_ini_string('foobar', true);
    $this->assertEquals(array(), $array, "Empty string should parse non ini string to array");
  }

  public function testGetMimeTypeSuccess()
  {
    $type = get_mime_type($this->file);
    $this->assertEquals('image/jpeg', $type);
  }

  public function testGetMimeTypeFileDoesNotExistFailure()
  {
    $type = get_mime_type('does_not_exist.jpg');
    $this->assertFalse($type);
  }
}