<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // Доступность списка всех новостей
    public function testNewsAvailable()
    {
        $response = $this->get('/news');

        $response->assertStatus(200);
    }

    // Список доступных админских новостей
    public function testNewsAdminAvailable()
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }

    // Открытие конкретной новости
    public function testNewsShow()
    {
        $response = $this->post(route('news.show', ['id' => mt_rand(1,10)]));

        $response->assertStatus(405);
    }

    // Работа формы добавления
    public function testNewsCreatedAdminAvailable()
    {
        $response = $this->get(route('admin.news.create'));

        $response->assertStatus(200);
    }

    //
    public function testNewsAdminCreated()
    {
        $category = Category::factory()->create();
        $responseData = News::factory()->definition();
        $responseData = $responseData + ['category_id' => $category->id];

        $response = $this->post(route('admin.news.store'), $responseData);

        $response->assertStatus(302);
    }

}
