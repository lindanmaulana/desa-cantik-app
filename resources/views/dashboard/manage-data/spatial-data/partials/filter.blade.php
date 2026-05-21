 <form action="{{ route('dashboard.manage-data.spatial-data') }}" method="GET" class="p-4 mb-6 space-y-4 bg-white border border-gray-100 shadow-sm rounded-xl">
     <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
         <div class="col-span-1 md:col-span-2">
             <label class="block mb-1 text-xs font-medium text-gray-500">Filter Jenis Objek Geografis</label>
             <select name="feature_type" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                 <option value="">Semua Jenis Objek</option>
                 @foreach($featureType::casses() as $val)
                 <option value="{{ $val->value }}" {{ request('feature_type') == $val->value ? 'selected' : '' }}>{{ $val->label() }}</option>
                 @endforeach
             </select>
         </div>

         <div class="flex items-end justify-end gap-2">
             <a href="{{ route('dashboard.manage-data.spatial-data') }}" class="w-full px-4 py-2 text-sm font-medium text-center text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                 Reset
             </a>
             <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-emerald-600 hover:bg-emerald-700">
                 Terapkan Filter
             </button>
         </div>
     </div>
 </form>