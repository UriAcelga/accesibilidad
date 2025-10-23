@props(['facultades', 'prompt', 'field_name'])
<div class="flex justify-center">
    <div x-data="{
        open: false,
        focused_index: 0,
        max_index: {{ $facultades->count() - 1 }},
        select_prompt: '{{ $prompt }}',
    
        close() {
            this.open = false
            this.$refs.button.focus()
        },
    
        toggle() {
            if (this.open) {
                this.close()
            } else {
                this.open = true
                this.focused_index = 0
            }
        },
    
        selectOption(value, name) {
            this.input_value = value
            this.select_prompt = name
            this.toggle()
        },
    
        navigate(event) {
            if (this.open) {
                if (event.key === 'ArrowDown') {
                    this.focused_index = this.focused_index < this.max_index ? this.focused_index + 1 : 0
                } else if (event.key === 'ArrowUp') {
                    this.focused_index = this.focused_index <= 0 ? this.max_index : this.focused_index - 1
                } else if (event.key === 'Home') {
                    this.focused_index = 0
                } else if (event.key === 'End') {
                    this.focused_index = this.max_index
                } else if (event.key === 'Tab') {
                    this.open = false
                } else if (event.key === 'Escape') {
                    this.close()
                }
            } else {
                if (event.key === 'ArrowDown' ||
                event.key === 'ArrowUp' ) {
                    this.toggle()
                }
            }
        }
    }" x-on:keydown.stop="navigate($event)" x-id="['dropdown-button']" class="relative w-full">
        <!-- Hidden Input -->
        <input type="hidden" name="{{ $field_name }}" x-bind:value="input_value">
        <!-- Button -->
        <span class="block mb-2 text-sm font-medium text-gray-900">Facultad</span>
        <button type="button" tabindex=0 
            x-ref="button"
            x-on:click="toggle()" 
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')" aria-haspopup="listbox"
            class="relative flex items-center whitespace-nowrap justify-between gap-2 w-full h-12 px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            >
            <span x-text="focused_index"></span>

            <img src="{{ asset('icons/dropdown-arrow.svg') }}" class="w-4">

        </button>

        <!-- Panel -->
        <ul role="listbox" x-show="open" x-cloak x-on:click.outside="close()" :id="$id('dropdown-button')"
            class="absolute left-0 w-full rounded-lg shadow-sm mt-2 z-10 origin-top-left bg-white outline-none border border-gray-200">
            @foreach ($facultades as $facultad)
                <li role="option" data-index="{{ $loop->index }}"
                    x-on:click.prevent="selectOption('{{ $facultad->codigo }}','{{ $facultad->nombre }}')"
                    class="p-2.5 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-blue-100 focus-visible:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed border-b border-gray-200"
                    :class="$el.dataset.index == focused_index ? 'ring-3 ring-blue-700' : ''">
                    <span
                        class="w-16 text-center bg-blue-900 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">{{ $facultad->codigo }}</span>{{ $facultad->nombre }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
