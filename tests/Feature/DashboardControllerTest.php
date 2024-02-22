<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Blog;
use App\Models\Categorie;
use App\Models\Comment;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase; 
    public function testUsersMethod()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);


        $response = $this->get('/dashboard/users');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.users')
                 ->assertViewHas('users')
                 ->assertSee($user->name); 
    }

    public function testBlogsMethod()
    {
        $blog = Blog::factory()->create();

        $response = $this->get('/dashboard/blogs');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.blogs')
                 ->assertViewHas('blogs')
                 ->assertSee($blog->title); 
    }

    public function testCommentsMethod()
    {
        $comment = Comment::factory()->create();

        $response = $this->get('/dashboard/comments');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.comments')
                 ->assertViewHas('comments')
                 ->assertSee($comment->content); 
    }

    public function testDestroyMethod()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create();
        $comment = Comment::factory()->create();
        $this->actingAs($user);

        $this->delete("/dashboard/destroy/{$user->id}", [], ['referer' => 'http://127.0.0.1:8000/dashboard/users'])
             ->assertRedirect();

        $this->delete("/dashboard/destroy/{$blog->id}", [], ['referer' => 'http://127.0.0.1:8000/dashboard/blogs'])
             ->assertRedirect();

        $this->delete("/dashboard/destroy/{$comment->id}", [], ['referer' => 'http://127.0.0.1:8000/dashboard/comments'])
             ->assertRedirect();

    }

    public function testShowMethod()
    {
        $user = User::factory()->create();
        $this->actingAs($user);


        $response = $this->get("/dashboard/show/{$user->id}");

        $response->assertStatus(200)
                 ->assertViewIs('profile.profile_user')
                 ->assertViewHas('user')
                 ->assertSee($user->name); 
    }

    public function testExportMethod()
    {
        $response = $this->get('/dashboard/export');

        $response->assertStatus(200);
    }
}
