<form wire:submit.prevent="submit">
    <input type="file" wire:model="client.logo">
    @error('client.logo') <span class="error">{{ $message }}</span> @enderror

    <input type="text" wire:model="client.title">
    @error('client.title') <span class="error">{{ $message }}</span> @enderror

    <input type="text" wire:model="client.website">
    @error('client.website') <span class="error">{{ $message }}</span> @enderror

    <input type="text" wire:model="client_id">

    <button type="submit">Save client</button>
</form>