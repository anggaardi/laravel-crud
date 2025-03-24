<section>
    <form wire:submit="updatePost" class="max-w-md mx-auto    flex flex-col gap-6 bg-slate-900 shadow-2xl rounded-2xl p-4">
        <!-- title -->
        <flux:input
            wire:model="form.title"
            label="Judul"
            type="text"
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

          <!-- image -->
          <flux:input
          wire:model="form.image"
          label="Image"
          type="file"
      />
      <div >
        <img src="{{ Storage::url($form->post->image) }}" class="w-12 h-12 rounded-2xl">
        @if($form->image)
        <img src="{{ $form->image->temporaryUrl() }}" class="w-12 h-12 rounded-2xl">
        @endif
      </div>
      <!-- content -->
      <flux:textarea 
      wire:model="form.content"
      label="content"/>

   
        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">Update</flux:button>
        </div>
    </form>
</section>
