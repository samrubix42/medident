<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin')] class extends Component
{
    use WithFileUploads;

    public ?int $blogPostId = null;

    public string $title = '';

    public string $slug = '';

    public ?int $categoryId = null;

    public string $content = '';

    public string $metaTitle = '';

    public string $metaDescription = '';

    public string $metaKeyword = '';

    public mixed $featureImage = null;

    public ?string $currentFeatureImage = null;

    public bool $isActive = true;

    public bool $slugManuallyEdited = false;

    public function mount(?int $blogPost = null): void
    {
        if ($blogPost === null) {
            return;
        }

        $post = BlogPost::findOrFail($blogPost);

        $this->blogPostId = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->categoryId = $post->category_id;
        $this->content = $post->content;
        $this->metaTitle = $post->meta_title ?? '';
        $this->metaDescription = $post->meta_description ?? '';
        $this->metaKeyword = $post->meta_keyword ?? '';
        $this->currentFeatureImage = $post->feature_image;
        $this->isActive = $post->is_active;
        $this->slugManuallyEdited = true;
    }

    /**
     * @return Collection<int, BlogCategory>
     */
    #[Computed]
    public function categories(): Collection
    {
        return BlogCategory::query()
            ->orderBy('title')
            ->get();
    }

    public function updatedTitle(string $value): void
    {
        if (! $this->slugManuallyEdited) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedSlug(): void
    {
        $this->slugManuallyEdited = true;
    }

    public function save(): mixed
    {
        abort_unless(auth()->check(), 403);

        $this->slug = Str::slug($this->slug !== '' ? $this->slug : $this->title);

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blog_posts', 'slug')->ignore($this->blogPostId),
            ],
            'categoryId' => ['required', 'integer', Rule::exists('blog_categories', 'id')],
            'content' => ['required', 'string'],
            'metaTitle' => ['nullable', 'string', 'max:255'],
            'metaDescription' => ['nullable', 'string', 'max:1000'],
            'metaKeyword' => ['nullable', 'string', 'max:255'],
            'featureImage' => ['nullable', 'image', 'max:5120'],
            'isActive' => ['boolean'],
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'category_id' => $validated['categoryId'],
            'content' => $validated['content'],
            'meta_title' => $validated['metaTitle'] ?: null,
            'meta_description' => $validated['metaDescription'] ?: null,
            'meta_keyword' => $validated['metaKeyword'] ?: null,
            'is_active' => $validated['isActive'],
        ];

        if ($this->featureImage) {
            $data['feature_image'] = 'storage/'.$this->featureImage->store('blog', 'public');
        }

        if ($this->blogPostId) {
            $post = BlogPost::findOrFail($this->blogPostId);
            $previousFeatureImage = $post->feature_image;

            $post->update($data);

            if ($this->featureImage) {
                $this->deleteStoredImage($previousFeatureImage);
            }

            session()->flash('status', 'Blog post updated successfully.');
        } else {
            BlogPost::create($data);

            session()->flash('status', 'Blog post created successfully.');
        }

        return redirect()->route('admin.blog-posts');
    }

    public function render()
    {
        return $this->view()->title($this->blogPostId ? 'Edit Blog Post' : 'Create Blog Post');
    }

    private function deleteStoredImage(?string $featureImage): void
    {
        if (! $featureImage || ! Str::startsWith($featureImage, 'storage/blog/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($featureImage, 'storage/'));
    }
};
