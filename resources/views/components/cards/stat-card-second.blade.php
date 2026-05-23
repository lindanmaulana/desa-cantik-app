  @props(['title', 'value', 'icon', 'color' => 'text-rose-600 bg-rose-50', 'isSecret' => 'false'])

  <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
      <div>
          <p class="text-xs font-semibold text-gray-400 uppercase">{{ $title }}</p>

          @if ($isSecret == 'true')
              <h3 class="mt-1 text-2xl font-bold text-gray-800">
                  <span x-show="openData">{{ $value }}</span>
                  <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-6 text-slate-400" /></span>
              </h3>
          @else
              <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $value }}</h3>
          @endif

      </div>
      <div class="p-3 rounded-lg {{ $color }}">
          <x-dynamic-component :component="$icon" class="size-6" />
      </div>
  </div>
