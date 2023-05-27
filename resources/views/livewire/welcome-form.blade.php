<div>
    @if (!$formSubmitted)
        <h2>{{ $formTitle }}</h2>
        <form wire:loading.remove wire:submit.prevent="submit" class="form">
            <div class="mb-6 mt-1">
                <label class="block" for="name">@error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                </label>
                <input type="text" id="name" wire:model="name" name="name" placeholder="שם פרטי:"
                       class="input">
            </div>

            <div class="mb-6">
                <label class="block" for="email">@error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                </label>
                <input type="text" id="email" wire:model="email" name="email" placeholder='דוא"ל:'
                       class="input">
            </div>

            <div class="mb-6">
                <label class="block" for="phone">@error('phone') <span class="text-red-600">{{ $message }}</span> @enderror
                </label>
                <input type="text" id="phone" wire:model="phone" name="phone" placeholder="טלפון:"
                       class="input">

            </div>

            <div class="">
                <button type="submit"
                        class="button">
                    לשליחה
                </button>

            </div>
        </form>
        <button style="background-color: deepskyblue; height: 5vi; max-width: 15vi; " class="button" disabled wire:loading >
            שולח פרטים למערכת
        </button>
    @else
        <h2>{{ $formTitle }}</h2>
    @endif
</div>
