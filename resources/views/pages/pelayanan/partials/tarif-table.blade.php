<div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50/50 border-b border-gray-100">
                <th class="text-left px-6 py-4 text-xs font-bold text-bmkg-navy uppercase tracking-wider">Jenis PNBP</th>
                <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Satuan</th>
                <th class="text-right px-6 py-4 text-xs font-bold text-bmkg-navy uppercase tracking-wider">Tarif</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($data as $row)
            <tr class="hover:bg-bmkg-sky/30 transition-colors group">
                <td class="px-4 md:px-6 py-3 md:py-4 text-gray-700 font-medium group-hover:text-bmkg-blue transition-colors leading-relaxed min-w-[200px] sm:min-w-0">
                    {{ $row[0] }}
                </td>
                </td>
                <td class="px-3 md:px-6 py-3 md:py-4 text-gray-400 italic text-[10px] sm:text-xs">
                    {{ $row[1] }}
                </td>
                <td class="px-4 md:px-6 py-3 md:py-4 text-right font-black text-bmkg-navy whitespace-nowrap text-xs sm:text-sm">
                    {{ $row[2] }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
