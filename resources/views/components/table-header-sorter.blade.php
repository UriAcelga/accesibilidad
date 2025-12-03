@props(['currentSort' => '', 'sortby' => 'campo' ,'field' => 'Campo', 'thstyles' => ''])
@php
    $isActive = str_starts_with($currentSort, $sortby) || str_starts_with($currentSort, '-' . $sortby);
    $isDesc = str_starts_with($currentSort, '-' . $sortby);
    $nextSort = $isActive && !$isDesc ? '-' . $sortby : $sortby;

    $ariaSort = !$isActive ? 'none' : ($isDesc ? 'descending' : 'ascending');
@endphp
<th class="{{ $thstyles }}" scope="col" aria-sort="{{ $ariaSort }}">

    <a href="{{ request()->fullUrlWithQuery(['sort' => $nextSort]) }}"
        class="w-full h-full py-1 pl-2 pr-4 align-text-bottom text-left text-white hover:text-gray-200 hover:bg-blue-900 inline-flex items-center">
        {{ ucfirst($field) }}
        <span class="ml-2 flex-none">
            @if (!$isActive)
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="currentColor" clip-rule="evenodd"
                        d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z"
                        fill="currentColor" />
                </svg>
            @elseif ($isDesc)
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M7 3V21M7 21L3 17M7 21L11 17M14 3H21M14 9H19M14 15H17M14 21H15" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            @else
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M7 3V21M7 3L11 7M7 3L3 7M14 3H15M14 9H17M14 15H19M14 21H21" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            @endif
        </span>
    </a>
</th>