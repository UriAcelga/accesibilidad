@props(['facultades', 'prompt', 'field_name'])
<div class="flex justify-center">
    <div x-data="{
        open: false,
        focused_index: 0,
        input_value: '',
        max_index: {{ $facultades->count() - 1 }},
        select_prompt: '{{ $prompt }}',
    
        close() {
            this.open = false
            this.$refs.button.focus()
        },
    
        toggle() {
            if (this.open) {
                this.close()
            } else if(! this.$refs.button.ariaDisabled)  {
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
                event.preventDefault()
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
                } else if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault()
                    this.selectOption(this.$refs.listbox.children[this.focused_index].dataset.value,
                        this.$refs.listbox.children[this.focused_index].dataset.name )    
                }
            } else{
                if (event.key === 'ArrowDown' || event.key === 'ArrowUp' ) {
                    this.toggle()
                }
            }
        }
    }"  x-on:keydown.stop="navigate($event)"
        x-id="['dropdown-panel']"
        class="relative w-full"
        x-effect="$dispatch('facultad-change', input_value)"
        >
        <!-- Hidden Input -->
        <input type="hidden"
            name="{{ $field_name }}"
            x-bind:value="input_value"
            >
        <!-- Boton -->
        <span class="block mb-2 text-lg font-medium text-white">{{ucfirst($field_name)}}:</span>
        <button type="button" tabindex=0 
            x-ref="button"
            x-on:click="toggle()" 
            :aria-expanded="open"
            :aria-controls="$id('dropdown-panel')" aria-haspopup="listbox"
            class="relative flex items-center whitespace-nowrap justify-between gap-2 w-full h-12 px-4 py-3 text-base text-gray-900 border-2 border-gray-400 rounded-lg bg-gray-50 focus:ring-blue-900 focus:border-blue-900"
            >
            <span x-text="select_prompt" class="truncate"></span>

            <img src="{{ asset('icons/dropdown-arrow.svg') }}" class="w-4">

        </button>

        <!-- Panel -->
        <ul role="listbox" 
            x-ref="listbox"
            x-show="open"
            x-cloak
            x-on:click.outside="close()"
            :id="$id('dropdown-panel')"

            class="absolute left-0 w-full rounded-lg shadow-sm mt-2 z-10 origin-top-left bg-white outline-none border border-gray-200">
            <!-- Opciones -->
            @foreach ($facultades as $facultad)
                <!-- Muchos elementos visuales no se muestran en WHCM (contornos, fondos, íconos, etc)-->
                <li role="option" 
                    data-index="{{ $loop->index }}"
                    data-value="{{ $facultad->codigo }}"
                    data-name="{{ $facultad->nombre }}"
                    x-on:click.prevent="selectOption($el.dataset.value, $el.dataset.name)"
                    class="p-2.5 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-blue-100 focus-visible:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed border-b border-gray-200"
                    :class="$el.dataset.index == focused_index ? 'outline-none ring-3 ring-blue-700 forced-colors:ring-current' : ''"> 
                    <span
                        class="w-16 text-center bg-blue-900 text-white text-xs font-bold me-2    py-0.5 rounded-sm">{{ $facultad->codigo }}</span>{{ $facultad->nombre }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
