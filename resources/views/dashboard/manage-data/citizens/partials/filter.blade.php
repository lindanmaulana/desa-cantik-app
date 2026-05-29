       <form action="{{ route('dashboard.manage-data.citizens') }}" method="GET" class="p-4 mb-6 space-y-4 bg-white border border-gray-100 shadow-sm rounded-xl">
           <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
               <div class="relative col-span-1 md:col-span-2">
                   <label class="block mb-1 text-xs font-medium text-gray-500">Cari NIK / Nama</label>
                   <div class="relative">
                       <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                           <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                       </span>
                       <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                   </div>
               </div>

               <div>
                   <label class="block mb-1 text-xs font-medium text-gray-500">Jenis Kelamin</label>
                   <select name="gender" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500">
                       <option value="">Semua Genders</option>
                       @foreach($gender::cases() as $val)
                       <option value="{{ $val }}" {{ request('gender') == $val->value ? 'selected' : '' }}>{{ $val->label() }}</option>
                       @endforeach
                   </select>
               </div>

               <div>
                   <label class="block mb-1 text-xs font-medium text-gray-500">Agama</label>
                   <select name="religion" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500">
                       <option value="">Semua Agama</option>
                       @foreach($religion::cases() as $val)
                       <option value="{{ $val->value }}" {{ request('religion') == $val->value ? 'selected' : '' }}>{{ $val->label() }}</option>
                       @endforeach
                   </select>
               </div>

               <div>
                   <label class="block mb-1 text-xs font-medium text-gray-500">Keluarga (No. KK)</label>
                   <select name="family_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500">
                       <option value="">Semua Keluarga</option>
                       @foreach($families as $fam)
                       <option value="{{ $fam->id }}" {{ request('family_id') == $fam->id ? 'selected' : '' }}>
                           KK: {{ $fam->family_card_number }}
                       </option>
                       @endforeach
                   </select>
               </div>
           </div>

           <div class="flex items-center justify-end gap-2 pt-2">
               <a href="{{ route('dashboard.manage-data.citizens') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                   Reset Filter
               </a>
               <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                   Terapkan Filter
               </button>
           </div>
       </form>
