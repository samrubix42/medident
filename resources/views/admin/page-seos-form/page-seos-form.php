<?php

use App\Models\PageSeo;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::admin')] class extends Component
{
    public ?int $pageSeoId = null;

    public string $pageName = '';

    public string $pageSlug = '';

    public string $metaTitle = '';

    public string $metaDescription = '';

    public string $metaKeywords = '';

    public bool $slugManuallyEdited = false;

    public function mount(?int $pageSeo = null): void
    {
        if ($pageSeo === null) {
            return;
        }

        $pageSeo = PageSeo::findOrFail($pageSeo);

        $this->pageSeoId = $pageSeo->id;
        $this->pageName = $pageSeo->page_name;
        $this->pageSlug = $pageSeo->page_slug;
        $this->metaTitle = $pageSeo->meta_title ?? '';
        $this->metaDescription = $pageSeo->meta_description ?? '';
        $this->metaKeywords = $pageSeo->meta_keywords ?? '';
        $this->slugManuallyEdited = true;
    }

    public function updatedPageName(string $value): void
    {
        if (! $this->slugManuallyEdited) {
            $this->pageSlug = Str::slug($value);
        }
    }

    public function updatedPageSlug(): void
    {
        $this->slugManuallyEdited = true;
    }

    public function save(): mixed
    {
        abort_unless(auth()->check(), 403);

        $this->pageSlug = Str::slug($this->pageSlug !== '' ? $this->pageSlug : $this->pageName);

        $validated = $this->validate([
            'pageName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('page_seos', 'page_name')->ignore($this->pageSeoId),
            ],
            'pageSlug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('page_seos', 'page_slug')->ignore($this->pageSeoId),
            ],
            'metaTitle' => ['nullable', 'string', 'max:255'],
            'metaDescription' => ['nullable', 'string', 'max:1000'],
            'metaKeywords' => ['nullable', 'string', 'max:255'],
        ]);

        $data = [
            'page_name' => $validated['pageName'],
            'page_slug' => $validated['pageSlug'],
            'meta_title' => $validated['metaTitle'] ?: null,
            'meta_description' => $validated['metaDescription'] ?: null,
            'meta_keywords' => $validated['metaKeywords'] ?: null,
        ];

        if ($this->pageSeoId) {
            PageSeo::findOrFail($this->pageSeoId)->update($data);

            session()->flash('status', 'Page SEO updated successfully.');
        } else {
            PageSeo::create($data);

            session()->flash('status', 'Page SEO created successfully.');
        }

        return redirect()->route('admin.page-seos');
    }

    public function render()
    {
        return $this->view()->title($this->pageSeoId ? 'Edit Page SEO' : 'Create Page SEO');
    }
};
