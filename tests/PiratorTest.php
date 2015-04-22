<?php
/**
 * Setup environoment to have access to Drupal functions and installed modules.
 */
define('DRUPAL_ROOT', '../../../../');
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
// Bootstrap Drupal.
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

/**
 * Provides testing for Pirator class.
 */
class PiratorTest extends PHPUnit_Framework_TestCase {
  protected $pirator;
  protected $node;

  /**
   * Pre-test setup
   */
  protected function setUp() {
    $this->pirator = new Pirator();
  }

  public function testShouldYe() {
    $node = new stdClass();
    $node->nid = 2;
    $this->assertTrue($this->pirator->shouldYe($node));
  }

  // public function testTranslate() {
  //   $node = new stdClass();
  //   $node->title = 'Testing';
  //   $node->body[LANGUAGE_NONE][0]['value'] = 'hello my friend, do you know where I can meet a woman around here?';
  //   $node->type = 'basic_page';
  //   node_save($node);
  //   $this->assertEquals(
  //     '<p>avast my mate, do you know where I can meet a wench around here?</p>',
  //     $this->pirator->translate($node)->content['body'][0]['#markup']
  //   );
  // }
}
