<div>
    <div class="flex justify-center">
        <form wire:submit.prevent="registerUser" class="form">
            <div class="mt-1 mb-6">
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
    </div>

    @if($formSubmitted)
    <div id="successModal"  tabindex="-1" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 md:inset-0 h-modal md:h-full" aria-modal="true" role="dialog">
    <div class="relative w-full h-full max-w-md p-4 md:h-auto">
        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="hideModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">סגור</span>
            </button>
            <img src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/desktop/logo.png' }}" class="w-1/2 h-1/2 rounded-full  p-2 flex items-center justify-center mx-auto mb-3.5" alt="">
            <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">תודה שנרשמת למערכת MY-SAFE</h2>
            <p class="mb-4 text-lg font-semibold text-gray-600 dark:text-white">בדקות הקרובות יתקבל בתיבת הדואר שלך מייל עם קישור ליצירת סיסמא וכניסה למערכת</p>
            <button wire:click="hideModal" type="button" class="px-5 py-2 text-xl text-center text-black bg-green-400 rounded-lg font-lm medium hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:focus:ring-primary-900">
                אישור
            </button>
        </div>
    </div>
</div>

        @endif
</div>
