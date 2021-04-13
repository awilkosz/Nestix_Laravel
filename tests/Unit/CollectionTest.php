<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Collection;  
use Illuminate\Foundation\Testing\DatabaseTransactions; 

class CollectionTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
	
    public function testCreateCollection()  
    {  
        $collection = Collection::create([  
            'collect_date_creat' => date('Y-m-d'),
			'collect_title' => 'titreCollection',
			'human_id' => 68
        ]);  
        $this->assertEquals(1, Collection::count());  
  
        // La collection a bien été créée, il y a donc  
        // maintenant une collection en base.  
    }  
  
    /**  
     * Pour cette deuxième fonction, la base de données  
     * a été entièrement réinitialisée.  
     */  
    public function testCountCollections()  
    {  
        $this->assertEquals(0, Collection::count());  
  
        // Il n’y a aucun produit en base de données.  
    } 
}
