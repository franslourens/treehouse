<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once dirname(dirname(__FILE__)) . '/sql.class.php'; #works fine.
require_once dirname(dirname(__FILE__)) . '/submission.class.php'; #works fine.

final class FormTest extends TestCase
{
  public function setUp(): void
     {
         $s = new Submission(array(
             'name' => "test",
             'email' => "test@test.com"
         ));

         $s->save();
     }

    public function testListSubmissions(): void
    {
        $r = Submission::collection();
        $this->assertEquals(1, $r->num_rows);
    }

    public function submissions_provider()
     {

         return array(
             "Scenario: Failed" => array("test", "test@test.com", false),
             "Scenario: Success" => array("test2", "test2@test.com", true),
         );
     }

     /**
      * @test
      * @dataProvider submissions_provider
      **/
     public function add_submissions($name, $email, $result)
     {
       $s = new Submission(array(
           'name' => $name,
           'email' => $email
       ));

       $this->assertEquals($s->save(), $result);
     }
}
