<?php
class PhotographTest extends ApiTester {
    /** @test */
    public function it_fetched_photographs(){
        $this->times(5)->make('Photograph');
        $this->getJson('api/photograph');
        $this->assertResponseOk();
    }

    /** @test */
    public function it_failed_to_fetch_photograph(){
        $this->getJson('api/photograph/x');
        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_throws_422_failed_validation(){
        $this->getJson('api/photograph','POST');
        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_creates_a_photograph(){
        $data = $this->getStub();
        dd($this->getJson('api/photograph','POST',$data));
        $this->assertResponseOk();
    }

    protected function getStub(){
        return [
            'photo'=>$this->fake->word.'.jpg',
            'user_id'=>$this->fake->randomDigit(),
            'photograph_id'=>$this->fake->randomDigit(),
            'comment'=>$this->fake->sentence(),
            'isPublic'=>$this->fake->boolean()
        ];
    }
} 