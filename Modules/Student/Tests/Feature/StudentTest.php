<?php


namespace Modules\Student\Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Modules\School\Entities\School;
use Modules\Student\Entities\Student;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /** @test * */
    public function test_reorder_command()
    {
        Artisan::call('students:reOrder');
        $schools = School::all();
        $is_ordered = true;
        foreach ($schools as $school) {
            $students = Student::where('school_id',$school->id)->orderBy('order','ASC')->get();
            $studentsCount = count($students);
            if($studentsCount != 0 && $studentsCount != (int) $students[$studentsCount-1]->order) {
                $is_ordered = false;
                break;
            }
        }
        $this->assertTrue($is_ordered);
    }
    /** @test * */
    public function test_api_login()
    {
        $body = [
            'email' => 'admin@argon.com',
            'password' => 'secret'
        ];
        $this->json('POST', '/api/login', $body, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    /** @test * */
    public function test_only_logged_in_users_can_see_all_students()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/students');
        $response->assertStatus(200);
    }

    /** @test * */
    public function test_not_logged_in_users_cannot_see_all_students()
    {
        $response = $this->get('/api/students');
        $response->assertStatus(302);
    }

    /** @test * */
    public function create_student()
    {
        $user = User::factory()->create();
        $formData = [
            'name' => 'Hisham',
            'order' => 1,
            'school_id' => 1
        ];
        $response = $this->actingAs($user)->json('POST', 'api/students', $formData);
        $response->assertStatus(200);
    }

    /** @test * */
    public function get_student()
    {
        $user = User::factory()->create();
        $formData = [
            'name' => 'Hisham',
            'order' => 1,
            'school_id' => 1
        ];
        $created_user_data = $this->actingAs($user)->json('POST', 'api/students', $formData);
        $response = $this->actingAs($user)->get('/api/students/' . $created_user_data['data'][0]['id']);
        $response->assertStatus(200);
    }

    /** @test * */
    public function edit_student()
    {
        $user = User::factory()->create();
        $formData = [
            'name' => 'Hisham',
            'order' => 1,
            'school_id' => 1
        ];
        $updatedFormData = [
            'name' => 'Atef',
            'order' => 1,
            'school_id' => 1
        ];
        $created_user_data = $this->actingAs($user)->json('POST', 'api/students', $formData);
        $response = $this->actingAs($user)->json('PATCH', 'api/students/' . $created_user_data['data'][0]['id'], $updatedFormData);
        $response->assertStatus(200);
    }

    /** @test * */
    public function delete_student()
    {
        $user = User::factory()->create();
        $formData = [
            'name' => 'Hisham',
            'order' => 1,
            'school_id' => 1
        ];
        $created_user_data = $this->actingAs($user)->json('POST', 'api/students', $formData);
        $response = $this->actingAs($user)->json('DELETE', 'api/students/' . $created_user_data['data'][0]['id']);
        $response->assertStatus(200);
    }
}
