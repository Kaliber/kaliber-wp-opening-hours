<?php

namespace OpeningHours\Test\Module\Schema;

use OpeningHours\Entity\Set;
use OpeningHours\Module\Schema\ValidityPeriod;
use OpeningHours\Test\OpeningHoursTestCase;

/**
 * Class ValidityPeriodTest
 *
 * @author  Jannik Portz <hello@jannikportz.de>
 * @package OpeningHours\Test\Module\Schema
 */
class ValidityPeriodTest extends OpeningHoursTestCase {

  /**
   * - `__construct` sets `$set`, `$start` and `$end` properly
   */
  public function test__construct() {
    $set = new Set(0);
    $dateStart = new \DateTime('2018-04-01');
    $dateEnd = new \DateTime('2018-04-01');
    $vp = new ValidityPeriod($set, $dateStart, $dateEnd);

    $this->assertEquals($set, $vp->getSet());
    $this->assertEquals($dateStart, $vp->getStart());
    $this->assertEquals($dateEnd, $vp->getEnd());
  }

  /**
   * - `__construct` accepts `null` for `$start` and `$end`
   */
  public function test__construct_AcceptsNullDates() {
    $set = new Set(0);
    $vp = new ValidityPeriod($set, null, null);
    $this->assertNull($vp->getStart());
    $this->assertNull($vp->getEnd());
  }

  /**
   * - `__construct` throws `InvalidArgumentException` when `$start` and `$end` are both set
   *   and `$start` is greater than `$end`
   */
  public function test__constructTrowsInvalidArgumentException() {
    $set = new Set(0);
    $dateStart = new \DateTime('2018-04-02');
    $dateEnd = new \DateTime('2018-04-01');

    try {
      new ValidityPeriod($set, $dateStart, $dateEnd);
      $this->fail('Expected \InvalidArgumentException to be thrown');
    } catch (\Exception $e) {
      $this->assertEquals('InvalidArgumentException', get_class($e));
    }
  }
}
