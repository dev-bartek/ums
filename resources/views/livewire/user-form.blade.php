<div
    x-data="{ open: false }"
    @user-created.window="open = false"
    @user-updated.window="open = false"
>
    <span x-on:click="open = true">
        @if($action === 'save')
            <x-create-button />
        @else
            <x-edit-button />
        @endif
    </span>
    <div
        x-show="open"
        style="display: none"
        x-on:keydown.escape.prevent.stop="open = false"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-10 overflow-y-auto"
    >
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

        <!-- Panel -->
        <div
            x-show="open" x-transition
            x-on:click="open = false"
            class="relative flex min-h-screen items-center justify-center p-4"
        >
            <div
                x-on:click.outside="$wire.resetForm()"
                x-on:click.stop
                x-trap.noscroll.inert="open"
                class="relative w-full max-w-xl overflow-y-auto rounded-xl bg-white p-8 shadow-lg"
            >
                <h2 class="text-2xl mb-4 font-bold" :id="$id('modal-title')">{{ $title }}</h2>
                <form wire:submit="{{ $action }}">
                    <x-input-field
                        id="name"
                        label="Name:"
                        type="text"
                        model="form.name"
                        field="form.name"
                        :required="true"
                    />
                    <x-input-field
                        id="email"
                        label="Email:"
                        type="email"
                        model="form.email"
                        field="form.email"
                        :required="true"
                    />
                    <x-input-field
                        id="address1"
                        label="Address Line 1:"
                        type="text"
                        model="form.addressLine1"
                        field="form.addressLine1"
                        :required="true"
                    />
                    <x-input-field
                        id="address2"
                        label="Address Line 2:"
                        type="text"
                        model="form.addressLine2"
                        field="form.addressLine2"
                        :required="false"
                    />
                    <x-input-field
                        id="town"
                        label="Town:"
                        type="text"
                        model="form.town"
                        field="form.town"
                        :required="false"
                    />
                    <x-input-field
                        id="city"
                        label="City:"
                        type="text"
                        model="form.city"
                        field="form.city"
                        :required="true"
                    />
                    <x-input-field
                        id="postcode"
                        label="Postcode:"
                        type="text"
                        model="form.postcode"
                        field="form.postcode"
                        :required="true"
                    />
                <div class="mt-8 flex space-x-2">
                    <x-save-button />
                    <x-cancel-button />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
