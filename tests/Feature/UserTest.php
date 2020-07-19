<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     */
    public function a_non_admin_user_cant_view_all_users()
    {
        $this->actingAs(factory(User::class)->create([         
            'role'  => 'employee'
        ]));
        //When non admin user visit the users page
        $response = $this->get('/users');
        //they should be redirected to the home page        
        $response->assertRedirect(route('home'));       
    }
    /**
     * @test
     */
    public function an_admin_user_can_view_all_users()
    {
        $this->actingAs(factory(User::class)->create([         
            'role'  => 'admin'
        ]));
        //When admin user visit the users page
        $response = $this->get('/users');
        //they should receive a 200 status      
        $response->assertOk();
    }
    /**
     * @test
     */
    public function an_admin_user_can_add_a_user()
    {
        $this->actingAs(factory(User::class)->create([         
            'role'  => 'admin'
        ]));
        $user = factory(User::class)->make();
        //When user submits post request to create user route
        $response = $this->post(
            route('users.store'),
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password
            ],
        );
        //they should be redirected to the users page        
        $response->assertRedirect(route('users.index'));       
    } 
    // other tests to add
    // admin user updates an employee user  - should allow  
    // admin user deletes an employee user  - should allow  
    // admin user updates an admin user - should not allow
    // admin user deletes an admin user - should not allow    
    // admin user updates themselves - should allow  
    // admin user deletes themselves - should not allow
}