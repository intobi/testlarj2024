<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_name_email_and_message()
    {
        $this->json('POST', '/api/submit', [])
            ->assertStatus(422)
            ->assertJsonStructure(['errors' => ['name', 'email', 'message']]);
    }

    /** @test */
    public function it_creates_a_submission_successfully()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $this->json('POST', '/api/submit', $payload)
            ->assertStatus(202)
            ->assertJson(['message' => 'Submission received and is being processed']);
    }
}
