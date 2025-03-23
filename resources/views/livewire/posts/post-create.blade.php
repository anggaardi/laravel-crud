<section>
    <form wire:submit="savePost" class="max-w-md mx-auto    flex flex-col gap-6 bg-slate-900 shadow-2xl rounded-2xl p-4">
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
      <!-- content -->
      <flux:textarea 
      wire:model="form.content"
      label="content"/>

   
        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">Tambah</flux:button>
        </div>
    </form>
</section>
