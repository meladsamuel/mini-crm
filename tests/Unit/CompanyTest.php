<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * Test the create method of the CompanyController.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('companies.create'));

        $response->assertOk();
        $response->assertViewIs('companies.create');
    }

    /**
     * Test the store method of the CompanyController.
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'logo' => UploadedFile::fake()->image('logo.png', 100, 100),
            'website' => $this->faker->url,
        ];

        Mail::fake();

        $response = $this->post(route('companies.store'), $data);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Company Created Successfully');

        $company = Company::where('name', $data['name'])->firstOrFail();
        $this->assertNotNull($company);
        $this->assertNotNull($company->logo);

        Mail::assertSent(\App\Mail\NewCompanyNotification::class, function ($mail) use ($company) {
            return $mail->company->id === $company->id;
        });
    }
}
