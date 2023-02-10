<?php

namespace Drupal\Tests\livefilter\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Simple browser test.
 *
 * @group epp
 */
class AdminPageTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = [
    'livefilter',
  ];

  /**
   * Theme to enable.
   *
   * @var string
   */
  protected $defaultTheme = 'stark';

  /**
   * Tests that the /admin page returns a 200.
   */
  public function testAdminPage() {
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('admin');
    $this->assertResponse(200);
  }

}
