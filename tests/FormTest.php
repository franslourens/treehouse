<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once dirname(dirname(__FILE__)) . '/sql.class.php';
require_once dirname(dirname(__FILE__)) . '/form.class.php';
require_once dirname(dirname(__FILE__)) . '/submission.class.php';

final class FormTest extends TestCase
{
  private $form;

  public function setUp(): void
  {
        $stub = $this->getMockForAbstractClass('Form');
        $this->form = $stub;

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

     public function testEmail() {
       $this->form->expects($this->once())
         ->method('is_email')
         ->will($this->returnValue(false));

       $this->assertEquals(false, $this->form->is_email("frans"));
     }
}
