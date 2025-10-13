@props([
    'facultades',
    'tabindex' 
    ])
<div class="flex justify-center">
    <div
        x-data="{
            open: false,
            input_value: '',
            select_prompt: 'Selecciona una facultad',
            focused_id: 0,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            },
            selectOption(value, name) {
                this.input_value = value
                this.select_prompt = name
                this.open = false
            }
        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
        x-id="['dropdown-button']"
        class="relative w-full"
    >
        <!-- Hidden Input -->
        <input type="hidden" name="facultad" x-bind:value="input_value">
        <!-- Button -->
        <span class="block mb-2 text-sm font-medium text-gray-900">Facultad</span>
        <button
            type="button"
            tabindex="{{$tabindex}}"
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            aria-haspopup="listbox"
            class="relative flex items-center whitespace-nowrap justify-between gap-2 w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
        >
            <span x-text="select_prompt"></span>

            <img src="{{asset('icons/dropdown-arrow.svg')}}" class="w-4">
            
        </button>

        <!-- Panel -->
        <ul
            role="listbox"
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            x-cloak
            class="absolute left-0 w-full rounded-lg shadow-sm mt-2 z-10 origin-top-left bg-white outline-none border border-gray-200"
        >
            @foreach ($facultades as $facultad)
            <li role="option"
                id
                data-value="{{$facultad->codigo}}"
                x-on:click="selectOption('{{$facultad->codigo}}','{{$facultad->nombre}}')" 
                x-on:keydown.enter="selectOption('{{$facultad->codigo}}','{{$facultad->nombre}}')" 
                x-on:keydown.space="selectOption('{{$facultad->codigo}}','{{$facultad->nombre}}')"  
                class="p-2.5 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-blue-100 focus-visible:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed border-b border-gray-200">
                <span class="w-16 text-center bg-blue-900 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">{{$facultad->codigo}}</span>{{$facultad->nombre}}
            </li>
            @endforeach
        </ul>
    </div>
</div>