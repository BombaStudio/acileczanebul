<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Nöbetçi Eczane Sorgulama</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center p-6">

    <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">💊 Nöbetçi Eczane Sorgulama</h1>

        <!-- Arama Formu -->
        <form method="GET" action="{{ route('eczane.index') }}" class="flex flex-col md:flex-row gap-4 mb-6">
            <input type="text" name="il" value="{{ old('il', $il) }}" placeholder="İl (Örn: Ankara)" required
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 outline-none">
            <input type="text" name="ilce" value="{{ old('ilce', $ilce) }}" placeholder="İlçe (Örn: Yenimahalle)" required
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 outline-none">
            <button type="submit"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                Ara
            </button>
        </form>

        <!-- Eczane Listesi -->
        @if(!empty($eczaneler))
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-green-500 text-white">
                        <tr>
                            <th class="px-4 py-3">İsim</th>
                            <th class="px-4 py-3">Adres</th>
                            <th class="px-4 py-3">Telefon</th>
                            <th class="px-4 py-3">Harita</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eczaneler as $eczane)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $eczane['name'] }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $eczane['address'] }}</td>
                                <td class="px-4 py-3 text-blue-600">
                                    <a href="tel:{{ $eczane['phone'] }}">{{ $eczane['phone'] }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="https://maps.google.com/?q={{ $eczane['loc'] }}" 
                                       target="_blank" 
                                       class="text-green-500 hover:underline">
                                        Haritada Gör
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(request()->has('il'))
            <div class="text-red-500 font-semibold">Bu bölge için nöbetçi eczane bulunamadı.</div>
        @endif
    </div>

</body>
</html>
