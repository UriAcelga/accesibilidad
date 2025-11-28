@props(['facultades',
    'prompt' => 'Selecciona una carrera', 
    'field_name' => 'carrera',
    'elements' => 'carreras',
    'label' => null
])
@php
    $label = $label ?? $field_name;
@endphp
<div class="flex justify-center">
    <div x-data="{
        open: false,
        focused_index: 0,
        input_value: '',
        max_index: {{ $facultades->count() - 1 }},
        default_prompt: '{{ $prompt }}',
        select_prompt: '{{ $prompt }}',
        visible_indexes: [],

        facultad: 'none',
    
        close() {
            this.open = false
            this.$refs.button.focus()
        },
    
        toggle() {
            if (this.open) {
                this.close()
            } else if(! this.$refs.button.ariaDisabled) {
                this.open = true
                this.focused_index = this.visible_indexes[0] ?? 1
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
                event.preventDefault()
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
                        this.scrollToLast()
                    } else {
                        this.focused_index = this.visible_indexes[i-1]
                    }
                } else if (event.key === 'Home') {
                    this.focused_index = this.visible_indexes[0]
                } else if (event.key === 'End') {
                    this.focused_index = this.visible_indexes[this.visible_indexes.length - 1]
                    this.scrollToLast()
                } else if (event.key === 'Tab') {
                    this.open = false
                } else if (event.key === 'Escape') {
                    this.close()
                } else if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault()
                    this.selectOptionByIndex(this.focused_index)  
                }
                this.scrollToFocused()
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
            this.select_prompt = this.default_prompt
            this.input_value = ''
        },
        
        isDisabled() {
            return this.visible_indexes.length === 0
        },

        scrollToFocused() {
            this.$refs.listbox.children[this.focused_index].scrollIntoView({
                block: 'center',
                inline: 'nearest'
            })
        },

        scrollToLast() {
            this.$refs.listbox.scrollTop = this.$refs.listbox.scrollHeight
        },
    }"
    @facultad-change.window="cambiarFacultad($event)"
    x-on:keydown.stop="navigate($event)" x-id="['dropdown-panel']" class="relative w-full">
        <!-- Hidden Input: Dispatch manda datos en el evento para que otros componentes lo reconozcan -->
        <input type="hidden"
            required
            name="{{ $field_name }}"
            x-bind:value="input_value">
        <!-- Boton -->
        <span class="block mb-2 text-lg font-medium text-white">{{ucfirst($label)}}:</span>
        <button type="button" tabindex=0 
            x-ref="button"
            x-on:click="toggle()" 
            :aria-expanded="open"
            :aria-controls="$id('dropdown-panel')" aria-haspopup="listbox"
            :aria-disabled="isDisabled()"
            class="relative flex items-center whitespace-nowrap justify-between gap-2 w-full h-12 px-4 py-3 text-base border-2 border-gray-400 rounded-lg focus:ring-blue-900 focus:border-blue-900"
            :class="isDisabled() ? 'bg-gray-300 text-gray-600' : 'bg-gray-50 text-gray-900'"
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

            class="absolute left-0 w-full rounded-lg shadow-sm mt-2 z-10 p-2 origin-top-left bg-white outline-none border border-gray-200 max-h-72 overflow-y-scroll">
            <!-- Opciones -->
            @php
                $loopCount = 0;
            @endphp
            @for ($i = 0; $i < $facultades->count(); $i++)
                @for ($j = 0; $j < $facultades[$i]->{$elements}->count(); $j++)
                    @php
                        $item = $facultades[$i]->{$elements}[$j];
                        $loopCount++;
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