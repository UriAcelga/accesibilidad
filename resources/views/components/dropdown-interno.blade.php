@props(['facultades', 'prompt', 'field_name'])
<div class="flex justify-center">
    <div x-data="{
        open: false,
        focused_index: 0,
        input_value: '',
        max_index: {{ $facultades->count() - 1 }},
        select_prompt: '{{ $prompt }}',
        visible_indexes: [0,0,0,0],

        facultad: 'none',
    
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

        selectOptionByIndex(index) {
            for(const item of this.$refs.listbox.children) {
                if(parseInt(item.dataset.index) === index) {
                    this.input_value = item.dataset.value
                    this.select_prompt = item.dataset.name
                    this.toggle()
                }
            }
        },
    
        navigate(event) {
            if (this.open) {
                if (event.key === 'ArrowDown') {
                    const i = this.visible_indexes.indexOf(this.focused_index)
                    if(i === this.visible_indexes.length - 1) {
                        this.focused_index = this.visible_indexes[0]
                    } else {
                        this.focused_index = this.visible_indexes[i+1]
                    }
                } else if (event.key === 'ArrowUp') {
                    const i = this.visible_indexes.indexOf(this.focused_index)
                    if(i === 0) {
                        this.focused_index = this.visible_indexes[this.visible_indexes.length - 1]
                    } else {
                        this.focused_index = this.visible_indexes[i-1]
                    }
                } else if (event.key === 'Home') {
                    this.focused_index = this.visible_indexes[0]
                } else if (event.key === 'End') {
                    this.focused_index = this.visible_indexes[this.visible_indexes.length - 1]
                } else if (event.key === 'Tab') {
                    this.open = false
                } else if (event.key === 'Escape') {
                    this.close()
                } else if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault()
                    this.selectOptionByIndex(this.focused_index)    
                }
            } else {
                if (event.key === 'ArrowDown' || event.key === 'ArrowUp' ) {
                    this.toggle()
                }
            }
        },

        getVisibleItemIndexes() {
            return Array.from(this.$refs.listbox.children)
            .filter( item => {
                return item.dataset.facultad === this.facultad
            })
            .map(item => {
                return parseInt(item.dataset.index)
            })
            
        },

        cambiarFacultad($event) {
            this.facultad = $event.detail
            this.visible_indexes = this.getVisibleItemIndexes()
        },
    }"
    @facultad-change.window="cambiarFacultad($event)"
    x-on:keydown.stop="navigate($event)" x-id="['dropdown-panel']" class="relative w-full">
        <!-- Hidden Input: Dispatch manda datos en el evento para que otros componentes lo reconozcan -->
        <input type="hidden"
            name="{{ $field_name }}"
            x-bind:value="input_value">
        <!-- Boton -->
        <span class="block mb-2 text-sm font-medium text-gray-900">Carrera</span>
        <button type="button" tabindex=0 
            x-ref="button"
            x-on:click="toggle()" 
            :aria-expanded="open"
            :aria-controls="$id('dropdown-panel')" aria-haspopup="listbox"
            class="relative flex items-center whitespace-nowrap justify-between gap-2 w-full h-12 px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            >
            <span x-text="select_prompt"></span>

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
            @for ($i = 0; $i < $facultades->count(); $i++)
                @for ($j = 0; $j < $facultades[$i]->carreras->count(); $j++)
                    @php
                        $item = $facultades[$i]->carreras[$j];
                        $loopCount = ($i + 1) * $facultades->count() + ($j + 1);
                    @endphp
                    <li role="option"
                    data-index="{{ $loopCount }}"
                    data-value="{{ $item->id }}"
                    data-name="{{ $item->nombre }}"
                    data-facultad="{{ $item->facultad_codigo}}"
                    x-show="facultad === $el.dataset.facultad"
                    x-on:click.prevent="selectOption('{{ $item->id }}','{{ $item->nombre }}')"
                    class="p-2.5 w-full flex facultades-center rounded-md transition-colors text-left text-gray-800 hover:bg-blue-100 focus-visible:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed border-b border-gray-200"
                    :class="$el.dataset.index == focused_index ? 'ring-3 ring-blue-700' : ''">
                    {{ $item->nombre }}
                    </li>
                @endfor
            @endfor
        </ul>
    </div>
</div>