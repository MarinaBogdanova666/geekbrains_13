<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
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
        $responseData = [
            'title' => 'Some title',
            'author' => 'Admin',
            'status' => 'DRAFT',
            'description' => 'Some text'
        ];

        $response = $this->post(route('admin.news.store'), $responseData);

        $response->assertJson($responseData);
        $response->assertStatus(200);
    }

    //Выгрузка информации
    public function testNewsAdminInfo()
    {

        $response = $this->get('/news');

        $response->ddHeaders();

        $response->ddSession();

        $response->dd();
    }

    // Проверка на устравшие PHP-функции
    public function testNewsAdminFunction()
    {
        $response = $this->withoutDeprecationHandling()->get('/');

        $response->assertStatus(200);
    }

    // Утверждает, что ответ имеет код 201 состояния HTTP
    public function testNewsAdminHTTP()
    {
        $response = $this->get('/news');

        $response->assertCreated();
    }

    // Утверждает, что ответ имеет код 201 состояния HTTP
    public function testNewsAdminSuccessful()
    {
        $response = $this->get(route('admin.news.create'));

        $response->assertSuccessful();
    }
}
