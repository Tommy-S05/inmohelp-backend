<div>
    <header class="fi-simple-header py-8">
        <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
            {{ __('filament-panels::pages/auth/edit-profile.label') }}
        </h1>
        <p class="fi-simple-header-subheading mt-2 text-left text-sm text-gray-500 dark:text-gray-400">
            Manage your profile information.
        </p>
    </header>

    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
            alignment="right"
        />
    </x-filament-panels::form>
</div>
