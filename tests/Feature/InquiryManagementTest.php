<?php

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the inquiries page', function () {
    $this->get('/admin/inquiries')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the inquiries page', function () {
    $user = User::factory()->create();

    $unreadInquiry = ContactMessage::factory()->create([
        'name' => 'Unread Patient',
        'subject' => 'Unread dental question',
    ]);

    $readInquiry = ContactMessage::factory()->read()->create([
        'name' => 'Read Patient',
        'subject' => 'Read medical question',
    ]);

    $this->actingAs($user)
        ->get('/admin/inquiries')
        ->assertOk()
        ->assertSee('Inquiry inbox')
        ->assertSee($unreadInquiry->name)
        ->assertSee($unreadInquiry->subject)
        ->assertSee($readInquiry->name)
        ->assertSee($readInquiry->subject)
        ->assertSee('2 total')
        ->assertSee('1 unread');
});

test('inquiries can be searched by sender, contact details, or message', function () {
    $this->actingAs(User::factory()->create());

    ContactMessage::factory()->create([
        'name' => 'Alice Walker',
        'email' => 'alice@example.com',
        'subject' => 'Dental cleaning',
        'message' => 'I would like to book a cleaning appointment.',
    ]);

    ContactMessage::factory()->create([
        'name' => 'Bob Stone',
        'email' => 'bob@example.com',
        'subject' => 'Medical consultation',
        'message' => 'I have a question about my prescription.',
    ]);

    Livewire::test('admin::inquiries')
        ->set('search', 'Alice')
        ->assertSee('Alice Walker')
        ->assertDontSee('Bob Stone');

    Livewire::test('admin::inquiries')
        ->set('search', 'prescription')
        ->assertSee('Bob Stone')
        ->assertDontSee('Alice Walker');
});

test('inquiries can be filtered by read status', function () {
    $this->actingAs(User::factory()->create());

    ContactMessage::factory()->create([
        'name' => 'Unread Patient',
        'subject' => 'Unread question',
    ]);

    ContactMessage::factory()->read()->create([
        'name' => 'Read Patient',
        'subject' => 'Read question',
    ]);

    Livewire::test('admin::inquiries')
        ->set('filter', 'unread')
        ->assertSee('Unread Patient')
        ->assertDontSee('Read Patient')
        ->set('filter', 'read')
        ->assertSee('Read Patient')
        ->assertDontSee('Unread Patient');
});

test('an admin can open and close an inquiry', function () {
    $this->actingAs(User::factory()->create());

    $inquiry = ContactMessage::factory()->create([
        'name' => 'Inquiry Patient',
        'subject' => 'Detailed inquiry subject',
        'message' => 'This is the full inquiry message.',
    ]);

    Livewire::test('admin::inquiries')
        ->call('openInquiry', $inquiry->id)
        ->assertSet('showInquiryModal', true)
        ->assertSet('selectedInquiryId', $inquiry->id)
        ->assertSee('This is the full inquiry message.')
        ->call('closeInquiry')
        ->assertSet('showInquiryModal', false)
        ->assertSet('selectedInquiryId', null);
});

test('an admin can toggle an inquiry between read and unread', function () {
    $this->actingAs(User::factory()->create());

    $inquiry = ContactMessage::factory()->create([
        'is_read' => false,
    ]);

    Livewire::test('admin::inquiries')
        ->call('toggleRead', $inquiry->id)
        ->assertDispatched('toast-show');

    expect($inquiry->refresh()->is_read)->toBeTrue();

    Livewire::test('admin::inquiries')
        ->call('toggleRead', $inquiry->id)
        ->assertDispatched('toast-show');

    expect($inquiry->refresh()->is_read)->toBeFalse();
});

test('an admin can mark all inquiries as read', function () {
    $this->actingAs(User::factory()->create());

    ContactMessage::factory()->count(2)->create([
        'is_read' => false,
    ]);

    ContactMessage::factory()->read()->create();

    Livewire::test('admin::inquiries')
        ->call('markAllAsRead')
        ->assertDispatched('toast-show');

    expect(ContactMessage::query()->where('is_read', false)->count())->toBe(0)
        ->and(ContactMessage::query()->where('is_read', true)->count())->toBe(3);
});

test('the delete modal opens, closes, and deletes an inquiry', function () {
    $this->actingAs(User::factory()->create());

    $inquiry = ContactMessage::factory()->create();

    Livewire::test('admin::inquiries')
        ->call('confirmDelete', $inquiry->id)
        ->assertSet('showDeleteModal', true)
        ->assertSet('inquiryIdBeingDeleted', $inquiry->id)
        ->call('cancelDelete')
        ->assertSet('showDeleteModal', false)
        ->assertSet('inquiryIdBeingDeleted', null)
        ->call('confirmDelete', $inquiry->id)
        ->call('deleteInquiry')
        ->assertSet('showDeleteModal', false)
        ->assertSet('inquiryIdBeingDeleted', null)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('contact_messages', ['id' => $inquiry->id]);
});
