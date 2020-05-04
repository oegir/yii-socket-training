<?php 
namespace app\tests\unit\models;

use app\tests\unit\fixtures\SudokuFixture;
use yii\helpers\Json;

class SudokuTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'game' => [
                'class' => SudokuFixture::class,
                'dataFile' => codecept_data_dir() . 'sudoku.php',
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $game = $this->tester->grabFixture('game', 0);
        
        expect('valid Sudoku game data getting', $game->toArray())->equals([
            'field' => Json::decode($game->field),
            'id' => $game->id,
        ]);
    }
}