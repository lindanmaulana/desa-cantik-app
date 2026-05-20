  <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
      <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
              <thead>
                  <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                      <th class="w-16 px-6 py-4 text-center">No</th>
                      <th class="px-6 py-4">Tipe Objek Spasial</th>
                      <th class="px-6 py-4">Nama Objek Terkait</th>
                      <th class="px-6 py-4 text-center">Garis Lintang (Latitude)</th>
                      <th class="px-6 py-4 text-center">Garis Bujur (Longitude)</th>
                      <th class="px-6 py-4 text-center">GeoJSON Geometry</th>
                      <th class="w-32 px-6 py-4 text-center">Aksi</th>
                  </tr>
              </thead>
              <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                  @if($spatialDataList->isNotEmpty())
                  @php $no = $spatialDataList->firstItem(); @endphp
                  @foreach($spatialDataList as $item)
                  <tr class="transition-colors hover:bg-gray-50/70">
                      <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                      <td class="px-6 py-4">
                          @if($item->feature_type->value === 'resident_house')
                          <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                              <x-heroicon-o-home class="w-3.5 h-3.5 mr-1" />
                              {{ $typeLabels[$item->feature_type->value] }}
                          </span>
                          @elseif($item->feature_type->value === 'public_facility')
                          <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                              <x-iconsax-lin-buildings class="w-3.5 h-3.5 mr-1" />
                              {{ $typeLabels[$item->feature_type->value] }}
                          </span>
                          @elseif($item->feature_type->value === 'msme_location')
                          <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-purple-50 text-purple-700 border border-purple-100">
                              <x-bi-shop class="w-3.5 h-3.5 mr-1" />
                              {{ $typeLabels[$item->feature_type->value] }}
                          </span>
                          @else
                          <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-50 text-slate-700 border border-slate-100">
                              <x-heroicon-o-map class="w-3.5 h-3.5 mr-1" />
                              {{ $typeLabels[$item->feature_type->value] }}
                          </span>
                          @endif
                      </td>
                      <td class="px-6 py-4">
                          @if($item->feature_type->value === 'resident_house' && $item->feature)
                          <div class="font-semibold text-gray-900">{{ $item->feature->name }}</div>
                          <div class="text-xs text-gray-400">NIK: {{ $item->feature->nik }}</div>
                          @elseif($item->feature_type->value === 'public_facility' && $item->feature)
                          <div class="font-semibold text-gray-900">{{ $item->feature->facility_name }}</div>
                          <div class="text-xs text-gray-400">Pendanaan: {{ $item->feature->funding_source }}</div>
                          @elseif($item->feature_type->value === 'msme_location' && $item->feature)
                          <div class="font-semibold text-gray-900">{{ $item->feature->name }}</div>
                          <div class="text-xs text-gray-400">NIB: {{ $item->feature->nib }}</div>
                          @elseif($item->feature_type->value === 'village_boundary')
                          <div class="italic font-semibold text-gray-600">Batas Peta Batas Wilayah</div>
                          @else
                          <span class="text-xs italic text-rose-500">Relasi Objek Terhapus / Rusak</span>
                          @endif
                      </td>
                      <td class="px-6 py-4 font-mono text-center text-gray-700">{{ number_format($item->latitude, 8) }}</td>
                      <td class="px-6 py-4 font-mono text-center text-gray-700">{{ number_format($item->longtitude, 8) }}</td>
                      <td class="px-6 py-4 text-center">
                          @if($item->geojson)
                          <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-100" title="{{ json_encode($item->geojson) }}">
                              GeoJSON Geometri
                          </span>
                          @else
                          <span class="text-xs italic text-gray-400">Bukan Poligon</span>
                          @endif
                      </td>
                      <td class="px-6 py-4 text-center">
                          <div class="flex items-center justify-center gap-2">
                              <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Spasial">
                                  <x-heroicon-o-pencil-square class="w-4 h-4" />
                              </button>
                              <form action="{{ route('spatial-data.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus titik koordinat GIS ini?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus Spasial">
                                      <x-heroicon-o-trash class="w-4 h-4" />
                                  </button>
                              </form>
                          </div>
                      </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                      <td colspan="7" class="py-10 text-center text-gray-500">
                          <div class="flex flex-col items-center justify-center gap-2 py-4">
                              <x-heroicon-o-folder-open class="text-gray-300 size-8" />
                              <p class="text-sm font-medium">Titik spasial GIS tidak ditemukan.</p>
                          </div>
                      </td>
                  </tr>
                  @endif
              </tbody>
          </table>
      </div>

      <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
          <p>Menampilkan {{ $spatialDataList->firstItem() ?? 0 }} sampai {{ $spatialDataList->lastItem() ?? 0 }} dari {{ $spatialDataList->total() }} titik koordinat</p>
          <div class="inline-flex gap-1">
              @if ($spatialDataList->onFirstPage())
              <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                  Sebelumnya
              </button>
              @else
              <a href="{{ $spatialDataList->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                  Sebelumnya
              </a>
              @endif

              @if ($spatialDataList->hasMorePages())
              <a href="{{ $spatialDataList->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                  Selanjutnya
              </a>
              @else
              <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                  Selanjutnya
              </button>
              @endif
          </div>
      </div>
  </div>